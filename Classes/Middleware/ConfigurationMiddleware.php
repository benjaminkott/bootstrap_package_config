<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package-config.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackageConfig\Middleware;

use BK2K\BootstrapPackageConfig\Service\ConfigurationService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Site\Entity\SiteSettings;

class ConfigurationMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly ConfigurationService $configurationService
    ) {}

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $site = $request->getAttribute('site');
        if (!$site instanceof Site) {
            return $handler->handle($request);
        }

        if (!in_array('bootstrap-package-config', $site->getSets(), true)) {
            return $handler->handle($request);
        }

        $queryParams = $request->getQueryParams();
        $color = $queryParams['color'] ?? null;
        $font = $queryParams['font'] ?? null;

        if ($color === null && $font === null) {
            return $handler->handle($request);
        }

        $settingsOverrides = [];

        if ($color !== null) {
            $colorHex = $this->configurationService->getColorHex($color);
            if ($colorHex !== null) {
                $settingsOverrides['plugin']['bootstrap_package']['settings']['scss']['primary'] = $colorHex;
            }
        }

        if ($font !== null) {
            $fontName = $this->configurationService->getFontName($font);
            if ($fontName !== null) {
                $settingsOverrides['page']['theme']['googleFont']['font'] = $fontName;
            }
        }

        if ($settingsOverrides !== []) {
            $currentSettings = $site->getSettings()->getAll();
            $mergedSettings = array_replace_recursive($currentSettings, $settingsOverrides);

            $newSettings = SiteSettings::createFromSettingsTree($mergedSettings);
            $newSite = new Site(
                $site->getIdentifier(),
                $site->getRootPageId(),
                $site->getConfiguration(),
                $newSettings,
                $site->getTypoScript(),
                $site->getTSconfig()
            );
            $request = $request->withAttribute('site', $newSite);
        }

        return $handler->handle($request);
    }
}
