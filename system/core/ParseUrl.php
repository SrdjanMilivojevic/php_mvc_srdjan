<?php

trait ParseUrl
{
    /**
     * Prefix for pagination uri segment
     *
     * @var string
     */
    private $pagingPrefix;

    /**
     * Split the GET url into array nods, sets current page property & unset
     * pagination parameters if they are in array
     *
     * @return array
     */
    private function urlParseArray()
    {
        $url = isset($_GET['url']) ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : null;

        if (!is_null($url)) {
            foreach ($url as $key => $value) {
                if (in_array(strpos($value, $this->pagingPrefix), $url)) {
                    $pgNumber = ltrim($value, $this->pagingPrefix);
                    unset($url[$key]);
                    break;
                }
            }
        }
        $this->currentPage = isset($pgNumber) && is_numeric($pgNumber) ? $pgNumber : 1;
        return $url ? array_values($url) : [];
    }
}
