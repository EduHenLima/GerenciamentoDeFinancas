<?php

use Phinx\Seed\AbstractSeed;

class CategoryCostSeeder extends AbstractSeed
{

    /** Generate fake date to test */
    public function run()
    {
        /** Call lib faker to create dates
         * $faker content all date to insert in database, click in Factory to see
         */
        $faker = \Faker\Factory::create('pt_BR');

        /** select tp table for fake date $categoryCost */
        $categoryCost = $this->table('category_costs');

        $data = [];
        foreach (range(1,10) as $value){
            $data[] = [
                'name' => $faker->name,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $categoryCost->insert($data)->save();
    }
}
