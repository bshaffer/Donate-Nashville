<?php


class StuffResourceTable extends ResourceTable
{
  public function getListQuery($search)
  {
    $search = str_replace(' ', '%', trim($search));
    
    $query = $this->createQuery('p')
              ->select('p.title, LEFT(p.description, 200) as summary, p.neighborhood, p.quantity, p.created_at')
              ->andWhere('title like ?', "%$search%")
              ->orWhere('description like ?', "%$search%")
              ->whereWrap();
    
    return $query;
  }
}