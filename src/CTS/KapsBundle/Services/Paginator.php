<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 21/12/2018
 * Time: 16:43
 */

namespace CTS\KapsBundle\Services;


use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Paginator
{
    private $em;
    private $perPage = 6;
    private $cPage;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function paginate($media, $page)
    {
    // 1. Variables
        $articles = $this->em->getRepository('CTSKapsBundle:Article')->findBy(array('media' => $media));
        $NbElements = count($articles);                     // count number of articles per media
        $NbPages = ceil($NbElements / $this->perPage);      // rounded to the next int


        $offset = $page * $this->perPage ;
        echo '</br>' ;
        echo $offset;

    // 2. Find the good page, avoid injections
        if (!is_numeric($page))
        {
            throw new InvalidArgumentException(
                'La valeur $page est incorrecte (valeur : ' . $page . ').'
            );
        }
        if ($page < 1)
        {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }
        if (!is_numeric($page))
        {
            throw new InvalidArgumentException(
                'La valeur $perPage est incorrecte (valeur : ' . $page . ').'
            );
        }
        if (($this->cPage * $this->perPage) > $NbPages) {
            $this->cPage = $NbPages;
        }

    // 3. Select only six elements per page
        $elements = $this->em->getRepository('CTSKapsBundle:Article')->findBy(
            array('media' => $media),
            array('date' => 'desc'),
            $this->perPage,
            $offset
        );

    // 4. Return variables in an array
        return array(
            'elements'     => $elements,
            'nbPages'      => $NbPages,
            'cpage'        => $this->cPage

        );
    }

}