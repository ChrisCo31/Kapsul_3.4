<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 02/12/2018
 * Time: 15:34
 */

namespace CTS\KapsBundle\EventListener;


use CTS\KapsBundle\Entity\Article;
use Doctrine\ORM\Event\LifecycleEventArgs;

class UniqueTag
{
    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        // return an object
        $entity = $args->getEntity();

                if($entity instanceof Article)
                {
                    // retrieve an array of tags
                    $entityManager= $args->getEntityManager();
                    $tags = $entity->getTags();

                    foreach($tags as $key => $tag)
                    {
                        // check if tag exist
                        $results = $entityManager
                            ->getRepository('CTS\KapsBundle\Entity\Tag')
                            ->findBy(['name' =>$tag->getName()], ['id' => 'ASC']);

                        // use the existing tag
                        if(count($results) > 0)
                        {
                            $tags[$key] = $results[0];
                            // probleme de duplication de cle primaire
                            //$entity->addTag($tag);
                            //$tag->addArticle($entity);
                            //var_dump($results);

                        }
                    }

        }

    }

}