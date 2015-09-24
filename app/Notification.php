<?php

namespace PHPHub;

use Illuminate\Database\Eloquent\Model;
use PHPHub\Presenters\NotificationPresenter;
use Prettus\Repository\Contracts\PresenterInterface;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Notification extends Model implements PresenterInterface
{

    protected $fillable = [];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * Prepare data to present
     *
     * @param $data
     * @return mixed
     */
    public function present($data){
        return NotificationPresenter::class;
    }
}
