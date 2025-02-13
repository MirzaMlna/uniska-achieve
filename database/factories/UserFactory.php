<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Daftar program studi yang valid
        $studyPrograms = [
            'Ilmu Komunikasi',
            'Ilmu Administrasi Publik',
            'Pendidikan Bahasa Inggris',
            'Bimbingan dan Konseling',
            'Pendidikan Kimia',
            'Pendidikan Olah Raga',
            'Manajemen',
            'Peternakan',
            'Agribisnis',
            'Hukum Ekonomi Syari’ah',
            'Ekonomi Syari’ah',
            'Pendidikan Guru Madrasah Ibtidaiyah',
            'Teknik Mesin',
            'Teknik Sipil',
            'Teknik Elektro',
            'Teknik Industri',
            'Kesehatan Masyarakat',
            'Ilmu Hukum',
            'Teknik Informatika',
            'Sistem Informasi',
            'Farmasi',
        ];

        return [
            'name' => $this->faker->name(),
            'nim' => $this->faker->unique()->numerify('2#########'),
            'study_program' => $this->faker->randomElement($studyPrograms), // Memilih program studi secara acak dari daftar
            'role' => $this->faker->randomElement(['admin', 'student']),
            'is_approved' => $this->faker->boolean(50), // 70% chance of being approved
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
