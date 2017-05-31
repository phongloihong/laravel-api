<?php

namespace App\Transformers;

use App\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'identifier' => (int)$category->id,
            'title' => (string)$category->name,
            'detailts' => (string)$category->description,
            'creationData' => (string)$category->created_at,
            'lastChange' => (string)$category->updated_at,
            'deleteDate' => isset($category->deleted_at) ? (string)$category->deleted_at : null,

            // HATEOAS
            'links' => [
                [
                    'rel' => 'seft',
                    'href' => route('categories.show', $category->id),
                ],
                [
                    'rel' => 'categories.buyers',
                    'href' => route('categories.buyers.index', $category->id),
                ],
                [
                    'rel' => 'categories.products',
                    'href' => route('categories.products.index', $category->id),
                ],
                [
                    'rel' => 'categories.sellers',
                    'href' => route('categories.sellers.index', $category->id),
                ],
                [
                    'rel' => 'categories.transactions',
                    'href' => route('categories.transactions.index', $category->id),
                ]
            ],
        ];
    }

    public static function originalAttribute($index) {
        $attribule = [
            'identifier' => 'id',
            'title' => 'name',
            'detailts' => 'description',
            'creationData' => 'created_at',
            'lastChange' => 'updated_at',
            'deleteDate' => 'deleted_at',
        ];

        return isset($attribule[$index]) ? $attribule[$index] : null;
    }
}
