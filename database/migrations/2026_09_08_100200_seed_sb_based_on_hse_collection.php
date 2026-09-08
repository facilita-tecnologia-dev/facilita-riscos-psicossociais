<?php

use App\Enums\Campaign\CollectionType;
use Database\Seeders\BaseTests\SBHSEQuestions\SBHSEQuestions;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Popula a coleção do formulário Sebratel (`sb-based-on-hse`), suas 35 questões
 * e as traduções en/es/fr. Vai em migration (e não só em seeder) para rodar de
 * forma garantida no deploy de produção.
 *
 * O conteúdo vem de Database\Seeders\BaseTests\SBHSEQuestions\SBHSEQuestions
 * (fonte única, compartilhada com o SBHSECollectionSeeder).
 */
return new class extends Migration
{
    public function up(): void
    {
        $collectionId = DB::table('base_collections')
            ->where('key', SBHSEQuestions::COLLECTION_KEY)
            ->value('id');

        if (! $collectionId) {
            $collectionId = DB::table('base_collections')->insertGetId([
                'name' => SBHSEQuestions::COLLECTION_NAME,
                'key' => SBHSEQuestions::COLLECTION_KEY,
                'type' => CollectionType::PSYCHOSOCIAL->value,
            ]);
        }

        foreach (SBHSEQuestions::all() as $question) {
            $exists = DB::table('base_questions')
                ->where('base_collection_id', $collectionId)
                ->where('statement', $question['statement'])
                ->exists();

            if ($exists) {
                continue;
            }

            $questionId = DB::table('base_questions')->insertGetId([
                'base_collection_id' => $collectionId,
                'group' => $question['group']->value,
                'statement' => $question['statement'],
                'inverted' => false,
            ]);

            foreach ($question['translations'] as $locale => $statement) {
                DB::table('base_question_translations')->updateOrInsert(
                    ['base_question_id' => $questionId, 'locale' => $locale],
                    ['statement' => $statement],
                );
            }
        }
    }

    public function down(): void
    {
        // base_question_translations e base_questions caem por cascade (onDelete cascade)
        DB::table('base_collections')->where('key', SBHSEQuestions::COLLECTION_KEY)->delete();
    }
};
