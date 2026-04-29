<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MigrateUserRoles extends Command
{
    protected $signature = 'roles:migrate';
    protected $description = 'Assigne les rôles Spatie aux users existants sans rôle';

    public function handle(): void
    {
        User::all()->each(function (User $user) {
            if ($user->getRoleNames()->isEmpty()) {
                $user->assignRole($user->is_admin ? 'admin' : 'candidate');
            }
        });

        $this->info('Rôles migrés avec succès.');
    }
}