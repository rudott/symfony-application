<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\UserBundle\Model;

use Endroid\Bundle\BehaviorBundle\DependencyInjection\ContainerAwareTrait;
use Endroid\Bundle\UserBundle\Entity\User;
use FOS\UserBundle\Entity\UserManager as FOSUserManager;
use FOS\UserBundle\Util\TokenGenerator;
use Fp\OpenIdBundle\Security\Core\User\UserManagerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserManager extends FOSUserManager implements UserManagerInterface, ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * Creates a new user from the OpenID login.
     *
     * @param  string        $identity
     * @param  array         $attributes
     * @return UserInterface
     */
    public function createUserFromIdentity($identity, array $attributes = array())
    {
        $user = $this->em->getRepository('EndroidUserBundle:User')->findOneByEmail($attributes['contact/email']);

        if ($user) {
            return $user;
        }

        $user = new User();
        $user->setUsername($attributes['contact/email']);
        $user->setEmail($attributes['contact/email']);
        $user->setFirstName($attributes['namePerson/first']);
        $user->setLastName($attributes['namePerson/last']);
        $user->setEnabled(true);

        $group = $this->em->getRepository('EndroidUserBundle:Group')->findOneByName('admin');
        $user->addGroup($group);

        /** @var TokenGenerator $tokenGenerator */
        $tokenGenerator = $this->container->get('fos_user.util.token_generator');
        $password = substr($tokenGenerator->generateToken(), 0, 8);
        $user->setPlainPassword($password);

        $this->updatePassword($user);

        return $user;
    }
}
