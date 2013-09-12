<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Endroid\Bundle\BehaviorBundle\Model\TranslatableInterface;
use Endroid\Bundle\BehaviorBundle\Model\TranslatableTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="page_translatable")
 */
class PageTranslatable implements TranslatableInterface
{
    use TranslatableTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Returns the ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
