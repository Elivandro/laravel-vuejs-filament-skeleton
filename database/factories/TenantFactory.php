<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
final class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'                      => fake()->name,
            'description'               => fake()->text(20),
            'logo'                      => 'logo.png',
        ];
    }

    public function generateLogo(): Factory
    {
        $url = 'https://w7.pngwing.com/pngs/402/36/png-transparent-lorem-ipsum-logo-font-ofset-text-logo-integer.png';
        $tempFilePath = sys_get_temp_dir() . '/' . uniqid('logo_', true) . '.png';

        Http::sink($tempFilePath)->get($url);

        $storedPath = Storage::disk('s3')->putFile('logos', new File($tempFilePath), 'public');
        $publicUrl = Storage::disk('s3')->url($storedPath);

        return $this->state(fn() => [
            'logo' => $publicUrl,
        ]);
    }
}
