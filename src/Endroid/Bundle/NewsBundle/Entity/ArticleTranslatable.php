<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Endroid\Bundle\BehaviorBundle\Model\TranslatableInterface;
use Endroid\Bundle\BehaviorBundle\Model\TranslatableTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="news_article_translatable")
 */
class ArticleTranslatable implements TranslatableInterface
{
    use TranslatableTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="date")
     */
    protected $date;

    /**
     * @ORM\OneToOne(targetEntity="Endroid\Bundle\MediaBundle\Entity\Media")
     */
    protected $image;

    /**
     * Returns the ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the date.
     *
     * @param $date
     * @return ArticleTranslatable
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Returns the date.
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the image.
     *
     * @param $image
     * @return ArticleTranslatable
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Returns the image.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
