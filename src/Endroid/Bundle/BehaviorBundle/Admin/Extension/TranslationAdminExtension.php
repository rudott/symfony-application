<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Admin\Extension;

use Endroid\Bundle\BehaviorBundle\DependencyInjection\ContainerAwareTrait;
use Sonata\AdminBundle\Admin\AdminExtension;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class TranslationAdminExtension extends AdminExtension implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function alterNewInstance(AdminInterface $admin, $object)
    {
        $translatableClass = $admin->getClass().'Translatable';
        $translatable = new $translatableClass();

        $object->setLocale($this->container->get('request')->query->get('locale'));
        $object->setTranslatable($translatable);
    }
}
