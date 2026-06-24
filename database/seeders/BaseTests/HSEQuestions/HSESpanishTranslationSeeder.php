<?php

namespace Database\Seeders\BaseTests\HSEQuestions;

use App\Models\BaseQuestionTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HSESpanishTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $translations = [
            73 => 'Las exigencias laborales de colegas y supervisores son difíciles de conciliar',
            74 => 'Tengo plazos imposibles de cumplir',
            75 => 'Debo trabajar muy intensamente',
            76 => 'No realizo algunas tareas porque tengo demasiado trabajo',
            77 => 'No tengo posibilidad de tomar suficientes pausas',
            78 => 'Recibo presión para trabajar fuera de horario',
            79 => 'Debo realizar mi trabajo con mucha rapidez',
            80 => 'Es imposible cumplir con las pausas temporales',

            81 => 'Puedo decidir cuándo tomar una pausa',
            82 => 'Se toma en cuenta mi opinión sobre la velocidad de mi trabajo',
            83 => 'Tengo libertad para decidir cómo hacer mi trabajo',
            84 => 'Tengo libertad para decidir qué hacer en mi trabajo',
            85 => 'Mis sugerencias sobre cómo hacer mi trabajo son consideradas',
            86 => 'Mi horario de trabajo puede ser flexible',

            87 => 'Cuando el trabajo se vuelve difícil, puedo contar con la ayuda de mis compañeros',
            88 => 'Recibo información y apoyo que me ayudan en mi trabajo',
            89 => 'Puedo confiar en mi jefe cuando tengo problemas laborales',
            90 => 'Mis compañeros me ayudan y me apoyan cuando lo necesito',
            91 => 'En el trabajo, mis compañeros me demuestran el respeto que merezco',
            92 => 'Cuando algo me molesta en el trabajo, puedo hablar con mi jefe',
            93 => 'Mis compañeros están disponibles para escuchar mis problemas laborales',
            94 => 'He enfrentado trabajos emocionalmente exigentes',
            95 => 'Mi jefe me motiva en el trabajo',

            96 => 'Me hablan o se comportan conmigo de forma agresiva',
            97 => 'Existen conflictos entre compañeros',
            98 => 'Siento que soy acosado(a) en el trabajo',
            99 => 'Las relaciones laborales son tensas',

            100 => 'Tengo claridad sobre lo que se espera de mí en el trabajo',
            101 => 'Sé cómo hacer mi trabajo',
            102 => 'Mis tareas y responsabilidades están claramente definidas',
            103 => 'Los objetivos y metas de mi área están claros para mí',
            104 => 'Veo cómo mi trabajo se alinea con los objetivos de la empresa',

            105 => 'Tengo oportunidades para pedir explicaciones a mi jefe sobre los cambios relacionados con mi trabajo',
            106 => 'Las personas siempre son consultadas sobre los cambios laborales',
            107 => 'Cuando hay cambios, sigo haciendo mi trabajo con el mismo compromiso',
        ];

        foreach ($translations as $questionId => $statement) {
            BaseQuestionTranslation::updateOrCreate(
                [
                    'base_question_id' => $questionId,
                    'locale' => 'es',
                ],
                [
                    'statement' => $statement,
                ]
            );
        }
    }
}
