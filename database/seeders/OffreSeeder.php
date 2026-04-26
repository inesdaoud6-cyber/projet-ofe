<?php

namespace Database\Seeders;

use App\Models\Offre;
use App\Models\Test;
use Illuminate\Database\Seeder;

class OffreSeeder extends Seeder
{
    public function run(): void
    {
        $testPhp     = Test::where('name', 'Test PHP Junior')->first();
        $testLaravel = Test::where('name', 'Test Laravel Senior')->first();

        Offre::firstOrCreate(
            ['title' => 'Développeur PHP Junior'],
            [
                'description'   => 'Nous recherchons un développeur PHP junior motivé pour rejoindre notre équipe technique et contribuer à des projets innovants.',
                'domain'        => 'Développement Web',
                'location'      => 'Tunis',
                'contract_type' => 'CDI',
                'deadline'      => now()->addMonths(2),
                'is_published'  => true,
                'test_id'       => $testPhp?->id,
            ]
        );

        Offre::firstOrCreate(
            ['title' => 'Développeur Laravel Senior'],
            [
                'description'   => 'Poste senior pour un profil expérimenté en Laravel, architecture logicielle et bonnes pratiques de développement.',
                'domain'        => 'Développement Web',
                'location'      => 'Sfax',
                'contract_type' => 'CDI',
                'deadline'      => now()->addMonths(3),
                'is_published'  => true,
                'test_id'       => $testLaravel?->id,
            ]
        );

        Offre::firstOrCreate(
            ['title' => 'Stage Développement Full Stack'],
            [
                'description'   => 'Stage de 6 mois pour étudiant en informatique souhaitant acquérir une expérience professionnelle concrète.',
                'domain'        => 'Développement Web',
                'location'      => 'Tunis',
                'contract_type' => 'Stage',
                'deadline'      => now()->addMonths(1),
                'is_published'  => true,
                'test_id'       => $testPhp?->id,
            ]
        );

        Offre::firstOrCreate(
            ['title' => 'Chef de Projet IT'],
            [
                'description'   => 'Pilotage de projets informatiques, coordination des équipes techniques et suivi de la relation client.',
                'domain'        => 'Management',
                'location'      => 'Tunis',
                'contract_type' => 'CDI',
                'deadline'      => now()->addMonths(2),
                'is_published'  => false,
                'test_id'       => null,
            ]
        );
    }
}