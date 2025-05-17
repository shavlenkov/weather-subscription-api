<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Subscription;

class SubscriptionSeeder extends Seeder
{
    private const int SUBSCRIPTION_COUNT = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::factory(self::SUBSCRIPTION_COUNT)
            ->create();
    }
}
