<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Endroid\Bundle\MenuBundle\Entity\MenuItem;

class LoadMenuData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        // NL
        $menuMain = new MenuItem();
        $menuMain->setTag('Hoofdmenu');

        $menuSub = new MenuItem();
        $menuSub->setParent($menuMain);
        $menuSub->setRouteKey('endroid_page_page_show_1');

        $menuSub = new MenuItem();
        $menuSub->setParent($menuMain);
        $menuSub->setRouteKey('endroid_news_article_index');

        $menuSub = new MenuItem();
        $menuSub->setParent($menuMain);
        $menuSub->setRouteKey('endroid_page_page_show_3');

        $manager->persist($menuMain);

        $menuFooter = new MenuItem();
        $menuFooter->setTag('Footermenu');

        $menuSub = new MenuItem();
        $menuSub->setParent($menuFooter);
        $menuSub->setRouteKey('endroid_page_page_show_3');

        $menuSub = new MenuItem();
        $menuSub->setParent($menuFooter);
        $menuSub->setRouteKey('endroid_sitemap_sitemap_index');

        $manager->persist($menuFooter);

        $manager->flush();

        // EN
        $menuMain = new MenuItem();
        $menuMain->setTag('Main menu');

        $menuSub = new MenuItem();
        $menuSub->setParent($menuMain);
        $menuSub->setRouteKey('endroid_page_page_show_2');

        $menuSub = new MenuItem();
        $menuSub->setParent($menuMain);
        $menuSub->setRouteKey('endroid_news_article_index');

        $menuSub = new MenuItem();
        $menuSub->setParent($menuMain);
        $menuSub->setRouteKey('endroid_page_page_show_4');

        $manager->persist($menuMain);

        $menuFooter = new MenuItem();
        $menuFooter->setTag('Footer menu');

        $menuSub = new MenuItem();
        $menuSub->setParent($menuFooter);
        $menuSub->setRouteKey('endroid_page_page_show_4');

        $menuSub = new MenuItem();
        $menuSub->setParent($menuFooter);
        $menuSub->setRouteKey('endroid_sitemap_sitemap_index');

        $manager->persist($menuFooter);

        $manager->flush();
    }
}
