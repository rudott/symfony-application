<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Endroid\Bundle\BehaviorBundle\Model\PublishableInterface;
use Endroid\Bundle\BehaviorBundle\Model\PublishableTrait;
use Endroid\Bundle\BehaviorBundle\Model\SluggableInterface;
use Endroid\Bundle\BehaviorBundle\Model\SluggableTrait;
use Endroid\Bundle\BehaviorBundle\Model\TimestampableInterface;
use Endroid\Bundle\BehaviorBundle\Model\TimestampableTrait;
use Endroid\Bundle\BehaviorBundle\Model\TranslationInterface;
use Endroid\Bundle\BehaviorBundle\Model\TranslationTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="news_article")
 */
class Article implements PublishableInterface, SluggableInterface, TimestampableInterface, TranslationInterface
{
    use PublishableTrait;
    use SluggableTrait;
    use TimestampableTrait;
    use TranslationTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $content;

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
     * Sets the title.
     *
     * @param $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Returns the title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the content.
     *
     * @param $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Returns the content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Returns the string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return strval($this->title);
    }
}
