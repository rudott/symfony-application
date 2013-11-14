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
use Endroid\Bundle\UserBundle\Model\UserManager;
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
        $adminGroup = new Group('admin');
        $adminGroup->addRole('ROLE_SUPER_ADMIN');
        $manager->persist($adminGroup);

        $userGroup = new Group('client');
        $userGroup->addRole('ROLE_ADMIN');
        $manager->persist($userGroup);

        /** @var UserManager $userManager */
        $userManager = $this->container->get('fos_user.user_manager');

        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@admin');
        $user->addGroup($adminGroup);
        $user->setEnabled(true);
        $user->setPlainPassword('admin');
        $userManager->updatePassword($user);
        $manager->persist($user);

        $user = new User();
        $user->setUsername('client');
        $user->setEmail('client@client');
        $user->addGroup($userGroup);
        $user->setEnabled(true);
        $user->setPlainPassword('client');
        $userManager->updatePassword($user);
        $manager->persist($user);

        $manager->flush();
    }
}
