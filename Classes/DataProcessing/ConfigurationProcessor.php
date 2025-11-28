<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package-config.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackageConfig\DataProcessing;

use BK2K\BootstrapPackageConfig\Service\ConfigurationService;
use Symfony\Component\Yaml\Yaml;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

class ConfigurationProcessor implements DataProcessorInterface
{
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): array {
        $configurationService = GeneralUtility::makeInstance(ConfigurationService::class);
        $request = $cObj->getRequest();
        $queryParams = $request->getQueryParams();

        $processedData['colors'] = $configurationService->getColors();
        $processedData['fonts'] = $configurationService->getFonts();

        // Validate and set current color (only if it's a valid value)
        $colorParam = $queryParams['color'] ?? null;
        $processedData['currentColor'] = null;
        if ($colorParam !== null && $configurationService->getColorByValue($colorParam) !== null) {
            $processedData['currentColor'] = $colorParam;
        }

        // Validate and set current font (only if it's a valid value)
        $fontParam = $queryParams['font'] ?? null;
        $processedData['currentFont'] = null;
        if ($fontParam !== null && $configurationService->getFontByValue($fontParam) !== null) {
            $processedData['currentFont'] = $fontParam;
        }

        // Get current config from site settings
        $processedData['currentConfig'] = $this->getCurrentConfig($request);

        return $processedData;
    }

    private function getCurrentConfig($request): string
    {
        $site = $request->getAttribute('site');
        if (!$site instanceof Site) {
            return '';
        }

        $settings = $site->getSettings();
        $config = [];

        $primaryColor = $settings->get('plugin.bootstrap_package.settings.scss.primary');
        if ($primaryColor !== null) {
            $config['plugin.bootstrap_package.settings.scss.primary'] = $primaryColor;
        }

        $googleFont = $settings->get('page.theme.googleFont.font');
        if ($googleFont !== null) {
            $config['page.theme.googleFont.font'] = $googleFont;
        }

        return Yaml::dump($config, 10, 2);
    }
}
