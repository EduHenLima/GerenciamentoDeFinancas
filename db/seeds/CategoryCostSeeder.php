<?php

use Phinx\Seed\AbstractSeed;

class CategoryCostSeeder extends AbstractSeed
{
    const NAMES = [
        'Telefone',
        'Supermercado',
        'Agua',
        'Escola',
        'Cartão',
        'Luz',
        'IPVA',
        'Imposto de Renda',
        'Gasolina',
        'Vestuário',
        'Entretenimento',
        'Reparos',
    ];

    /** Generate fake date to test */
    public function run()
    {

        /** Call lib faker to create dates
         * $faker content all date to insert in database, click in Factory to see
         */
        $faker = \Faker\Factory::create('pt_BR');
        $faker->addProvider($this);
        /** select tp table for fake date $categoryCost */
        $categoryCost = $this->table('category_costs');

        $data = [];
        foreach (range(1,20) as $value){
            $data[] = [
                'name' => $faker->categoryName(),
                'user_id' => rand(1,4),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $categoryCost->insert($data)->save();
    }

    public function categoryName(){
        return \Faker\Provider\Base::randomElement(self::NAMES);
    }
}
