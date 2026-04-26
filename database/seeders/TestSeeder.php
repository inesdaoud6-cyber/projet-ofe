<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Block;
use App\Models\Group;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        $block = Block::firstOrCreate(
            ['name' => 'Compétences Techniques'],
            ['title' => 'Bloc principal', 'order' => 1]
        );

        $groupDev  = Group::firstOrCreate(
            ['name' => 'Développement Web'],
            ['block_id' => $block->id, 'order' => 1]
        );
        $groupBdd  = Group::firstOrCreate(
            ['name' => 'Base de données'],
            ['block_id' => $block->id, 'order' => 2]
        );
        $groupSoft = Group::firstOrCreate(
            ['name' => 'Soft Skills'],
            ['block_id' => $block->id, 'order' => 3]
        );

        $test1 = Test::firstOrCreate(
            ['name' => 'Test PHP Junior'],
            [
                'description'           => 'Évaluation des compétences PHP de base pour les profils juniors.',
                'eligibility_threshold' => 50,
                'talent_threshold'      => 80,
            ]
        );

        $q1 = Question::firstOrCreate(
            ['question_fr' => 'Quelle est la différence entre == et === en PHP ?'],
            [
                'block_id'         => $block->id,
                'group_id'         => $groupDev->id,
                'question_en'      => 'What is the difference between == and === in PHP?',
                'question_ar'      => 'ما الفرق بين == و === في PHP؟',
                'component'        => 'radio',
                'level'            => 1,
                'obligatory'       => true,
                'scorable'         => true,
                'classification'   => 'primary',
                'max_note'         => 10,
                'possible_answers' => [
                    '== compare la valeur et le type, === compare seulement la valeur',
                    '== compare seulement la valeur, === compare la valeur et le type',
                    'Il n\'y a aucune différence',
                    '== est pour les entiers, === pour les chaînes',
                ],
            ]
        );

        Answer::firstOrCreate(['question_id' => $q1->id, 'text' => '== compare la valeur et le type, === compare seulement la valeur'],  ['is_correct' => false, 'order' => 1]);
        Answer::firstOrCreate(['question_id' => $q1->id, 'text' => '== compare seulement la valeur, === compare la valeur et le type'],  ['is_correct' => true,  'order' => 2]);
        Answer::firstOrCreate(['question_id' => $q1->id, 'text' => 'Il n\'y a aucune différence'],                                       ['is_correct' => false, 'order' => 3]);
        Answer::firstOrCreate(['question_id' => $q1->id, 'text' => '== est pour les entiers, === pour les chaînes'],                     ['is_correct' => false, 'order' => 4]);

        $q2 = Question::firstOrCreate(
            ['question_fr' => 'Qu\'est-ce qu\'une clé étrangère en SQL ?'],
            [
                'block_id'         => $block->id,
                'group_id'         => $groupBdd->id,
                'question_en'      => 'What is a foreign key in SQL?',
                'question_ar'      => 'ما هو المفتاح الأجنبي في SQL؟',
                'component'        => 'radio',
                'level'            => 1,
                'obligatory'       => true,
                'scorable'         => true,
                'classification'   => 'primary',
                'max_note'         => 10,
                'possible_answers' => [
                    'Une colonne identifiant de manière unique chaque ligne',
                    'Une colonne référençant la clé primaire d\'une autre table',
                    'Un index sur plusieurs colonnes',
                    'Une contrainte pour les valeurs NULL',
                ],
            ]
        );

        Answer::firstOrCreate(['question_id' => $q2->id, 'text' => 'Une colonne identifiant de manière unique chaque ligne'],               ['is_correct' => false, 'order' => 1]);
        Answer::firstOrCreate(['question_id' => $q2->id, 'text' => 'Une colonne référençant la clé primaire d\'une autre table'],            ['is_correct' => true,  'order' => 2]);
        Answer::firstOrCreate(['question_id' => $q2->id, 'text' => 'Un index sur plusieurs colonnes'],                                      ['is_correct' => false, 'order' => 3]);
        Answer::firstOrCreate(['question_id' => $q2->id, 'text' => 'Une contrainte pour les valeurs NULL'],                                 ['is_correct' => false, 'order' => 4]);

        $q3 = Question::firstOrCreate(
            ['question_fr' => 'Décrivez votre méthode de travail en équipe.'],
            [
                'block_id'       => $block->id,
                'group_id'       => $groupSoft->id,
                'question_en'    => 'Describe your teamwork approach.',
                'question_ar'    => 'صف أسلوبك في العمل الجماعي.',
                'component'      => 'text',
                'level'          => 1,
                'obligatory'     => true,
                'scorable'       => false,
                'classification' => 'secondary',
                'max_note'       => 0,
            ]
        );

        $test1->questions()->syncWithoutDetaching([$q1->id, $q2->id, $q3->id]);

        $test2 = Test::firstOrCreate(
            ['name' => 'Test Laravel Senior'],
            [
                'description'           => 'Évaluation avancée des compétences Laravel pour profils seniors.',
                'eligibility_threshold' => 60,
                'talent_threshold'      => 85,
            ]
        );

        $q4 = Question::firstOrCreate(
            ['question_fr' => 'Quelle commande Artisan crée un middleware dans Laravel ?'],
            [
                'block_id'         => $block->id,
                'group_id'         => $groupDev->id,
                'question_en'      => 'Which Artisan command creates a middleware in Laravel?',
                'question_ar'      => 'ما هو أمر Artisan الذي ينشئ middleware في Laravel؟',
                'component'        => 'radio',
                'level'            => 1,
                'obligatory'       => true,
                'scorable'         => true,
                'classification'   => 'primary',
                'max_note'         => 15,
                'possible_answers' => [
                    'php artisan make:middleware',
                    'php artisan create:middleware',
                    'php artisan middleware:make',
                    'php artisan generate:middleware',
                ],
            ]
        );

        Answer::firstOrCreate(['question_id' => $q4->id, 'text' => 'php artisan make:middleware'],     ['is_correct' => true,  'order' => 1]);
        Answer::firstOrCreate(['question_id' => $q4->id, 'text' => 'php artisan create:middleware'],   ['is_correct' => false, 'order' => 2]);
        Answer::firstOrCreate(['question_id' => $q4->id, 'text' => 'php artisan middleware:make'],     ['is_correct' => false, 'order' => 3]);
        Answer::firstOrCreate(['question_id' => $q4->id, 'text' => 'php artisan generate:middleware'], ['is_correct' => false, 'order' => 4]);

        $q5 = Question::firstOrCreate(
            ['question_fr' => 'Qu\'est-ce qu\'un Eloquent Observer dans Laravel ?'],
            [
                'block_id'         => $block->id,
                'group_id'         => $groupDev->id,
                'question_en'      => 'What is an Eloquent Observer in Laravel?',
                'question_ar'      => 'ما هو Eloquent Observer في Laravel؟',
                'component'        => 'radio',
                'level'            => 2,
                'obligatory'       => true,
                'scorable'         => true,
                'classification'   => 'primary',
                'max_note'         => 15,
                'possible_answers' => [
                    'Une classe qui écoute les événements du modèle (create, update, delete…)',
                    'Un middleware qui filtre les requêtes HTTP',
                    'Un outil de débogage intégré à Laravel',
                    'Un service de mise en cache des requêtes SQL',
                ],
            ]
        );

        Answer::firstOrCreate(['question_id' => $q5->id, 'text' => 'Une classe qui écoute les événements du modèle (create, update, delete…)'], ['is_correct' => true,  'order' => 1]);
        Answer::firstOrCreate(['question_id' => $q5->id, 'text' => 'Un middleware qui filtre les requêtes HTTP'],                                ['is_correct' => false, 'order' => 2]);
        Answer::firstOrCreate(['question_id' => $q5->id, 'text' => 'Un outil de débogage intégré à Laravel'],                                   ['is_correct' => false, 'order' => 3]);
        Answer::firstOrCreate(['question_id' => $q5->id, 'text' => 'Un service de mise en cache des requêtes SQL'],                              ['is_correct' => false, 'order' => 4]);

        $test2->questions()->syncWithoutDetaching([$q4->id, $q5->id]);
    }
}