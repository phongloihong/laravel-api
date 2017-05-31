<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identifier' => (int)$user->id,
            'name' => (string)$user->name,
            'email' => (string)$user->email,
            'isVerified' => (int)$user->verified,
            'isAdmin' => ($user->admin === 'true'),
            'creationData' => (string)$user->created_at,
            'lastChange' => (string)$user->updated_at,
            'deleteDate' => isset($user->deleted_at) ? (string)$user->deleted_at : null,

            // HATEOAS
            'links' => [
                [
                    'rel' => 'seft',
                    'href' => route('users.show', $user->id),
                ],
            ],
        ];
    }

    public static function originalAttribute($index) {
        $attribule = [
            'identifier' => 'id',
            'name' => 'name',
            'email' => 'email',
            'isVerified' => 'verified',
            'isAdmin' => 'admin',
            'creationData' => 'created_at',
            'lastChange' => 'updated_at',
            'deleteDate' => 'deleted_at',
        ];

        return isset($attribule[$index]) ? $attribule[$index] : null;
    }
}
