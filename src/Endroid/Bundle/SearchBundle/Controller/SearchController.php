<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\SearchBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $search = $this->getRequest()->query->get('q');
        $finder = $this->container->get('fos_elastica.finder.website');

        $queryString = new \Elastica_Query_QueryString();
        $queryString->setQuery('*'.$search.'*');

        // Published is true or missing
        $publishedFilter = new \Elastica_Filter_Terms();
        $publishedFilter->setTerms('published', array('true'));

        $publishedMissingFilter = new \Elastica_Filter_Missing();
        $publishedMissingFilter->setField('published');

        $publishedOrFilter = new \Elastica_Filter_Or();
        $publishedOrFilter->addFilter($publishedFilter);
        $publishedOrFilter->addFilter($publishedMissingFilter);

        // Locale is current locale or missing
        $localeFilter = new \Elastica_Filter_Terms();
        $localeFilter->setTerms('locale', array($this->getRequest()->getLocale()));

        $localeMissingFilter = new \Elastica_Filter_Missing();
        $localeMissingFilter->setField('locale');

        $localeOrFilter = new \Elastica_Filter_Or();
        $localeOrFilter->addFilter($localeFilter);
        $localeOrFilter->addFilter($localeMissingFilter);

        // Combine filters
        $filter = new \Elastica_Filter_And();
        $filter->addFilter($publishedOrFilter);
        $filter->addFilter($localeOrFilter);

        $query = new \Elastica_Query();
        $query->setQuery($queryString);
        $query->setFilter($filter);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $finder->createPaginatorAdapter($query),
            $this->get('request')->query->get('page', 1),
            5
        );

        return array(
            'query' => $search,
            'pagination' => $pagination
        );
    }
}
