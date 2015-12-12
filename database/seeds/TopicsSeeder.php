<?php

use Illuminate\Database\Seeder;
use PHPHub\Node;
use PHPHub\User;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed normal topics
        $normal_topics = factory(PHPHub\Topic::class)->times(100)->make();
        $wiki_topics = factory(PHPHub\Topic::class, 'wiki')->times(20)->make();
        $excellent_topics = factory(PHPHub\Topic::class, 'excellent')->times(20)->make();

        $topics = array_merge($normal_topics->all(), $wiki_topics->all(), $excellent_topics->all());

        $user_ids = User::lists('id')->toArray();
        $node_ids = Node::lists('id')->toArray();

        foreach ($topics as $topic) {
            $topic->user_id = array_rand($user_ids, 1);
            $topic->node_id = array_rand($node_ids, 1);
            $topic->save();
        }
    }
}
