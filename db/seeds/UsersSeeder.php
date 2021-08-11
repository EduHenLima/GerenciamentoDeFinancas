<?php

use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{

    /** Generate fake date to test */
    public function run()
    {
        /** Call lib faker to create dates
         * $faker content all date to insert in database, click in Factory to see
         */
        $faker = \Faker\Factory::create('pt_BR');

        /** select tp table for fake date $categoryCost */
        $users = $this->table('users');
        $users->insert([
            'firstname' => $faker->firstName,
            'lastname' => $faker->lastName,
            'email' => 'admin@user.com',
            'password' => '123456',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ])->save();

        $data = [];
        foreach (range(1,5) as $value){
            $data[] = [
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => '123456',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $users->insert($data)->save();
    }
}
