<?php
/**
 *  Inspired by github@usmanhalalit/strana
 */
final class Paginator
{
    use ParseUrl;

    private $totalRecords;
    private $currentPage;
    private $totalPages;
    private $perPage;
    private $offset;
    private $baseUrl;
    private $ulClass;

    public $collection;
    public $links;

    public function __construct($perPage = null, $collection = null)
    {
        if (!is_string($GLOBALS['config']['urlPrefix'])) {
            throw new \Exception('Prefix must be a string!');
        }

        $this->pagingPrefix = trim($GLOBALS['config']['urlPrefix']);

        $this->_constructHelper($collection, $perPage);

        $this->setBaseUrlAndCurrntPageNum();
    }

    public function __call($name, $params)
    {
        $name = ucfirst($name);
        $name = new $name;

        $param = isset($params[0]) ? $params[0] : null;

        return $this->make($param, $name);
    }

    public function setUlClass($ulClass)
    {
        $this->ulClass = trim($ulClass);
        return $this;
    }

    public function make($perPage = null, $collection = null)
    {
        $this->_constructHelper($collection, $perPage);

        $this->totalRecords = $this->collection->count();

        $this->totalPages = ceil($this->totalRecords / $this->perPage);

        $this->offset = ($this->currentPage - 1) * $this->perPage;

        $this->collection = $this->collection->take($this->perPage)->skip($this->offset)->get();

        return $this->links();
    }

    private function links()
    {
        $pages = $this->getPages();

        $prevLiClass = 'prev';
        $prevLinkHref = 'javascript:void(0)';
        if ($this->currentPage == 1) {
            $prevLiClass = 'disabled';
        } else {
            $prevLinkHref = $this->pagingPrefix . ($this->currentPage - 1);
        }

        $nextLiClass = 'next';
        $nextLinkHref = 'javascript:void(0)';

        if ($this->currentPage == $this->totalPages) {
            $nextLiClass = 'disabled';
        } else {
            $nextLinkHref = $this->pagingPrefix . ($this->currentPage + 1);
        }

        $output = '<ul class="pagination ' . $this->ulClass . '" id="pagination" >';
        $output .= '<li class="' . $prevLiClass . '"><a href="' . $prevLinkHref . '">&laquo;</a></li>';
        foreach ($pages as $page) {

            $currentClass = $page == $this->currentPage ? 'active current' : '';
            $output .= '<li class="' . $currentClass . '"><a href="' . BASE_URL . $this->baseUrl . $this->pagingPrefix . $page . '">' . $page . '</a></li>';
        }
        $output .= '<li class="' . $nextLiClass . '"><a href="' . $nextLinkHref . '">&raquo;</a></li>';
        $output .= '</ul>';

        $this->links = $output;

        return $this;
    }

    private function getPages()
    {
        $result = [];
        $result = range(1, ceil($this->totalRecords / $this->perPage));

        if (($this->totalPages = floor($this->totalPages / 2) * 2 + 1) >= 1) {
            $result = array_slice($result, max(0, min(count($result) - $this->totalPages, intval($this->currentPage) - ceil($this->totalPages / 2))), $this->totalPages);
        }

        return $result;
    }

    private function setBaseUrlAndCurrntPageNum()
    {
        $baseUrl = $this->urlParseArray();

        if (!is_null($baseUrl) || $baseUrl !== []) {
            $baseUrl = implode($baseUrl, '/');
            if ($baseUrl) {
                $baseUrl .= '/';
            }
        }
        $this->baseUrl = $baseUrl;
    }

    private function _constructHelper($collection, $perPage)
    {
        if (!is_null($collection)) {
            $this->collection = $collection;
        }
        if (!is_null($perPage)) {
            $this->perPage = $perPage;
        }
    }
}
