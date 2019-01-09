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
use CTS\KapsBundle\Services\Formatting;



class Scraping
{
    private $client;
    private $em;
    private $formatting;

    public function __construct(EntityManager $em, Formatting $formatting)
    {
        $this->client = new Client();
        $this->em = $em;
        $this->formatting = $formatting;
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
            $selectorLink = $selector->getSelectorLink();
            $selectorImg = $selector->getSelectorImg();
        }

        // Scraping
        $crawler = $this->client->request('GET', $url);
        $src = $this->formatting->formattingSrc($url);
        $e = $this->formatting->formattingE($url);
        
        // Retrieve Picture
        if($selectorImg!==NULL)
        {
            $i = $crawler
                ->filterXPath($selectorImg)
                ->extract(array( $src,'alt'));
            $result['image'] = $i;
        }
        
        // Retrieve Title
        $t = $crawler
            ->filterXPath($selectorTitle)
            ->extract(array('_text'));
        $result['title'] = $t;

        // Retrieve Excerpt
        if($selectorExcerpt!==NULL)
        {
            $e = $crawler
                ->filterXPath($selectorExcerpt)
                ->extract(array($e));
            $result['excerpt'] = $e;
        }

        // Retrieve Link
        $a = $crawler
            ->filterXPath($selectorLink)
            ->extract(array('href'));
        $result['link'] = $a;
       
        // create a loop to set objects
        foreach($result['title'] as $key => $title)
        {
            if(!$article = $this->em->getRepository("CTSKapsBundle:Article")->findOneBy(array('title' => $title)))
            {   // Persist
           
                // Fill attributes
                $article = new Article();
                $article->setTitle($title);
                if(!empty($result['excerpt']))
                {
                    $article->setExcerpt($result['excerpt'][$key]);   
                }
                $formatting = $this->formatting->formattingUrl($result['link'][$key], $url, $article);

                $article->setDate(new \DateTime());

                $picture = new Picture();
                $picture->setSrc($result['image'][$key][0]);
                $picture->setAlt('ImageArticle');
                $article->setPicture($picture);

                $article->setMedia($media);
                $this->em->persist($article);
                $this->em->flush();
            }
        }
	}
}


/*
->filterXPath('//div[@class="image-container"]/a/img |
                                //div[@class="image-container"]/a/span |
                                //div[@class="grid-article-body"]/h2 |
                                //div[@class="grid-article-body"]/h2/a')
    ->extract(array('data-src', 'data-text', '_text', 'href'));
*/