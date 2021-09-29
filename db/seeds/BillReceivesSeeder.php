<?php

use Phinx\Seed\AbstractSeed;

class BillReceivesSeeder extends AbstractSeed
{
    const NAMES = [
        'Salario',
        'Bico',
        'REstituicao de importo',
        'Vendas de produtos',
        'bolsa de valores',
        'CDI',
        'Tesouro direto',
        'Previdencia privada'
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
        $billReceives = $this->table('bill_receives');

        $data = [];
        foreach (range(1,20) as $value){
            $data[] = [
                'date_launch' => $faker->date(),
                'name' => $faker->billReceivesName(),
                'value' => $faker->randomFloat(2,10,1000),
                'user_id' => rand(1,4),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $billReceives->insert($data)->save();
    }

    public function billReceivesName(){
        return \Faker\Provider\Base::randomElement(self::NAMES);
    }
}
