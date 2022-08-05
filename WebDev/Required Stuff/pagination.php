<?php

class Pagination{
    var $baseURL = "";
    var $totalRows = ""; 
    var $perPage = 9; 
    var $numLinks = 2; 
    var $currentPage =  0; 
    var $anchorClass = "chanePage";
    var $link_func = "";
    var $contentDiv = "";
    var $additionalParam = "";
    function __construct($params= array())
    {
        if(count($params)>0){
            foreach ($params as $key => $val){
                if(isset($this->$key)){
                    $this->$key = $val;
                }
            }
        }   

        if($this->anchorClass!=""){
            $this->anchorClass = ' class = "'.$this->anchorClass.'" ';
        }
    }

    function getAJAXLink($count,$text){
        if($this->link_func == "" && $this->contentDiv == ""){
            return '<a href="'.$this->baseURL.'?'.$count.'"'.$this->anchorClass.'>'.$text.'</a>';
        }
        $pageCount = $count ? $count : 0;
        if(!empty($this->link_func)){
            $link_click = 'onclick = "'.$this->link_func.'('.$pageCount.')'.'"';
        }
        else{
            $this->additionalParam = "{'page' : $pageCount}"; 
            $link_click = "style=\"\" on click=\"$.post('".$this->baseURL."', ". $this->additionalParam .", function(data){
                $('#". $this->contentDiv."'html(data); }); return false;\"";
        }
        return "<a href=\"javascript:void(0);\" ". $this->anchorClass . "
            ". $link_click .">".$text.'</a>';
    }
    
    function createLinks(){
        if($this->totalRows==0 OR $this->perPage==0){
            return '';
        }

        $totalPages = ceil($this->totalRows/$this->perPage);

        if($totalPages==1){
            return '';
        }

        if(!is_numeric($this->currentPage)){
            $this->currentPage = 0;
        }

        $output = "";

        if($this->currentPage > $this->totalRows){
            $this->currentPage = ($totalPages- 1) * $this->perPage;
        }

        $uriPagenum = $this->currentPage;

        $this->currentPage = floor(($this->currentPage/$this->perPage) + 1); 

        $start = (($this->currentPage - $this->numLinks) > 0 ) ? $this->currentPage - ($this->numLinks - 1) : 1;
        $end = (($this->currentPage + $this->numLinks) < $totalPages ) ? $this->currentPage+$this->numLinks : $totalPages;

        if($this->currentPage != 1){
            $i = $uriPagenum - $this->perPage;
            if($i==0) $i = "";
            $output .= $this->getAJAXLink($i,"&#8249;");
        }

        for($loop = $start -1; $loop<=$end;$loop++){
            $i = ($loop * $this->perPage) - $this->perPage;
            if($i>=0){
                if($this->currentPage==$loop){
                    $output .= $loop;
                }else{
                    $n = ($i==0) ? '' : $i;
                    $output .= $this->getAJAXLink($n,$loop);
                }
            }
        }

        if($this->currentPage<$totalPages){
            $output .= $this->getAJAXLink($this->currentPage * $this->perPage,"&#8250;");
        }
        $output = preg_replace("#([^:])//+#", "\\1/", $output);

        $output = "<div class=\"pagination\">".$output."</div>"; 

        return $output;
    }
}


?>