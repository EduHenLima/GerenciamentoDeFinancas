<?php

use Illuminate\Database\Eloquent\Collection;
use Phinx\Seed\AbstractSeed;
use SONFin\Models\CategoryCosts;

class BillPaysSeeder extends AbstractSeed
{
    /**
     * @var Collection
     */
    private $categories;

    /** Generate fake date to test */
    public function run()
    {
        /** Call lib faker to create dates
         * $faker content all date to insert in database, click in Factory to see
         */
        require __DIR__ . '/../bootstrap.php';
        $this->categories = CategoryCosts::all();

        $faker = \Faker\Factory::create('pt_BR');
        $faker->addProvider($this);
        /** select tp table for fake date $categoryCost */
        $billPays = $this->table('bill_pays');

        $data = [];
        foreach (range(1,20) as $value){
            $userId = rand(1,4);
            $data[] = [
                'date_launch' => $faker->date(),
                'name' => $faker->word(),
                'value' => $faker->randomFloat(2,10,1000),
                'user_id' => $userId,
                'category_cost_id' => $faker->categoryId($userId),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $billPays->insert($data)->save();
    }

    public function categoryId($userId){
        $categories = $this->categories->where('user_id', $userId);
        $categories = $categories->pluck('id');
        return \Faker\Provider\Base::randomElement($categories->toArray());
    }
}
