<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 25/10/2018
 * Time: 11:13
 */

namespace CTS\KapsBundle\Services;


use CTS\KapsBundle\Entity\Article;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use CTS\KapsBundle\Entity\Media;
use CTS\KapsBundle\Entity\Selector;

class Scraping
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
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
        }

        // Scraping

        $crawler = $this->client->request('GET', $url);

        // Scrap article titles
        $crawler
            ->filter("$selectorTitle")
            ->each(function($node) use (&$titles)
            {
                $title= $node->text();
                $titles[] = $title;
        		echo "<br/>";
            });
        $result['title'] = $titles;
        //var_dump($result);

        // Scrap article excerpts
        $crawler->filter($selectorExcerpt)->each(function ($node) use (&$excerpts) {
            $excerpt = $node->text();
            $excerpts[]= $excerpt;
            return $excerpts;
        });
        $result['excerpt'] = $excerpts;
        //var_dump($result);

        // Scrap article links
        $links = $crawler->filter($selectorLink)->links();
        foreach ($links as $link) {
            $link = $link->getUri();
            $linkS[] = $link;
        }
        $result['link'] = $linkS;
        var_dump($result);

        foreach($result['title'] as $key => $title) {

            $article = new Article();
            $article->setTitle($title);
            $article->setExcerpt($result['excerpt'][$key]);
            $article->setUrl($result['link'][$key]);
            $articles[] = $article;

	   }
        var_dump($articles);
    }

}

/*
 * $result =  array(
   						'title'   => array($title1, $title2, $title3),
    		  			'excerpt' => array($excerpt1, $excerpt2, $excerpt3),
    		  			'link'    => array($link1, $link2, $link3),
    		  )
 */