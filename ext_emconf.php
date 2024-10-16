<?php

/*
 * This file is part of the package bk2k/bootstrap-package-config.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

$EM_CONF[$_EXTKEY] = [
    'title' => 'Bootstrap Package Config',
    'description' => '',
    'category' => 'plugin',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-13.4.99',
            'bootstrap_package' => '*'
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'BK2K\\BootstrapPackageConfig\\' => 'Classes'
        ],
    ],
    'state' => 'stable',
    'author' => 'Benjamin Kott',
    'author_email' => 'info@bk2k.info',
    'author_company' => 'private',
    'version' => '1.0.0',
];
