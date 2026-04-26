<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up(): void
    {
        $adminRole     = Role::firstOrCreate(['name' => 'admin']);
        $candidateRole = Role::firstOrCreate(['name' => 'candidate']);

        User::chunk(100, function ($users) use ($adminRole, $candidateRole) {
            foreach ($users as $user) {
                if ($user->hasAnyRole(['admin', 'candidate'])) {
                    continue;
                }
                $user->assignRole($user->is_admin ? $adminRole : $candidateRole);
            }
        });
    }

    public function down(): void
    {
        User::chunk(100, function ($users) {
            foreach ($users as $user) {
                $user->syncRoles([]);
            }
        });
    }
};