<?php

namespace Database\Factories;

use App\Models\CertificateType;
use App\Models\Doner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certificate>
 */
class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'certificate_image'=>'constants/certificates_images/certificate_image.webp',
            'certificate_date'=>$this->faker->dateTimeBetween('-20 years','-10 years'),
            'doner_id'=>Doner::factory(),
            'certificate_type_id'=>$this->faker->randomElement(CertificateType::query()->pluck('id')),
        ];
    }
}
