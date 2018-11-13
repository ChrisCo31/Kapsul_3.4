<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 25/10/2018
 * Time: 11:13
 */

namespace CTS\KapsBundle\Services;


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
        $selectors = $media->getSelectors();
        foreach ($selectors as $selector)
        {
            $selectorTitle = $selector->getSelectorTitle();
            $selectorExcerpt = $selector->getSelectorExcerpt();
            $selectorLink = $selector->getSelectorLink();
        }

        $crawler = $this->client->request('GET', $url);
        // scrap des titres d'articles
        $crawler->filter($selectorTitle)->each(function ($node){
               $title = $node->text();
               $results[] = $title;
               var_dump($results);
        });
        // scrap des extraits d'articles
        $crawler->filter($selectorExcerpt)->each(function ($node) {
            $excerpt = $node->text();
            $results[]= [$excerpt];
            var_dump($results);
        });
        //scrap des liens menant aux articles
        $links = $crawler->filter($selectorLink)->links();
        foreach ($links as $link) {
            $link = $link->getUri();
            $results = [$link];
            var_dump($results);
        }




    }
}