<?php

/*
 * This file is part of the package bk2k/bootstrap-package-config.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') || die();

/***************
 * TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'bootstrap_package_config',
    'Configuration/TypoScript',
    'Bootstrap Package Config'
);
