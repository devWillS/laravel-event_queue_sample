<?php

declare(strict_types=1);

namespace App\DataProvider\Elasticsearch;

use App\Foundation\ElasticsearchClient;
use App\DataProvider\AddReviewIndexProviderInterface;

class AddReviewIndexDataProvider implements AddReviewIndexProviderInterface
{
    private $client;

    public function __construct(ElasticsearchClient $client)
    {
        $this->client = $client;
    }

    public function add(
        int $id,
        string $title,
        string $content,
        string $epoch,          
        array $tags,
        int $userId
    ): array {
        $params = [
            'index' => 'reviews',
            'id' => sprintf('review:%s', $id),
            'body' => [
                'review_id' => $id,
                'title' => $title,
                'content' => $content,
                'tags' => array_map(function (string $value) {
                    return ['tag_name' => $value];
                }, $tags),
                'user_id' => $userId,
                'created_at' => $epoch
            ]
        ];
        return $this->client->client()->index($params);
    }
}
