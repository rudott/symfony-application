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
use Endroid\Bundle\UserBundle\Entity\User;
use Endroid\Bundle\UserBundle\Entity\Group;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements ContainerAwareInterface
{
    /**
     * @var
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $group = new Group('super-admin');
        $group->addRole('ROLE_SUPER_ADMIN');

        $manager->persist($group);

        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@admin');
        $user->addGroup($group);
        $user->setEnabled(true);
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        $user->setPassword($encoder->encodePassword('admin'));

        $manager->persist($user);

        $group = new Group('client-admin');
        $group->addRole('ROLE_ADMIN');

        $manager->persist($group);

        $user = new User();
        $user->setUsername('client');
        $user->setEmail('client@client');
        $user->addGroup($group);
        $user->setEnabled(true);
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        $user->setPassword($encoder->encodePassword('client'));

        $manager->persist($user);

        $manager->flush();
    }
}
