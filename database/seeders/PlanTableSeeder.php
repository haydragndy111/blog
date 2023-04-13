<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name'        => 'Monthly PLan',
            'slug'        => 'monthly-plan',
            'stripe_name' => 'monthly',
            'stripe_price_id'   => 'price_1LqaZfDEXjDQV9D2U1X2Auh2',
            'stripe_product_id'   => 'prod_MZk3ayrXUCId4C',
            'price'       => 2,
            'abbreviation'=> '/month',
        ]);

        Plan::create([
            'name'        => 'Yearly PLan',
            'slug'        => 'yearly-plan',
            'stripe_name' => 'yearly',
            'stripe_price_id'   => 'price_1LqaaODEXjDQV9D21uFk9c3l',
            'stripe_product_id'   => 'prod_MZk4Z9x67m7PU5',
            'price'       => 20,
            'abbreviation'=> '/yearly',
        ]);
    }
}
