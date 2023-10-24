<?php declare(strict_types=1);

use Hillel\Project\Core\Web\Controllers\ShortenerController;

return [
    'shortener' => [
        ShortenerController::class => [
            'index' => [],
        ],
    ],
    'shortener/decode' => [
        ShortenerController::class => [
            'decode' => ['code'],
        ],
    ],
    'shortener/encode' => [
        ShortenerController::class => [
            'encode' => ['url'],
        ],
    ],
];
