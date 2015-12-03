<?php

use Illuminate\Database\Seeder;
use PHPHub\Topic;
use PHPHub\User;

class RepliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $replies = factory(PHPHub\Reply::class)->times(1000)->make();

        $user_ids = User::lists('id')->toArray();
        $topic_ids = Topic::lists('id')->toArray();

        foreach ($replies as $reply) {
            $reply->user_id = array_rand($user_ids, 1);
            $reply->topic_id = array_rand($topic_ids, 1);
            $reply->save();
        }
    }
}
