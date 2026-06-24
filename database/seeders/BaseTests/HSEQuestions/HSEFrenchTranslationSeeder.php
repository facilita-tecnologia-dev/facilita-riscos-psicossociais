<?php

namespace Database\Seeders\BaseTests\HSEQuestions;

use App\Models\BaseQuestionTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HSEFrenchTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $translations = [
            73 => 'Les exigences professionnelles de mes collègues et de mes supérieurs sont difficiles à concilier',
            74 => 'J’ai des délais impossibles à respecter',
            75 => 'Je dois travailler de manière très intensive',
            76 => 'Je dois laisser certaines tâches de côté parce que j’ai trop de travail',
            77 => 'Je ne peux pas prendre suffisamment de pauses',
            78 => 'Je subis une pression pour travailler pendant de longues périodes',
            79 => 'Je dois travailler très rapidement',
            80 => 'Il est impossible de respecter les pauses prévues',

            81 => 'Je peux décider quand prendre une pause',
            82 => 'Je peux décider de mon rythme de travail',
            83 => 'Je peux choisir comment effectuer mon travail',
            84 => 'Je peux choisir ce que je fais dans mon travail',
            85 => 'J’ai un certain pouvoir de décision sur ma façon de travailler',
            86 => 'Mon horaire de travail peut être flexible',

            87 => 'Lorsque le travail devient difficile, mes collègues m’aident',
            88 => 'Je reçois des retours sur le travail que j’effectue',
            89 => 'Je peux compter sur l’aide de mon supérieur direct pour résoudre les problèmes liés au travail',
            90 => 'Je reçois l’aide et le soutien nécessaires de la part de mes collègues',
            91 => 'Je suis respecté comme je le mérite par mes collègues',
            92 => 'Je peux parler à mon supérieur direct de quelque chose qui m’a dérangé au travail',
            93 => 'Mes collègues sont disposés à écouter mes problèmes liés au travail',
            94 => 'Je reçois du soutien lorsque j’effectue un travail émotionnellement éprouvant',
            95 => 'Mon supérieur direct me motive dans mon travail',

            96 => 'Je suis victime de harcèlement personnel sous forme de paroles ou de comportements irrespectueux',
            97 => 'Il existe des conflits entre collègues de travail',
            98 => 'Je suis victime d’humiliations ou de situations embarrassantes au travail',
            99 => 'Les relations au travail sont tendues',

            100 => 'Je sais clairement ce que l’on attend de moi dans mon travail',
            101 => 'Je sais comment accomplir mon travail',
            102 => 'Je connais clairement mes devoirs et responsabilités',
            103 => 'Je connais les objectifs de mon service',
            104 => 'Je comprends comment mon travail s’intègre aux objectifs de l’entreprise',

            105 => 'J’ai suffisamment d’occasions de questionner ma hiérarchie au sujet des changements au travail',
            106 => 'L’équipe est toujours consultée concernant les changements au travail',
            107 => 'Lorsque des changements surviennent au travail, on m’explique clairement comment ils fonctionneront dans la pratique',
        ];

        foreach ($translations as $questionId => $statement) {
            BaseQuestionTranslation::updateOrCreate(
                [
                    'base_question_id' => $questionId,
                    'locale' => 'fr',
                ],
                [
                    'statement' => $statement,
                ]
            );
        }
    }
}
