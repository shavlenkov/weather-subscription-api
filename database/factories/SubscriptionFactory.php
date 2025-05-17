<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Services\TokenService;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    private const int MIN_DAYS_AGO = 1;
    private const int MAX_DAYS_AGO = 7;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'city' => $this->faker->randomElement([
                'Kyiv', 'Lviv', 'Kharkiv', 'Poltava', 'Sumy', 'Kherson', 'Zaporizhzhia'
            ]),
            'frequency' => $this->faker->randomElement(['hourly', 'daily']),
            'confirmed' => true,
            'last_report_date' => now()->subDays($this->faker->numberBetween(self::MIN_DAYS_AGO, self::MAX_DAYS_AGO)),
            'token' => app(TokenService::class)->generateToken(),
        ];
    }
}
