<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use PHPHub\Jobs\SaveTopic;
use PHPHub\Node;
use PHPHub\User;

class TopicsSeeder extends Seeder
{
    use DispatchesJobs;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed normal topics
        $topics = factory(PHPHub\Topic::class)->times(100)->make();

        $user_ids = User::lists('id')->toArray();
        $node_ids = Node::lists('id')->toArray();

        foreach ($topics as $topic) {
            $topic->user_id = array_rand($user_ids, 1);
            $topic->node_id = array_rand($node_ids, 1);
            $this->dispatch(new SaveTopic($topic));
        }

        // Seed excellent topics
        $topics = factory(PHPHub\Topic::class)->times(20)->make();

        foreach ($topics as $topic) {
            $topic->user_id      = array_rand($user_ids, 1);
            $topic->node_id      = array_rand($node_ids, 1);
            $topic->is_excellent = true;
            $this->dispatch(new SaveTopic($topic));
        }

        // Seed wiki topics
        $topics = factory(PHPHub\Topic::class)->times(20)->make();

        foreach ($topics as $topic) {
            $topic->user_id = array_rand($user_ids, 1);
            $topic->node_id = array_rand($node_ids, 1);
            $topic->is_wiki = true;
            $this->dispatch(new SaveTopic($topic));
        }
    }
}
