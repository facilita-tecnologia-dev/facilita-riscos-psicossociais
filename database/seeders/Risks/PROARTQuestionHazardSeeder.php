<?php

namespace Database\Seeders\Risks;

use App\Models\QuestionHazard;
use Illuminate\Database\Seeder;

class PROARTQuestionHazardSeeder extends Seeder
{
    public function run(): void
    {
        /* --- Organização do Trabalho (EOT) --- */ 
        // Rigidez Organizacional
        QuestionHazard::insert([
            [
                'hazard_id' => 1,
                'base_question_id' => 4,
            ],
            [
                'hazard_id' => 1,
                'base_question_id' => 13,
            ],
        ]);

        // Sobrecarga de Trabalho
        QuestionHazard::insert([
            [
                'hazard_id' => 2,
                'base_question_id' => 6,
            ],
            [
                'hazard_id' => 2,
                'base_question_id' => 7,
            ],
            [
                'hazard_id' => 2,
                'base_question_id' => 14,
            ],
        ]);

        // Falta de Recursos
        QuestionHazard::insert([
            [
                'hazard_id' => 3,
                'base_question_id' => 8,
            ],
            [
                'hazard_id' => 3,
                'base_question_id' => 9,
            ],
            [
                'hazard_id' => 3,
                'base_question_id' =>  10,
            ],
        ]);

        // Imprevisibilidade
        QuestionHazard::insert([
            [
                'hazard_id' => 4,
                'base_question_id' => 12,
            ],
            [
                'hazard_id' => 4,
                'base_question_id' => 15,
            ],
        ]);

        // Monotonia
        QuestionHazard::insert([
            [
                'hazard_id' => 5,
                'base_question_id' => 2,
            ],
            [
                'hazard_id' => 5,
                'base_question_id' => 54,
            ],
        ]);

        // Conflito de Papéis
        QuestionHazard::insert([
            [
                'hazard_id' => 6,
                'base_question_id' => 3,
            ],
            [
                'hazard_id' => 6,
                'base_question_id' => 5,
            ],
        ]);

        /* --- Estilos de Gestão (EEG) --- */ 
        
        // Gestão Individualista
        QuestionHazard::insert([
            [
                'hazard_id' => 7,
                'base_question_id' => 17,
            ],
            [
                'hazard_id' => 7,
                'base_question_id' => 23,
            ],
            [
                'hazard_id' => 7,
                'base_question_id' => 24,
            ],
            [
                'hazard_id' => 7,
                'base_question_id' => 25,
            ],
            [
                'hazard_id' => 7,
                'base_question_id' => 27,
            ],
            [
                'hazard_id' => 7,
                'base_question_id' => 29,
            ],
            [
                'hazard_id' => 7,
                'base_question_id' => 30,
            ],
        ]);

        // Falta de Reconhecimento
        QuestionHazard::insert([
            [
                'hazard_id' => 8,
                'base_question_id' => 18,
            ],
            [
                'hazard_id' => 8,
                'base_question_id' => 20,
            ],
            [
                'hazard_id' => 8,
                'base_question_id' => 22,
            ],
            [
                'hazard_id' => 8,
                'base_question_id' => 26,
            ],
        ]);

        // Conflitos com a Gestão
        QuestionHazard::insert([
            [
                'hazard_id' => 9,
                'base_question_id' => 16,
            ],
            [
                'hazard_id' => 9,
                'base_question_id' => 36,
            ],
        ]);

        // Falta de Suporte Gerencial
        QuestionHazard::insert([
            [
                'hazard_id' => 10,
                'base_question_id' => 19,
            ],
            [
                'hazard_id' => 10,
                'base_question_id' => 21,
            ],
            [
                'hazard_id' => 10,
                'base_question_id' => 52,
            ],
        ]);

        // Injustiça Percebida
        QuestionHazard::insert([
            [
                'hazard_id' => 11,
                'base_question_id' => 28,
            ],
            [
                'hazard_id' => 11,
                'base_question_id' => 38,
            ],
        ]);

        // Pressão Excessiva da Gestão
        QuestionHazard::insert([
            [
                'hazard_id' => 12,
                'base_question_id' => 32,
            ],
        ]);
        
        /* --- Relações Interpessoais e Sofrimento (EIST) --- */ 

        // Esgotamento Emocional
        QuestionHazard::insert([
            [
                'hazard_id' => 13,
                'base_question_id' => 37,
            ],
            [
                'hazard_id' => 13,
                'base_question_id' => 50,
            ],
            [
                'hazard_id' => 13,
                'base_question_id' => 72,
            ],
        ]);

        // Ansiedade ou Estresse
        QuestionHazard::insert([
            [
                'hazard_id' => 14,
                'base_question_id' => 46,
            ],
            [
                'hazard_id' => 14,
                'base_question_id' => 51,
            ],
        ]);

        // Isolamento Social
        QuestionHazard::insert([
            [
                'hazard_id' => 15,
                'base_question_id' => 39,
            ],
            [
                'hazard_id' => 15,
                'base_question_id' => 47,
            ],
        ]);

        // Frustração ou Desmotivação
        QuestionHazard::insert([
            [
                'hazard_id' => 16,
                'base_question_id' => 55,
            ],
            [
                'hazard_id' => 16,
                'base_question_id' => 56,
            ],
            [
                'hazard_id' => 16,
                'base_question_id' => 57,
            ],
            [
                'hazard_id' => 16,
                'base_question_id' => 58,
            ],
            [
                'hazard_id' => 16,
                'base_question_id' => 59,
            ],
        ]);

        // Irritabilidade
        QuestionHazard::insert([
            [
                'hazard_id' => 17,
                'base_question_id' => 46,
            ],
        ]);
        
        // Dificuldade de Concentração
        QuestionHazard::insert([
            [
                'hazard_id' => 18,
                'base_question_id' => 51,
            ],
        ]);

        /* --- Conteúdo e Significado do Trabalho (EOT/EIST) --- */ 

        // Danos Físicos
        QuestionHazard::insert([
            [
                'hazard_id' => 19,
                'base_question_id' => 63,
            ],
            [
                'hazard_id' => 19,
                'base_question_id' => 64,
            ],
            [
                'hazard_id' => 19,
                'base_question_id' => 66,
            ],
            [
                'hazard_id' => 19,
                'base_question_id' => 69,
            ],
        ]);

        // Danos Psicológicos
        QuestionHazard::insert([
            [
                'hazard_id' => 20,
                'base_question_id' => 48,
            ],
            [
                'hazard_id' => 20,
                'base_question_id' => 49,
            ],
        ]);

        // Afastamentos Frequentes
        QuestionHazard::insert([
            [
                'hazard_id' => 21,
                'base_question_id' => 60,
            ],
            [
                'hazard_id' => 21,
                'base_question_id' => 61,
            ],
        ]);

        // Distúrbios do Sono
        QuestionHazard::insert([
            [
                'hazard_id' => 22,
                'base_question_id' => 65,
            ],
        ]);

        // Distúrbios do Sono
        QuestionHazard::insert([
            [
                'hazard_id' => 23,
                'base_question_id' => 62,
            ],
            [
                'hazard_id' => 23,
                'base_question_id' => 67,
            ],
            [
                'hazard_id' => 23,
                'base_question_id' => 68,
            ],
        ]);

        // Deterioração da Vida Pessoal
        QuestionHazard::insert([
            [
                'hazard_id' => 24,
                'base_question_id' => 70,
            ],
            [
                'hazard_id' => 24,
                'base_question_id' => 71,
            ],
        ]);

        /* --- Novos --- */ 

        // Assédio Moral
        QuestionHazard::insert([
            [
                'hazard_id' => 25,
                'base_question_id' => 31,
            ],
            [
                'hazard_id' => 25,
                'base_question_id' => 32,
            ],
            [
                'hazard_id' => 25,
                'base_question_id' => 39,
            ],
        ]);

        // Assédio Sexual
        QuestionHazard::insert([
            [
                'hazard_id' => 26,
                'base_question_id' => 40,
            ],
            [
                'hazard_id' => 26,
                'base_question_id' => 41,
            ],
            [
                'hazard_id' => 26,
                'base_question_id' => 42,
            ],
        ]);

        // Discriminação
        QuestionHazard::insert([
            [
                'hazard_id' => 27,
                'base_question_id' => 33,
            ],
            [
                'hazard_id' => 27,
                'base_question_id' => 34,
            ],
        ]);

        // Outras Formas de Violência
        QuestionHazard::insert([
            [
                'hazard_id' => 28,
                'base_question_id' => 43,
            ],
            [
                'hazard_id' => 28,
                'base_question_id' => 44,
            ],
            [
                'hazard_id' => 28,
                'base_question_id' => 45,
            ],
        ]);
    }
}
