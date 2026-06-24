<?php

namespace App\Livewire\Private\Test;

use App\Enums\Campaign\CollectionType;
use App\Enums\Psychosocial\HSE\HSEOption;
use App\Models\Campaign;
use App\Models\TemporaryAnswer;
use App\Models\UserFeedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class TestShowComponent extends Component
{
    public Campaign $campaign;

    public ?string $videoUrl = null;
    public bool $video_finished = false;
    public bool $video_watched = false;
    
    public array $questions;
    public array $answers;
    public int $current = 0;
    
    public bool $is_organizational = false;
    public ?string $feedback = null;

    public array $questionIds = [];
    
    public string $locale = 'pt_BR';

    public function render()
    {
        return view('livewire.private.test.test-show-component');
    }

    public function mount(Campaign $campaign)
    {
        if (! session()->has('form_locale')) {
            session()->put('form_locale', 'pt_BR');
        }

        $this->applyLocale();

        $sessionKey = "question_ids_{$campaign->id}";
        $questions = $campaign->collection()->questions()->select('id')->get();
        $this->questionIds = session()->has($sessionKey) ? session($sessionKey) : $questions->pluck('id')->shuffle()->values()->toArray();
        session()->put($sessionKey, $this->questionIds);

        $this->campaign = $campaign;
        $this->is_organizational = $this->campaign->collection()->type == CollectionType::ORGANIZATIONAL;

        $this->questions = $this->loadQuestions();

        $this->video_watched = session('auth:company')->test_helper_video ? false : true;

        try {
            foreach ($this->questions as $question) {
                $tempAnswer = TemporaryAnswer::firstOrCreate(
                    [
                        'user_id' => session('auth:user')->id,
                        'campaign_id' => $this->campaign->id,
                        'question_id' => $question['id']
                    ],
                    ['value' => null]
                );
    
                $this->answers[$question['id']] = $tempAnswer->value;
            }
        } catch (\Throwable $th) {
            report($th);
            $this->dispatch('alert:danger', "Não foi possível buscar suas respostas.");
        }
    }

    public function openVideoModal()
    {
        $this->dispatch('open-video-modal');
        $this->loadVideo();
    }

    public function markVideoAsFinished()
    {
        $this->video_finished = true;
    }

    public function loadVideo()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');
        $this->videoUrl = $s3->temporaryUrl(session('auth:company')->test_helper_video, now()->addMinutes(5));
    }

    public function closeVideoModal()
    {
        $this->videoUrl = null;
        $this->dispatch('close-video-modal');
    }

    public function confirmVideoWatched()
    {
        $this->video_watched = true;
        $this->closeVideoModal();
    }

    public function answer($value)
    {
        $question = $this->questions[$this->current];
        $this->answers[$question['id']] = $value;

        try {
            TemporaryAnswer::where('user_id', session('auth:user')->id)
                ->where('campaign_id', $this->campaign->id)
                ->where('question_id', $question['id'])
                ->update(['value' => $value]);

            $this->dispatch('alert:success', "Questão respondida!");
            $this->next();
        } catch (\Throwable $th) {
            report($th);
            $this->dispatch('alert:danger', "Não foi possível armazenar sua resposta.");
        }
    }

    public function goToQuestion($i)
    {
        $this->current = $i;
    }

    public function next()
    {
        if ($this->current < count($this->questions) - 1) {
            $this->current++;
        }
    }

    public function previous()
    {
        if ($this->current > 0) {
            $this->current--;
        }
    }

    public function getIsCompletedProperty()
    {
        foreach ($this->answers as $value) {
            if ($value === null) {
                return false;
            }
        }

        return true;
    }

    public function getProgressProperty()
    {
        $answered = collect($this->answers)->filter(fn($v) => $v !== null)->count();
        $total = count($this->questions);

        return round(($answered / $total) * 100);
    }

    public function clearAnswers()
    {
        foreach ($this->answers as $key => $value) {
            $this->answers[$key] = null;
        }

        TemporaryAnswer::where('user_id', session("auth:user")->id)
            ->where('campaign_id', $this->campaign->id)
            ->delete();

        $this->current = 0;

        $this->dispatch('alert:success', "Todas as respostas foram limpas!");
    }

    public function finish()
    {
        try {
            DB::transaction(function(){
                $userCollection = $this->campaign->userCollections()->create([
                    'user_id' => session('auth:user')->id,
                    'company_id' => session('auth:company')->id,
                    'collection_id' => $this->campaign->collection_id,
                    'type' => $this->campaign->type,
                ]);
 
                $this->campaign->collection()->questions->each(function($question) use($userCollection) {
                    $questionId = $question['id'];

                    $isTrial = session('auth:company')->hasActiveTrial();
                    $answered = $this->answers[$questionId] ?? null;

                    $answeredCount = collect($this->answers)
                        ->filter(fn($v) => $v !== null)
                        ->count();
    
                    if ($isTrial && $answeredCount >= 5 && $answered === null) {
                        $value = $this->generateRandomAnswer($question);
                    } else {
                        $value = $answered ?? $this->generateRandomAnswer($question);
                    }

                    $userCollection->answers()->create([
                        'user_id' => session('auth:user')->id,
                        'company_id' => session('auth:company')->id,
                        'campaign_id' => $this->campaign->id,
                        'question_id' => $question->id,
                        'question_type' => $this->campaign->type,
                        'value' => $value,
                    ]);
                });

                TemporaryAnswer::where('user_id', session("auth:user")->id)
                    ->where('campaign_id', $this->campaign->id)
                    ->delete();
            });

            if($this->is_organizational && $this->feedback){
                UserFeedback::create([
                    'company_id' => session('auth:company')->id,
                    'user_id' => session('auth:user')->id,
                    'content' => $this->feedback,
                ]);
            }
            
            session()->forget("question_ids_{$this->campaign->id}");
            session()->forget("form_locale");
            
            $this->dispatch('alert:success', "Teste finalizado!");
            return redirect()->to(route('home.user'));
        } catch (\Throwable $th) {
            report($th);
            $this->dispatch('alert:danger', "Não foi possível armazenar as respostas do seu teste.");
        }
    }

    private function generateRandomAnswer($question)
    {
        $options = array_map(fn($option) => ['label' => $option->label(), 'value' => $question['inverted'] ? $option->inverted() : $option->value] , HSEOption::cases());
        return collect($options)->random()['value'];
    }

    public function changeLocale(string $locale): void
    {
        session()->put('form_locale', $locale);
        app()->setLocale($locale);
        $this->locale = $locale;
        $this->questions = $this->loadQuestions();
    }

    private function applyLocale(): void
    {
        app()->setLocale(session('form_locale', 'pt_BR'));
    }

    private function loadQuestions(): array
    {
        $this->applyLocale();

        // $collection = $this->campaign->collection();
        // $collection->load('questions.translations');
        
        // $questions = session('auth:company')->hasActiveTrial()
        //             ? $this->campaign->collection()->questions->values()->take(5)->toArray()
        //             : $this->campaign->collection()->questions->shuffle()->values()->toArray();

        // return $questions;
        $questions = $this->campaign
            ->collection()
            ->questions()
            ->with('translations')
            ->get();

        // if (! session('auth:company')->hasActiveTrial()) {
        $orderMap = array_flip($this->questionIds);
        $questions = $questions->sortBy(fn ($question) => $orderMap[$question->id])->values();
        // $questions = $questions->sortBy(fn ($question) => array_search($question->id, $this->questionIds))->values();
        // }

        return session('auth:company')->hasActiveTrial()
            ? $questions->take(5)->values()->toArray()
            : $questions->values()->toArray();

        // $this->questions = session('auth:company')->hasActiveTrial()
        //             ? $questions->values()->take(5)->toArray()
        //             : $questions->shuffle()->values()->toArray();
                    
    }
}
