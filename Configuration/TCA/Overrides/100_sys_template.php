<?php

/*
 * This file is part of the package bk2k/bootstrap-package-config.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

/***************
 * TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'bootstrap_package_config',
    'Configuration/TypoScript',
    'Bootstrap Package Config'
);
