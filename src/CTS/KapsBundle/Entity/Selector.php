<?php

namespace CTS\KapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Selector
 *
 * @ORM\Table(name="selector")
 * @ORM\Entity(repositoryClass="CTS\KapsBundle\Repository\SelectorRepository")
 */
class Selector
{
    /**
     * @ORM\ManyToOne(targetEntity="CTS\KapsBundle\Entity\Media", inversedBy="selectors")
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
     * @ORM\Column(name="selectorTitle", type="string", length=255)
     */
    private $selectorTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="selectorExcerpt", type="string", length=255, nullable=true)
     */
    private $selectorExcerpt;

    /**
     * @var string
     *
     * @ORM\Column(name="selectorDate", type="string", length=255, nullable=true)
     */
    private $selectorDate;

    /**
     * @var string
     *
     * @ORM\Column(name="selectorLink", type="string", length=255)
     */
    private $selectorLink;

    /**
     * @var string
     *
     * @ORM\Column(name="selectorImg", type="string", length=255, nullable=true)
     */
    private $selectorImg;


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
     * Set selectorTitle
     *
     * @param string $selectorTitle
     *
     * @return Selector
     */
    public function setSelectorTitle($selectorTitle)
    {
        $this->selectorTitle = $selectorTitle;

        return $this;
    }

    /**
     * Get selectorTitle
     *
     * @return string
     */
    public function getSelectorTitle()
    {
        return $this->selectorTitle;
    }

    /**
     * Set selectorExcerpt
     *
     * @param string $selectorExcerpt
     *
     * @return Selector
     */
    public function setSelectorExcerpt($selectorExcerpt)
    {
        $this->selectorExcerpt = $selectorExcerpt;

        return $this;
    }

    /**
     * Get selectorExcerpt
     *
     * @return string
     */
    public function getSelectorExcerpt()
    {
        return $this->selectorExcerpt;
    }

    /**
     * Set selectorDate
     *
     * @param string $selectorDate
     *
     * @return Selector
     */
    public function setSelectorDate($selectorDate)
    {
        $this->selectorDate = $selectorDate;

        return $this;
    }

    /**
     * Get selectorDate
     *
     * @return string
     */
    public function getSelectorDate()
    {
        return $this->selectorDate;
    }

    /**
     * Set selectorLink
     *
     * @param string $selectorLink
     *
     * @return Selector
     */
    public function setSelectorLink($selectorLink)
    {
        $this->selectorLink = $selectorLink;

        return $this;
    }

    /**
     * Get selectorLink
     *
     * @return string
     */
    public function getSelectorLink()
    {
        return $this->selectorLink;
    }

    /**
     * Set selectorImg
     *
     * @param string $selectorImg
     *
     * @return Selector
     */
    public function setSelectorImg($selectorImg)
    {
        $this->selectorImg = $selectorImg;

        return $this;
    }

    /**
     * Get selectorImg
     *
     * @return string
     */
    public function getSelectorImg()
    {
        return $this->selectorImg;
    }

    /**
     * Set media
     *
     * @param \CTS\KapsBundle\Entity\Media $media
     *
     * @return Selector
     */
    public function setMedia(\CTS\KapsBundle\Entity\Media $media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \CTS\KapsBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }
}
