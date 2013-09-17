<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Admin\Extension;

use Doctrine\ORM\EntityManager;
use Endroid\Bundle\BehaviorBundle\DependencyInjection\ContainerAwareTrait;
use Endroid\Bundle\BehaviorBundle\Model\TranslationInterface;
use Sonata\AdminBundle\Admin\AdminExtension;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class TranslationAdminExtension extends AdminExtension implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * Configure list fields.
     *
     * @param ListMapper $listMapper
     */
    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('translations', 'string', array(
                'label' => 'admin.behavior.translatable.translations',
                'template' => 'EndroidBehaviorBundle:Admin:translations.html.twig'
            ))
        ;
    }

    /**
     * Handles new instance creation.
     *
     * @param AdminInterface $admin
     * @param TranslationInterface $object
     */
    public function alterNewInstance(AdminInterface $admin, $object)
    {
        $translatableClass = $admin->getClass().'Translatable';
        $translatableId = $this->container->get('request')->query->get('translatable');
        if ($translatableId) {
            $translatable = $this->container->get('doctrine')->getRepository($translatableClass)->findOneById($translatableId);
        } else {
            $translatable = new $translatableClass();
        }

        $object->setLocale($this->container->get('request')->query->get('locale'));
        $object->setTranslatable($translatable);
    }
}
