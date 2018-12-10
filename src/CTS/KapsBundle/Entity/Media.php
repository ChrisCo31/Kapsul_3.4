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
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="universe", length=255)
     */
    private $universe;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->selectors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdAt = new \DateTime();
    }

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
     * Set universe
     *
     * @param string $universe
     *
     * @return Media
     */
    public function setUniverse($universe)
    {
        $this->universe = $universe;

        return $this;
    }

    /**
     * Get universe
     *
     * @return string
     */
    public function getUniverse()
    {
        return $this->universe;
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
     * Add selector
     *
     * @param \AppBundle\Entity\Selector $selector
     *
     * @return Media
     */
    public function addSelector(\CTS\KapsBundle\Entity\Selector $selector)
    {
        $this->selectors[] = $selector;

        return $this;
    }

    /**
     * Remove selector
     *
     * @param \AppBundle\Entity\Selector $selector
     */
    public function removeSelector(\CTS\KapsBundle\Entity\Selector $selector)
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
