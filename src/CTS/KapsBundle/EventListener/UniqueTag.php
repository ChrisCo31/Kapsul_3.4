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
    public function preUpdate(LifecycleEventArgs $args)
    {

        $entity = $args->getEntity();

        // we're interested in Dishes only
        if ($entity instanceof Article) {

            $entityManager = $args->getEntityManager();
            $tags = $entity->getTags();

            foreach($tags as $key => $tag)
            {

                // let's check for existance of this ingredient
                // find by name and sort by id keep the older ingredient first
                $results = $entityManager
                    ->getRepository('CTS\KapsBundle\Entity\Tag')
                    ->findBy(array('name' => $tag->getName()), array('id' => 'ASC') );

                // if ingredient exists at least two rows will be returned
                // keep the first and discard the second
                if (count($results) > 1){

                    $knownTag = $results[0];
                    $entity->addTag($knownTag);

                    // remove the duplicated ingredient
                    $duplicatedTag = $results[1];
                    $entityManager->remove($duplicatedTag);

                }else{

                    // ingredient doesn't exist yet, add relation
                    $entity->addTag($tag);

                }

            }

        }

    }
}