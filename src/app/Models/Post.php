<?php

namespace App\Models;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use ElasticquentTrait, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'author',
    ];

    public function getIndexName()
    {
        return 'posts';
    }

    protected $mapping = [
        'properties' => [
            'title' => [
                'type' => 'text',
                'analyzer' => 'standard',
            ],
            'content' => [
                'type' => 'text'
            ],
            'author' => [
                'type' => 'text'
            ]
        ]
    ];
}
