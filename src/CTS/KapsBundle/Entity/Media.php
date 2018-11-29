<?php

namespace CTS\KapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="CTS\KapsBundle\Repository\MediaRepository")
 */
class Media
{
    /**
     * @ORM\OneToMany(targetEntity="CTS\KapsBundle\Entity\Selector", mappedBy ="media", cascade={"all"})
     */
    private $selectors;
    /**
     * @ORM\ManyToMany(targetEntity="CTS\KapsBundle\Entity\Tag", mappedBy="media", cascade={"all"})
     */
    private $tags;
    /**
     * @ORM\OneToOne(targetEntity="CTS\KapsBundle\Entity\Picture", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $picture;
    /**
     * @ORM\OneToMany(targetEntity="CTS\KapsBundle\Entity\Article", mappedBy="media", cascade={"all"})
     */
    private $articles;


    /**
     * @var int
     *s
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation", type="text")
     */
    private $presentation;

    /**
     * @var string
     *
     * @ORM\Column(name="support", type="string", length=255)
     */
    private $support;

    /**
     * @var string
     *
     * @ORM\Column(name="frequency", type="string", length=255)
     */
    private $frequency;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=255)
     */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Media
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Media
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set presentation
     *
     * @param string $presentation
     *
     * @return Media
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Set support
     *
     * @param string $support
     *
     * @return Media
     */
    public function setSupport($support)
    {
        $this->support = $support;

        return $this;
    }

    /**
     * Get support
     *
     * @return string
     */
    public function getSupport()
    {
        return $this->support;
    }

    /**
     * Set frequency
     *
     * @param string $frequency
     *
     * @return Media
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Get frequency
     *
     * @return string
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set lang
     *
     * @param string $lang
     *
     * @return Media
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Media
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Media
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set picture
     *
     * @param \CTS\KapsBundle\Entity\Picture $picture
     *
     * @return Media
     */
    public function setPicture(\CTS\KapsBundle\Entity\Picture $picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \CTS\KapsBundle\Entity\Picture
     */
    public function getPicture()
    {
        return $this->picture;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->selectors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add theme
     *
     * @param \CTS\KapsBundle\Entity\Tag $tag
     *
     * @return Media
     */
    public function addTag(\CTS\KapsBundle\Entity\Tag $tag)
    {
        $this->tag[] = $tag;

        return $this;
    }

    /**
     * Remove theme
     *
     * @param \CTS\KapsBundle\Entity\Tag $tag
     */
    public function removeTag(\CTS\KapsBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get themes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add selector
     *
     * @param \AppBundle\Entity\Selector $selector
     *
     * @return Media
     */
    public function addSelector(\AppBundle\Entity\Selector $selector)
    {
        $this->selectors[] = $selector;

        return $this;
    }

    /**
     * Remove selector
     *
     * @param \AppBundle\Entity\Selector $selector
     */
    public function removeSelector(\AppBundle\Entity\Selector $selector)
    {
        $this->selectors->removeElement($selector);
    }

    /**
     * Get selectors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSelectors()
    {
        return $this->selectors;
    }

    /**
     * Add article
     *
     * @param \CTS\KapsBundle\Entity\Article $article
     *
     * @return Media
     */
    public function addArticle(\CTS\KapsBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \CTS\KapsBundle\Entity\Article $article
     */
    public function removeArticle(\CTS\KapsBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

}