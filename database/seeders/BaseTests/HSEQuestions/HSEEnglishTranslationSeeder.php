<?php

namespace Database\Seeders\BaseTests\HSEQuestions;

use App\Models\BaseQuestionTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HSEEnglishTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $translations = [
            73 => 'The work demands made by colleagues and supervisors are difficult to reconcile',
            74 => 'I have deadlines that are impossible to meet',
            75 => 'I have to work very intensively',
            76 => 'I have to leave some tasks aside because I have too much work to do',
            77 => 'I am unable to take sufficient breaks',
            78 => 'I am pressured to work for long periods',
            79 => 'I have to work very quickly',
            80 => 'It is impossible to take scheduled breaks',

            81 => 'I can decide when to take a break',
            82 => 'I can decide my work pace',
            83 => 'I can choose how to do my work',
            84 => 'I can choose what to do at work',
            85 => 'I have some control over the way I work',
            86 => 'My working hours can be flexible',

            87 => 'If work becomes difficult, my colleagues help me',
            88 => 'I receive feedback on the work I perform',
            89 => 'I can rely on my immediate supervisor for help in solving work-related problems',
            90 => 'I receive the help and support I need from my colleagues',
            91 => 'I am respected by my colleagues as I deserve to be',
            92 => 'I can talk to my immediate supervisor about something that has bothered me at work',
            93 => 'My colleagues are willing to listen to my work-related problems',
            94 => 'I receive support when I perform work that may be emotionally demanding',
            95 => 'My immediate supervisor motivates me at work',

            96 => 'I am subject to personal harassment in the form of rude words or behavior',
            97 => 'There are conflicts among coworkers',
            98 => 'I am subjected to embarrassing or humiliating situations at work',
            99 => 'Relationships at work are tense',

            100 => 'I clearly know what is expected of me at work',
            101 => 'I know how to carry out my work',
            102 => 'I am aware of my duties and responsibilities',
            103 => 'I know the goals and objectives of my department',
            104 => 'I understand how my work contributes to the company’s objectives',

            105 => 'I have sufficient opportunities to question management about changes at work',
            106 => 'The team is always consulted about workplace changes',
            107 => 'When changes occur at work, I am informed about how they will work in practice',
        ];

        foreach ($translations as $questionId => $statement) {
            BaseQuestionTranslation::updateOrCreate(
                [
                    'base_question_id' => $questionId,
                    'locale' => 'en',
                ],
                [
                    'statement' => $statement,
                ]
            );
        }
    }
}
