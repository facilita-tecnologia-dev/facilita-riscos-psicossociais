<?php

namespace Database\Seeders\Risks;

use App\Models\QuestionRisk;
use Illuminate\Database\Seeder;

class QuestionRiskSeeder extends Seeder
{
    public function run(): void
    {
        /* --- Organização do Trabalho (EOT) --- */ 
        // Rigidez Organizacional
        QuestionRisk::insert([
            [
                'risk_id' => 1,
                'base_question_id' => 4,
            ],
            [
                'risk_id' => 1,
                'base_question_id' => 13,
            ],
        ]);

        // Sobrecarga de Trabalho
        QuestionRisk::insert([
            [
                'risk_id' => 2,
                'base_question_id' => 6,
            ],
            [
                'risk_id' => 2,
                'base_question_id' => 7,
            ],
            [
                'risk_id' => 2,
                'base_question_id' => 14,
            ],
        ]);

        // Falta de Recursos
        QuestionRisk::insert([
            [
                'risk_id' => 3,
                'base_question_id' => 8,
            ],
            [
                'risk_id' => 3,
                'base_question_id' => 9,
            ],
            [
                'risk_id' => 3,
                'base_question_id' =>  10,
            ],
        ]);

        // Imprevisibilidade
        QuestionRisk::insert([
            [
                'risk_id' => 4,
                'base_question_id' => 12,
            ],
            [
                'risk_id' => 4,
                'base_question_id' => 15,
            ],
        ]);

        // Monotonia
        QuestionRisk::insert([
            [
                'risk_id' => 5,
                'base_question_id' => 2,
            ],
            [
                'risk_id' => 5,
                'base_question_id' => 54,
            ],
        ]);

        // Conflito de Papéis
        QuestionRisk::insert([
            [
                'risk_id' => 6,
                'base_question_id' => 3,
            ],
            [
                'risk_id' => 6,
                'base_question_id' => 5,
            ],
        ]);

        /* --- Estilos de Gestão (EEG) --- */ 
        
        // Gestão Individualista
        QuestionRisk::insert([
            [
                'risk_id' => 7,
                'base_question_id' => 17,
            ],
            [
                'risk_id' => 7,
                'base_question_id' => 23,
            ],
            [
                'risk_id' => 7,
                'base_question_id' => 24,
            ],
            [
                'risk_id' => 7,
                'base_question_id' => 25,
            ],
            [
                'risk_id' => 7,
                'base_question_id' => 27,
            ],
            [
                'risk_id' => 7,
                'base_question_id' => 29,
            ],
            [
                'risk_id' => 7,
                'base_question_id' => 30,
            ],
        ]);

        // Falta de Reconhecimento
        QuestionRisk::insert([
            [
                'risk_id' => 8,
                'base_question_id' => 18,
            ],
            [
                'risk_id' => 8,
                'base_question_id' => 20,
            ],
            [
                'risk_id' => 8,
                'base_question_id' => 22,
            ],
            [
                'risk_id' => 8,
                'base_question_id' => 26,
            ],
        ]);

        // Conflitos com a Gestão
        QuestionRisk::insert([
            [
                'risk_id' => 9,
                'base_question_id' => 16,
            ],
            [
                'risk_id' => 9,
                'base_question_id' => 36,
            ],
        ]);

        // Falta de Suporte Gerencial
        QuestionRisk::insert([
            [
                'risk_id' => 10,
                'base_question_id' => 19,
            ],
            [
                'risk_id' => 10,
                'base_question_id' => 21,
            ],
            [
                'risk_id' => 10,
                'base_question_id' => 52,
            ],
        ]);

        // Injustiça Percebida
        QuestionRisk::insert([
            [
                'risk_id' => 11,
                'base_question_id' => 28,
            ],
            [
                'risk_id' => 11,
                'base_question_id' => 38,
            ],
        ]);

        // Pressão Excessiva da Gestão
        QuestionRisk::insert([
            [
                'risk_id' => 12,
                'base_question_id' => 32,
            ],
        ]);
        
        /* --- Relações Interpessoais e Sofrimento (EIST) --- */ 

        // Esgotamento Emocional
        QuestionRisk::insert([
            [
                'risk_id' => 13,
                'base_question_id' => 37,
            ],
            [
                'risk_id' => 13,
                'base_question_id' => 50,
            ],
            [
                'risk_id' => 13,
                'base_question_id' => 72,
            ],
        ]);

        // Ansiedade ou Estresse
        QuestionRisk::insert([
            [
                'risk_id' => 14,
                'base_question_id' => 46,
            ],
            [
                'risk_id' => 14,
                'base_question_id' => 51,
            ],
        ]);

        // Isolamento Social
        QuestionRisk::insert([
            [
                'risk_id' => 15,
                'base_question_id' => 39,
            ],
            [
                'risk_id' => 15,
                'base_question_id' => 47,
            ],
        ]);

        // Frustração ou Desmotivação
        QuestionRisk::insert([
            [
                'risk_id' => 16,
                'base_question_id' => 55,
            ],
            [
                'risk_id' => 16,
                'base_question_id' => 56,
            ],
            [
                'risk_id' => 16,
                'base_question_id' => 57,
            ],
            [
                'risk_id' => 16,
                'base_question_id' => 58,
            ],
            [
                'risk_id' => 16,
                'base_question_id' => 59,
            ],
        ]);

        // Irritabilidade
        QuestionRisk::insert([
            [
                'risk_id' => 17,
                'base_question_id' => 46,
            ],
        ]);
        
        // Dificuldade de Concentração
        QuestionRisk::insert([
            [
                'risk_id' => 18,
                'base_question_id' => 51,
            ],
        ]);

        /* --- Conteúdo e Significado do Trabalho (EOT/EIST) --- */ 

        // Danos Físicos
        QuestionRisk::insert([
            [
                'risk_id' => 19,
                'base_question_id' => 63,
            ],
            [
                'risk_id' => 19,
                'base_question_id' => 64,
            ],
            [
                'risk_id' => 19,
                'base_question_id' => 66,
            ],
            [
                'risk_id' => 19,
                'base_question_id' => 69,
            ],
        ]);

        // Danos Psicológicos
        QuestionRisk::insert([
            [
                'risk_id' => 20,
                'base_question_id' => 48,
            ],
            [
                'risk_id' => 20,
                'base_question_id' => 49,
            ],
        ]);

        // Afastamentos Frequentes
        QuestionRisk::insert([
            [
                'risk_id' => 21,
                'base_question_id' => 60,
            ],
            [
                'risk_id' => 21,
                'base_question_id' => 61,
            ],
        ]);

        // Distúrbios do Sono
        QuestionRisk::insert([
            [
                'risk_id' => 22,
                'base_question_id' => 65,
            ],
        ]);

        // Distúrbios do Sono
        QuestionRisk::insert([
            [
                'risk_id' => 23,
                'base_question_id' => 62,
            ],
            [
                'risk_id' => 23,
                'base_question_id' => 67,
            ],
            [
                'risk_id' => 23,
                'base_question_id' => 68,
            ],
        ]);

        // Deterioração da Vida Pessoal
        QuestionRisk::insert([
            [
                'risk_id' => 24,
                'base_question_id' => 70,
            ],
            [
                'risk_id' => 24,
                'base_question_id' => 71,
            ],
        ]);

        /* --- Novos --- */ 

        // Assédio Moral
        QuestionRisk::insert([
            [
                'risk_id' => 25,
                'base_question_id' => 31,
            ],
            [
                'risk_id' => 25,
                'base_question_id' => 32,
            ],
            [
                'risk_id' => 25,
                'base_question_id' => 39,
            ],
        ]);

        // Assédio Sexual
        QuestionRisk::insert([
            [
                'risk_id' => 26,
                'base_question_id' => 40,
            ],
            [
                'risk_id' => 26,
                'base_question_id' => 41,
            ],
            [
                'risk_id' => 26,
                'base_question_id' => 42,
            ],
        ]);

        // Discriminação
        QuestionRisk::insert([
            [
                'risk_id' => 27,
                'base_question_id' => 33,
            ],
            [
                'risk_id' => 27,
                'base_question_id' => 34,
            ],
        ]);

        // Outras Formas de Violência
        QuestionRisk::insert([
            [
                'risk_id' => 28,
                'base_question_id' => 43,
            ],
            [
                'risk_id' => 28,
                'base_question_id' => 44,
            ],
            [
                'risk_id' => 28,
                'base_question_id' => 45,
            ],
        ]);
    }
}
