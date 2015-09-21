<?php

namespace App\Models;

use App\Presenters\TopicPresenter;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\PresenterInterface;
use Prettus\Repository\Traits\PresentableTrait;

class Topic extends Model implements  PresenterInterface
{
    use PresentableTrait;

    protected $fillable = [];


    /**
     * Prepare data to present
     *
     * @param $data
     * @return mixed
     */
    public function present($data)
    {
        return TopicPresenter::class;
    }
}
