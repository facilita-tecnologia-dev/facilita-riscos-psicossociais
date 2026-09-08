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
            // Sem ->after() de propósito: adicionar no fim da tabela permite
            // ALGORITHM=INSTANT no MySQL/MariaDB, evitando lock em produção.
            $table->enum('psychosocial_questionnaire', PsychosocialQuestionnaire::values())
                ->default(PsychosocialQuestionnaire::STANDARD->value);
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('psychosocial_questionnaire');
        });
    }
};
