<?php

namespace App\Transformers;

use App\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Buyer $buyer)
    {
        return [
            'identifier' => (integer)$buyer->id,
            'name' => (string)$buyer->name,
            'email' => (string)$buyer->email,
            'isVerified' => (int)$buyer->verified,
            'creationData' => (string)$buyer->created_at,
            'lastChange' => (string)$buyer->updated_at,
            'deleteDate' => isset($buyer->deleted_at) ? (string)$buyer->deleted_at : null,

            // HATEOAS
            'links' => [
                [
                    'rel' => 'seft',
                    'href' => route('buyers.show', $buyer->id),
                ],
                [
                    'rel' => 'buyer.category',
                    'href' => route('buyers.categories.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.product',
                    'href' => route('buyers.products.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.seller',
                    'href' => route('buyers.sellers.index', $buyer->id),
                ],
                [
                    'rel' => 'buyer.transactions',
                    'href' => route('buyers.transactions.index', $buyer->id),
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
            'creationData' => 'created_at',
            'lastChange' => 'updated_at',
            'deleteDate' => 'deleted_at',
        ];

        return isset($attribule[$index]) ? $attribule[$index] : null;
    }
}
