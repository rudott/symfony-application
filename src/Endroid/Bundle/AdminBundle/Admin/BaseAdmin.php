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
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class BaseAdmin extends Admin implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * Configure the list fields for the current admin.
     *
     * @param $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $reflectionClass = new ReflectionClass($this->getClass());

        // Add up and down buttons to sortable items
        if ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\SortableInterface')) {
            $listMapper
                ->add('up', 'string', array('label' => ' ', 'template' => 'EndroidMenuBundle:MenuItemAdmin:list_field_up.html.twig'))
                ->add('down', 'string', array('label' => ' ', 'template' => 'EndroidMenuBundle:MenuItemAdmin:list_field_down.html.twig'))
            ;
        }
    }

    /**
     * Configure the default routes for the current admin.
     *
     * @param $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $reflectionClass = new ReflectionClass($this->getClass());

        // Add up and down routes to sortable items
        if ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\SortableInterface')) {
            $collection->add('up', $this->getRouterIdParameter().'/up');
            $collection->add('down', $this->getRouterIdParameter().'/down');
        }

        // By default remove export route
        $collection->remove('export');
    }

    /**
     * Returns the persistent parameters for the current admin.
     *
     * @return array
     */
    public function getPersistentParameters()
    {
        $parameters = array();

        // If no request is made don't add behavioral parameters
        if (!$this->getRequest()) {
            return $parameters;
        }

        $reflectionClass = new ReflectionClass($this->getClass());

        // Add parent to traversable urls
        if ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\TraversableInterface')) {
            $parameters['parent'] = $this->getRequest()->query->get('parent');
        }

        // Add locale to translation urls
        if ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\TranslationInterface')) {
            $parameters['locale'] = $this->getRequest()->query->get('locale', $this->container->getParameter('locale'));
        }

        return $parameters;
    }

    /**
     * Create the query used to retrieve the list.
     *
     * @param  string                                           $context
     * @return \Sonata\AdminBundle\Datagrid\ProxyQueryInterface
     */
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $reflectionClass = new ReflectionClass($this->getClass());

        // Filter the traversable list by query string parent
        if ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\TraversableInterface')) {
            $parentId = intval($this->container->get('request')->query->get('parent', 0));
            $query->andWhere($query->getRootAlias().'.parent '.($parentId ? '= '.$parentId : 'IS NULL'));
        }

        // Filter the translatable list by query string parent
        if ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\TranslationInterface')) {
            $locale = $this->container->get('request')->query->get('locale', $this->container->getParameter('locale'));
            $query->andWhere($query->getRootAlias().'.locale = \''.$locale.'\'');
        }

        return $query;
    }
}
