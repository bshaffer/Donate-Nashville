<?php


class StuffResourceTable extends ResourceTable
{
  public function getListQuery($search)
  {
    $search = str_replace(' ', '%', trim($search));
    
    $query = $this->createQuery('p')
              ->select('p.title, LEFT(p.description, 200) as summary')
              ->andWhere('title like ?', "%$search%")
              ->orWhere('description like ?', "%$search%");
    
    return $query;
  }
}