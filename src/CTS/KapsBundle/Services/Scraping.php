<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 25/10/2018
 * Time: 11:13
 */

namespace CTS\KapsBundle\Services;


use CTS\KapsBundle\Entity\Article;
use CTS\KapsBundle\Entity\Picture;
use CTS\KapsBundle\Entity\Tag;
use Doctrine\ORM\EntityManager;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use CTS\KapsBundle\Entity\Media;
use CTS\KapsBundle\Entity\Selector;



class Scraping
{
    private $client;
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->client = new Client();
        $this->em = $em;
    }
    /**
     * @param $url
     * @param $media
     */
    public function executeScraping($url, $media)
    {
        // Retrieve css selectors
        $selectors = $media->getSelectors();
        foreach ($selectors as $selector)
        {
            $selectorTitle = $selector->getSelectorTitle();
            $selectorExcerpt = $selector->getSelectorExcerpt();
            $selectorTag = $selector->getSelectorTag();
            $selectorLink = $selector->getSelectorLink();
            $selectorImg = $selector->getSelectorImg();
        }
        // Scraping
        $crawler = $this->client->request('GET', $url);
        // Retrieve Picture
        $i = $crawler
            ->filterXPath($selectorImg)
            ->extract(array('src', 'alt'));
        $result['image'] = $i;

        // Retrieve Title
        $t = $crawler
            ->filterXPath($selectorTitle)
            ->extract(array('_text'));
        $result['title'] = $t;
        // Retrieve Tag
        $w = $crawler
            ->filterXPath($selectorTag)
            ->extract(array('_text'));
        $result['tag'] = $w;
        
        foreach($result['tag'] as $key => $tag)
        {
            $words = preg_split('/#/', $tag, -1, PREG_SPLIT_NO_EMPTY);
            $newResults[] = $words;
        }
        foreach($newResults as $values)
        { 
            foreach($values as $key => $value)
            {
            
                $resultat[]=$value;
            }
        }
        //var_dump($resultat);
        $result['tag'] = $resultat;
        //var_dump($result);        
        // Retrieve Excerpt
        $e = $crawler
            ->filterXPath($selectorExcerpt)
            ->extract(array('_text'));
        $result['excerpt'] = $e;
        // Retrieve Link
        $a = $crawler
            ->filterXPath($selectorLink)
            ->extract(array('href'));
        $result['link'] = $a;

        //var_dump($result);
        
        
        foreach($result['title'] as $key => $title)
        {
            // Fill attributes
            $article = new Article();
            $article->setTitle($title);
            $article->setExcerpt($result['excerpt'][$key]);
            $article->setUrl($result['link'][$key]);
            $article->setDate(new \DateTime());

            $picture = new Picture();
            $picture->setSrc($result['image'][$key][0]);
            $picture->setAlt('ImageArticle');
            $article->setPicture($picture);

            $article->setMedia($media);

            $keyTag = $key + $key;
            
            $tag1= new Tag();
            $article->addTag($tag1);
            $tag1->setName($result['tag'][$keyTag]);
            $tag1->addArticle($article);
            
            //var_dump($tag1);
            $tag2= new Tag();
            $article->addTag($tag2);
            $tag2->setName($result['tag'][$keyTag+1]);       
            $tag2->addArticle($article);     
            //var_dump($tag2);

            $exist = $this->em->getRepository('CTSKapsBundle:Article')->findOneBy(['title' => $article->getTitle()]);

            //check if db is null or contains already the scrap title of the article.
            if( $exist==null || !$exist->getTitle())
            {
                // Persist
                $this->em->persist($article);
                $this->em->flush();
            }
	    }
    }
}


