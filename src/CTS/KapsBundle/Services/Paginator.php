<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 21/12/2018
 * Time: 16:43
 */

namespace CTS\KapsBundle\Services;


use Doctrine\ORM\EntityManagerInterface;

class Paginator
{
    private $em;
    private $perPage;
    private $cPage;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->perPage = 6;
        $this->cPage=1;
    }

    public function calculateNbPages($media)
    {
    // 1. Variables
        $articles = $this->em->getRepository('CTSKapsBundle:Article')->findBy(array('media' => $media));
        $NbElements = count($articles);                     // count number of articles per media
        $NbPages = ceil($NbElements / $this->perPage);      // rounded to the next int
        return $NbPages;

    }


    public function paginate($media)
    {
    // 2. Select only six elements per page
        $elements = $this->em->getRepository('CTSKapsBundle:Article')->findBy(
            array('media' => $media),
            array('date' => 'desc'),
            $this->perPage,
            ".(($this->cPage-1)*$this->perPage)."
        );
        return $elements;
    }

}