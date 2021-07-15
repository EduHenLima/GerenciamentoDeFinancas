<?php

use Phinx\Seed\AbstractSeed;

class CategoryCostSeeder extends AbstractSeed
{

    /** Generate fake date to test */
    public function run()
    {
        /** select tp table for fake date $categoryCost */
        $categoryCost = $this->table('category_costs');
        $categoryCost->insert([
            /** Array with fake params */
            [
                'name' => 'Category 1',
                'created_at' => date('Y-m-d H:i:s'),
                'update_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Category 2',
                'created_at' => date('Y-m-d H:i:s'),
                'update_at' => date('Y-m-d H:i:s')
            ]
        ])->save();
    }
}
