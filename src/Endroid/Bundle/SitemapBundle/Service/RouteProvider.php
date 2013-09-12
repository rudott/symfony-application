<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\SitemapBundle\Service;

use Endroid\Bundle\RouteBundle\Entity\Route;
use Endroid\Bundle\RouteBundle\Service\RouteProviderInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class RouteProvider extends ContainerAware implements RouteProviderInterface
{
    public function getRoutes()
    {
        $routes = array();

        $routeHome = new Route();
        $routeHome->setLabel('Sitemap');
        $routeHome->setKey('endroid_sitemap_sitemap_index');
        $routeHome->setName('endroid_sitemap_sitemap_index');
        $routes['endroid_sitemap_sitemap_index'] = $routeHome;

        return $routes;
    }
}
