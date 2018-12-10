<?php

namespace CTS\KapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="CTS\KapsBundle\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\ManyToMany(targetEntity="CTS\KapsBundle\Entity\Tag", mappedBy="articles", cascade={"all"})
     */
    private $tags;
    /**
     * @orm\OneToOne(targetEntity="CTS\KapsBundle\Entity\Picture",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $picture;
    /**
     * @ORM\ManyToOne(targetEntity="CTS\KapsBundle\Entity\Media", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $media;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="excerpt", type="text", nullable=true)
     */
    private $excerpt;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


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
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set excerpt
     *
     * @param string $excerpt
     *
     * @return Article
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * Get excerpt
     *
     * @return string
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Article
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Article
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set media
     *
     * @param \AppBundle\Entity\Media $media
     *
     * @return Article
     */
    public function setMedia(\CTS\KapsBundle\Entity\Media $media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \AppBundle\Entity\Media
     */
    public function getMedia()
    {
        return null;
        return $this->media;
    }

    /**
     * Set picture
     *
     * @param \CTS\KapsBundle\Entity\Picture $picture
     *
     * @return Article
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
    }

    /**
     * Add tag
     *
     * @param \CTS\KapsBundle\Entity\Tag $tag
     *
     * @return Article
     */
    public function addTag(\CTS\KapsBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \CTS\KapsBundle\Entity\Tag $tag
     */
    public function removeTag(\CTS\KapsBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }
}
