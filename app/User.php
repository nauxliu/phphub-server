<?php

namespace App;

use App\Presenters\UserPresenter;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\PresenterInterface;
use Prettus\Repository\Traits\PresentableTrait;

class User extends Model implements PresenterInterface
{
    use PresentableTrait;

    public static $includable = ['id', 'name', 'avatar'];
    protected $fillable       = [];

    /**
     * Prepare data to present.
     *
     * @param $data
     *
     * @return mixed
     */
    public function present($data)
    {
        return UserPresenter::class;
    }
}
