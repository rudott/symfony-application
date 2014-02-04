<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\RestBundle\Controller;

use Endroid\Bundle\UserBundle\Entity\User;
use Endroid\Bundle\UserBundle\Model\UserInterface;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends FOSRestController
{
    /**
     * Get single User.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a User for a given id",
     *   output = "Endroid\Bundle\UserBundle\Entity\User",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="user")
     *
     * @param int $id the user id
     *
     * @return array
     *
     * @throws NotFoundHttpException when user not exist
     */
    public function getUserAction($id)
    {
        $user = $this->getOr404($id);

        return $user;
    }

    /**
     * Fetch a User or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return UserInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        $user = $this->container->get('endroid_user.user.handler')->get($id);

        if (!$user instanceof UserInterface) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }

        return $user;
    }
}
