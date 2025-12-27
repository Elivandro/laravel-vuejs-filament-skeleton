<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tenant::factory()
            ->generateLogo()
            ->has(Domain::factory())
            ->hasUsers([
                'name' => 'user',
                'email' => 'user@email.com'
            ])
            ->create();

        Tenant::factory(8)
            ->generateLogo()
            ->has(Domain::factory())
            ->hasUsers(8)
            ->create();
    }
}
