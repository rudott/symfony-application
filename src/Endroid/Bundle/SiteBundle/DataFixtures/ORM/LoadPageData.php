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
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Endroid\Bundle\PageBundle\Entity\Page;
use Endroid\Bundle\PageBundle\Entity\PageTranslatable;

class LoadPageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $pageTranslatable = new PageTranslatable();

        $page = new Page();
        $page->setTitle('Over ons');
        $page->setContent('<p>Inhoud over ons</p>');
        $page->setLocale('nl');
        $pageTranslatable->addTranslation($page);

        $page = new Page();
        $page->setTitle('About us');
        $page->setContent('<p>About us content</p>');
        $page->setLocale('en');
        $pageTranslatable->addTranslation($page);

        $manager->persist($pageTranslatable);

        $pageTranslatable = new PageTranslatable();

        $page = new Page();
        $page->setTitle('Contact');
        $page->setContent('<p>Inhoud contact</p>');
        $page->setLocale('nl');
        $pageTranslatable->addTranslation($page);

        $page = new Page();
        $page->setTitle('Contact');
        $page->setContent('<p>Contact page content</p>');
        $page->setForm($manager->merge($this->getReference('form_contact')));
        $page->setLocale('en');
        $pageTranslatable->addTranslation($page);

        $manager->persist($pageTranslatable);

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 4;
    }
}
