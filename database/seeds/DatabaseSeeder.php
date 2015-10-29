<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersSeeder::class);
        $this->call(TopicsSeeder::class);
        $this->call(RepliesSeeder::class);

        Model::reguard();
    }
}
