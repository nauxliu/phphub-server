<?php
namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public $availableIncludes = [];
    public $defaultIncludes = [];

    public function transform(\App\Models\User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar,
        ];
    }
}