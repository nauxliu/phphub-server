<?php

namespace PHPHub\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use PHPHub\Topic;
use Purifier;

/**
 * 保存帖子，同时生成摘要，解析 markdown etc..
 */
class SaveTopic extends Job implements SelfHandling
{
    /**
     * @var Topic
     */
    private $topic;

    /**
     * Create a new job instance.
     *
     * @param Topic $topic
     */
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $this->topic->title = Purifier::clean($this->topic->title, 'title');
        $this->topic->body_original = Purifier::clean(trim($this->topic->body), 'body');
        $this->topic->body = app('markdown')->text($this->topic->body_original);
        $this->topic->excerpt = $this->excerpt($this->topic->body_original);

        $this->topic->save();

        return $this->topic;
    }

    /**
     * 生成正文摘要.
     *
     * @param $body
     *
     * @return string
     */
    protected function excerpt($body)
    {
        $excerpt = trim(preg_replace('/\s+/', ' ', strip_tags($body)));

        return str_limit($excerpt, 200);
    }
}
