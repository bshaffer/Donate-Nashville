<?php
function get_pager_controls($pager)
{
  $route = url_for(sfContext::getInstance()->getRouting()->getCurrentInternalUri(true));
  if ($pager->getNbResults())
  {
    $template = "<div class='pagination'>
                    <span>Results <em>%first%-%last%<em> of <em>%total%<em></span>
                    %pagination%
                 </div>"; 
    $pagination = "";
    if ($pager->haveToPaginate())
    {
      $pagination = "<ul>";
      // Previous
      if ($pager->getPage() != $pager->getFirstPage()) 
      {
        $pagination .= "<li><a href='".$route."?page=1'>&lt;&lt;</a></li>";        
        $pagination .= "<li><a href='".$route."?page=".$pager->getPreviousPage()."'>Previous</a></li>";
      }
      // In between
      foreach ($pager->getLinks() as $page) 
      {
        if ($page == $pager->getPage())
        {
          $pagination .= "<li>$page</li>";
        }
        else
        {
          $pagination .= "<li><a href='$route?page=$page'>$page</a></li>";
        }
      }
      // Next
      if ($pager->getPage() != $pager->getLastPage()) 
      {
        $pagination .= "<li><a href='$route?page=".$pager->getNextPage()."'>Next</a></li>";
        $pagination .= "<li><a href='$route?page=".$pager->getLastPage()."'>&gt;&gt;</a></li>";
      }
      $pagination .= "</ul>";
    }
    return strtr($template, array('%first%' => $pager->getFirstIndice(),
                                  '%last%'  => $pager->getLastIndice(),
                                  '%total%' => $pager->getNbResults(),
                                  '%pagination%' => $pagination));
  }
}