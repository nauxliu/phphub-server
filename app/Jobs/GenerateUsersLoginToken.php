<?php

namespace App\Jobs;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;

class GenerateUsersLoginToken extends Job implements SelfHandling
{
    /**
     * @var int|int
     */
    private $user_id;

    /**
     * Create a new command instance.
     *
     * @param int $user_id
     */
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Execute the command.
     *
     * @param UserRepositoryInterface $repository
     */
    public function handle(UserRepositoryInterface $repository)
    {
        //TODO: 生成二维码并保存
        $model = $repository
            ->skipPresenter()
            ->find($this->user_id);

        $model->login_token = str_random(20);
        $model->save();

        return $model->login_token;
    }
}
