<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\NewsBundle\Service;

use Endroid\Bundle\RouteBundle\Entity\Route;
use Endroid\Bundle\RouteBundle\Service\RouteProviderInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class RouteProvider extends ContainerAware implements RouteProviderInterface
{
    public function getRoutes()
    {
        $routes = array();

        $articles = $this->container->get('doctrine')->getRepository('EndroidNewsBundle:Article')->findAll();

        $routeList = new Route();
        $routeList->setLabel(($this->container->get('request')->getLocale() == 'nl') ? 'Nieuws' : 'News');
        $routeList->setKey('endroid_news_article_index');
        $routeList->setName('endroid_news_article_index');
        $routes['endroid_news_article_index'] = $routeList;

        foreach ($articles as $article) {
            $routeDetail = new Route();
            $routeDetail->setLabel($article->getTitle());
            $routeDetail->setKey('endroid_news_article_show_'.$article->getId());
            $routeDetail->setName('endroid_news_article_show');
            $routeDetail->setParameters(array('slug' => $article->getSlug()));
            $routes['endroid_news_article_show_'.$article->getId()] = $routeDetail;
        }

        return $routes;
    }
}
