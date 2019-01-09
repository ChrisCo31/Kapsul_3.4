<?php


namespace CTS\KapsBundle\Services;




class Formatting
{
    /**
     * @param $result
     * @param $url
     * @param $article
     */
    public function formattingUrl($result, $url, $article)
    {
        if (strncmp($result, 'HTTP', 4) == 'http') {
            $article->setUrl($result['key'][$key]);
        } else {
            $url = trim($url, '/');
            $t = $article->setUrl($url . $result);
        }
    }
    /**
     * @param $url
     * @return string
     */
    public function formattingSrc($url)
    {
        if ($url == 'https://carbone.ink/') {
            $src = 'data-src';
        } else {
            $src = "src";
        }
        return $src;
    }
    /**
     * @param $url
     * @return string
     */
    public function formattingE($url)
    {
        if ($url == 'https://carbone.ink/') {
            $e = 'data-text';
        } else {
            $e = "_text";      
        }
        return  $e;
    }
}