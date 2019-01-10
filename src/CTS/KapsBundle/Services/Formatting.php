<?php


namespace CTS\KapsBundle\Services;




class Formatting
{
    /**
     * @param $result
     * @param $url
     * @param $article
     */
    public function formattingUrl(array $result, $key, $article, $url)
    {

        $chain = (strncmp($result['link'][$key], 'HTTP', 4));

        if ($chain == 1) {
            $r =$article->setUrl($result['link'][$key]);
        } else {
            $url = trim($url, '/');
           $r = $article->setUrl($url . $result['link'][$key]);
        }
        return $r;
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
