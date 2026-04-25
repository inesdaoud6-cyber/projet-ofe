<?php

namespace Database\Seeders;

use App\Models\ApplicationProgress;
use App\Models\Candidate;
use App\Models\Offre;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CandidateSeeder extends Seeder
{
    public function run(): void
    {
        $offre = Offre::where('is_published', true)->first();

        $candidatesData = [
            [
                'name'       => 'Amine Trabelsi',
                'email'      => 'amine.trabelsi@demo.com',
                'first_name' => 'Amine',
                'last_name'  => 'Trabelsi',
            ],
            [
                'name'       => 'Sarra Ben Ali',
                'email'      => 'sarra.benali@demo.com',
                'first_name' => 'Sarra',
                'last_name'  => 'Ben Ali',
            ],
            [
                'name'       => 'Khalil Mansour',
                'email'      => 'khalil.mansour@demo.com',
                'first_name' => 'Khalil',
                'last_name'  => 'Mansour',
            ],
        ];

        foreach ($candidatesData as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'     => $data['name'],
                    'password' => Hash::make('Demo2026!'),
                    'is_admin' => false,
                ]
            );

            $user->assignRole('candidate');

            $candidate = Candidate::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'first_name' => $data['first_name'],
                    'last_name'  => $data['last_name'],
                    'email'      => $data['email'],
                ]
            );

            if ($offre) {
                ApplicationProgress::firstOrCreate(
                    ['candidate_id' => $candidate->id, 'offre_id' => $offre->id],
                    [
                        'status'          => 'pending',
                        'current_level'   => 1,
                        'main_score'      => 0,
                        'secondary_score' => 0,
                        'test_id'         => $offre->test_id,
                        'is_archived'     => false,
                    ]
                );
            }
        }
    }
}