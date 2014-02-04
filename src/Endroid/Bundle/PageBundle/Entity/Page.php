<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Endroid\Bundle\BehaviorBundle\Model\PublishableInterface;
use Endroid\Bundle\BehaviorBundle\Model\PublishableTrait;
use Endroid\Bundle\BehaviorBundle\Model\SluggableInterface;
use Endroid\Bundle\BehaviorBundle\Model\SluggableTrait;
use Endroid\Bundle\BehaviorBundle\Model\TimestampableInterface;
use Endroid\Bundle\BehaviorBundle\Model\TimestampableTrait;
use Endroid\Bundle\BehaviorBundle\Model\TranslationInterface;
use Endroid\Bundle\BehaviorBundle\Model\TranslationTrait;
use Endroid\Bundle\PageBundle\Model\PageInterface;
use Netvlies\Bundle\NetvliesFormBundle\Entity\Form;

/**
 * @ORM\Entity
 * @ORM\Table(name="page")
 */
class Page implements PageInterface, PublishableInterface, SluggableInterface, TimestampableInterface, TranslationInterface
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
     * @ORM\Column(type="text", nullable=true)
     */
    protected $content;

    /**
     * @ORM\ManyToOne(targetEntity="Netvlies\Bundle\NetvliesFormBundle\Entity\Form")
     */
    protected $form;

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
     * @return Page
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
     * @return Page
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
     * Returns the form.
     *
     * @param $form
     * @return Page
     */
    public function setForm($form)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Returns the form.
     *
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
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
