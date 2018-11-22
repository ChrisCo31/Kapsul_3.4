<?php

namespace CTS\KapsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="CTS\KapsBundle\Repository\TagRepository")
 */
class Tag
{
    /**

     * @ORM\ManyToMany(targetEntity="CTS\KapsBundle\Entity\Media", inversedBy="tags")

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return Tag
     */
    public function setName($name)
    {
        $this->tag = $name;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->media = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add medium
     *
     * @param \OC\PlatformBundle\Entity\Media $medium
     *
     * @return Tag
     */
    public function addMedia(\OC\PlatformBundle\Entity\Media $medium)
    {
        $this->media[] = $medium;

        return $this;
    }

    /**
     * Remove medium
     *
     * @param \OC\PlatformBundle\Entity\Media $medium
     */
    public function removeMedia(\OC\PlatformBundle\Entity\Media $medium)
    {
        $this->media->removeElement($medium);
    }

    /**
     * Get media
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedia()
    {
        return $this->media;
    }
}
