<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\AdminBundle\Admin;

use Endroid\Bundle\BehaviorBundle\DependencyInjection\ContainerAwareTrait;
use ReflectionClass;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Sonata\AdminBundle\Route\RouteCollection;

class BaseAdmin extends Admin implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    protected function configureListFields(ListMapper $listMapper)
    {
        $reflectionClass = new \ReflectionClass($this->getClass());

        if ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\SortableInterface')) {
            $listMapper
                ->add('up', 'string', array('label' => ' ', 'template' => 'EndroidMenuBundle:MenuItemAdmin:list_field_up.html.twig'))
                ->add('down', 'string', array('label' => ' ', 'template' => 'EndroidMenuBundle:MenuItemAdmin:list_field_down.html.twig'))
            ;
        }
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $reflectionClass = new ReflectionClass($this->getClass());

        if ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\SortableInterface')) {
            $collection->add('up', $this->getRouterIdParameter().'/up');
            $collection->add('down', $this->getRouterIdParameter().'/down');
        }
    }

    public function getPersistentParameters()
    {
        $parameters = array();

        if (!$this->getRequest()) {
            return $parameters;
        }

        $reflectionClass = new ReflectionClass($this->getClass());

        if ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\TraversableInterface')) {
            $parameters['parent'] = $this->getRequest()->get('parent');
        }

        if ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\TranslationInterface')) {
            $parameters['locale'] = $this->getRequest()->query->get('locale', $this->container->getParameter('locale'));
        }

        return $parameters;
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $reflectionClass = new ReflectionClass($this->getClass());

        if ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\TraversableInterface')) {
            $parentId = intval($this->container->get('request')->query->get('parent', 0));
            $query->andWhere($query->getRootAlias().'.parent '.($parentId ? '= '.$parentId : 'IS NULL'));
        }

        return $query;
    }
}
