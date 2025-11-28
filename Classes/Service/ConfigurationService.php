<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package-config.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackageConfig\Service;

class ConfigurationService
{
    private const COLORS = [
        'blue' => [
            'name' => 'Blue',
            'value' => 'blue',
            'color' => '#007bff',
        ],
        'indigo' => [
            'name' => 'Indigo',
            'value' => 'indigo',
            'color' => '#6610f2',
        ],
        'purple' => [
            'name' => 'Purple',
            'value' => 'purple',
            'color' => '#6f42c1',
        ],
        'pink' => [
            'name' => 'Pink',
            'value' => 'pink',
            'color' => '#e83e8c',
        ],
        'red' => [
            'name' => 'Red',
            'value' => 'red',
            'color' => '#dc3545',
        ],
        'orange' => [
            'name' => 'Orange',
            'value' => 'orange',
            'color' => '#fd7e14',
        ],
        'yellow' => [
            'name' => 'Yellow',
            'value' => 'yellow',
            'color' => '#ffc107',
        ],
        'green' => [
            'name' => 'Green',
            'value' => 'green',
            'color' => '#28a745',
        ],
        'teal' => [
            'name' => 'Teal',
            'value' => 'teal',
            'color' => '#20c997',
        ],
        'cyan' => [
            'name' => 'Cyan',
            'value' => 'cyan',
            'color' => '#17a2b8',
        ],
    ];

    private const FONTS = [
        'lora' => [
            'name' => 'Lora',
            'value' => 'lora',
        ],
        'merriweather' => [
            'name' => 'Merriweather',
            'value' => 'merriweather',
        ],
        'nunito' => [
            'name' => 'Nunito',
            'value' => 'nunito',
        ],
        'raleway' => [
            'name' => 'Raleway',
            'value' => 'raleway',
        ],
        'roboto' => [
            'name' => 'Roboto',
            'value' => 'roboto',
        ],
        'source-sans-pro' => [
            'name' => 'Source Sans Pro',
            'value' => 'source-sans-pro',
        ],
        'quattrocento' => [
            'name' => 'Quattrocento',
            'value' => 'quattrocento',
        ],
        'ubuntu' => [
            'name' => 'Ubuntu',
            'value' => 'ubuntu',
        ],
    ];

    public function getColors(): array
    {
        return self::COLORS;
    }

    public function getFonts(): array
    {
        return self::FONTS;
    }

    public function getColorByValue(string $value): ?array
    {
        return self::COLORS[$value] ?? null;
    }

    public function getFontByValue(string $value): ?array
    {
        return self::FONTS[$value] ?? null;
    }

    public function getColorHex(string $value): ?string
    {
        return self::COLORS[$value]['color'] ?? null;
    }

    public function getFontName(string $value): ?string
    {
        return self::FONTS[$value]['name'] ?? null;
    }
}
