<?php

namespace Database\Seeders\BaseTests\SBHSEQuestions;

use App\Enums\Campaign\CollectionType;
use App\Models\BaseCollection;
use App\Models\BaseQuestion;
use App\Models\BaseQuestionTranslation;
use Illuminate\Database\Seeder;

/**
 * Cria a coleção do formulário Sebratel (`sb-based-on-hse`) com suas 35 questões
 * e as traduções en/es/fr. A avaliação continua sendo feita pelo motor HSE
 * (ver App\Services\Psychosocial\HSERiskService e Company::evaluationCollection()).
 */
class SBHSECollectionSeeder extends Seeder
{
    public function run(): void
    {
        $collection = BaseCollection::firstOrCreate(
            ['key' => SBHSEQuestions::COLLECTION_KEY],
            [
                'name' => SBHSEQuestions::COLLECTION_NAME,
                'type' => CollectionType::PSYCHOSOCIAL->value,
            ]
        );

        foreach (SBHSEQuestions::all() as $question) {
            $baseQuestion = BaseQuestion::firstOrCreate(
                [
                    'base_collection_id' => $collection->id,
                    'statement' => $question['statement'],
                ],
                [
                    'group' => $question['group']->value,
                    'inverted' => false,
                ]
            );

            foreach ($question['translations'] as $locale => $statement) {
                BaseQuestionTranslation::updateOrCreate(
                    ['base_question_id' => $baseQuestion->id, 'locale' => $locale],
                    ['statement' => $statement],
                );
            }
        }
    }
}
