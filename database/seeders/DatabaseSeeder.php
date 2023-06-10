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
            'jabatan' => 'Manajer Produksi',
            'status' => 'admin',
        ]);

        \App\Models\Workspace::factory()->create([
            'nama' => 'Ruang Produksi',
        ]);

        \App\Models\Workspace::factory()->create([
            'nama' => 'Ruang Distribusi',
        ]);

        \App\Models\Audiometri::factory()->create([
            'user_id' => 1,
            'hasil' => 'Tuli Ringan',
            'risiko' => 'Tidak Berisiko',
        ]);

        \App\Models\Audiometri::factory()->create([
            'user_id' => 12,
            'hasil' => 'Tuli Sedang',
            'risiko' => 'Berisiko Sedang',
        ]);

        \App\Models\Audiometri::factory()->create([
            'user_id' => 17,
            'hasil' => 'Tuli Berat',
            'risiko' => 'Berisiko Tinggi',
        ]);
    }
}
