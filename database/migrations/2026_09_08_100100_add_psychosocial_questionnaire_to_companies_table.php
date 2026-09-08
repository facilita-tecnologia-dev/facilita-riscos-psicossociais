<?php

use App\Enums\Psychosocial\PsychosocialQuestionnaire;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Formulário de riscos psicossociais respondido pela empresa.
     * 'standard' = formulário da metodologia (HSE/PROART).
     * 'sb-based-on-hse' = formulário Sebratel, avaliado pelo motor HSE.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->enum('psychosocial_questionnaire', PsychosocialQuestionnaire::values())
                ->default(PsychosocialQuestionnaire::STANDARD->value)
                ->after('psychosocial_collection_type');
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('psychosocial_questionnaire');
        });
    }
};
