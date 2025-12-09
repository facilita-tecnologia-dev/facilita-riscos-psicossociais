<?php

namespace App\Livewire\Private\Test;

use App\Enums\Campaign\CollectionType;
use App\Models\Campaign;
use App\Models\TemporaryAnswer;
use App\Models\UserAnswer;
use App\Models\UserFeedback;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;

class TestShowComponent extends Component
{
    public Campaign $campaign;

    public ?string $videoUrl = null;

    public array $questions;
    public array $answers;
    public int $current = 0;
    
    public bool $is_organizational = false;
    public ?string $feedback = null;

    public function render()
    {
        return view('livewire.private.test.test-show-component');
    }

    public function mount(Campaign $campaign)
    {
        $this->campaign = $campaign;
        $this->is_organizational = $this->campaign->collection()->type == CollectionType::ORGANIZATIONAL;

        $this->questions = $campaign->collection()->questions->shuffle()->values()->toArray();

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
                    $userCollection->answers()->create([
                        'user_id' => session('auth:user')->id,
                        'company_id' => session('auth:company')->id,
                        'campaign_id' => $this->campaign->id,
                        'question_id' => $question->id,
                        'question_type' => $this->campaign->type,
                        'value' => $this->answers[$question['id']],
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
            
            $this->dispatch('alert:success', "Teste finalizado!");
            return redirect()->to(route('home.user'));
        } catch (\Throwable $th) {
            report($th);
            $this->dispatch('alert:danger', "Não foi possível armazenar as respostas do seu teste.");
        }
    }
}
