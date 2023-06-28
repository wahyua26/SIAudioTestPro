<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(20)->create();

        \App\Models\User::factory()->create([
            'name' => 'Budi Pratama',
            'email' => 'budipratama@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => 'admin',
            'jabatan_id' => 1,
            'foto' => 'avatar5.png',
        ]);

        \App\Models\Workspace::factory()->create([
            'nama' => 'Ruang Produksi',
        ]);

        \App\Models\Workspace::factory()->create([
            'nama' => 'Ruang Distribusi',
        ]);

        \App\Models\Jabatan::factory()->create([
            'jabatan' => 'Staff Distribusi',
            'divisi' => 'Distribution',
            'workspace_id' => 2,
        ]);

        \App\Models\Jabatan::factory()->create([
            'jabatan' => 'Manajer Distribusi',
            'divisi' => 'Distribution',
            'workspace_id' => 2,
        ]);

        \App\Models\Jabatan::factory()->create([
            'jabatan' => 'Staff Produksi',
            'divisi' => 'Production',
            'workspace_id' => 1,
        ]);

        \App\Models\Jabatan::factory()->create([
            'jabatan' => 'Manajer Produksi',
            'divisi' => 'Production',
            'workspace_id' => 1,
        ]);
    }
}
