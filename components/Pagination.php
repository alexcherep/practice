<?php

class Pagination
{
    private $total, $currentPage, $limit, $index, $totalPages;

    public function __construct($total, $currentPage, $limit, $index)
    {
        $this->totalPages = ceil($total / $limit);
        $this->total = $total;
        $this->currentPage = $this->checkPage($currentPage);
        $this->limit = $limit;
        $this->index = $index;
    }

    public function getHtml()
    {
        $html = null;
        if ($this->currentPage <= $this->totalPages) {
            $html .= '<ul class="pagination">';
            $html .=  $this->getList(1, $this->currentPage);
            for ($i = ($this->currentPage - 3); $i <= ($this->currentPage + 3); $i++) {
                if ($i > 1 && $i < $this->totalPages) {
                    $html .=  $this->getList($i, $this->currentPage);
                }
            }
            if ($this->totalPages > 1) {
                $html .=  $this->getList($this->totalPages, $this->currentPage);
            }
            $html .= '</ul>';
        }

        return $html;
    }

    public function getList($i, $currentPage)
    {
        if ($i != $currentPage) {
            return $this->generateButton($i);
        } else {
            return '<li class="active"><a href="#">'.$i.'</a></li>';
        }
    }

    public function generateButton($currentPage, $text = null)
    {
       $button = ($text) ?: $currentPage;

       $url = rtrim($_SERVER['REQUEST_URI'], '/').'/';
       $replace = preg_replace('~/page-[0-9]+~', '', $url);

       return '<li><a href="'.$replace.$this->index.$button.'">'.$button.'</a></li>';
    }

    public function checkPage($currentPage)
    {
        if ($currentPage == 0) {
            return 1;
        }
        return $currentPage;
    }
}