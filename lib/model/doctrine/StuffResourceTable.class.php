<?php


class StuffResourceTable extends ResourceTable
{
  public function getListQuery($search)
  {
    $search = str_replace(' ', '%', trim($search));
    
    $query = $this->createQuery('p')
              ->select('p.title, LEFT(p.description, 200) as summary, p.neighborhood, p.quantity, p.created_at');
    
    if ($search) 
    {
      $query->andWhere('title like ?', "%$search%")
        ->orWhere('description like ?', "%$search%")
        ->whereWrap();
    }
    
    $query->orderBy('created_at DESC');
    
    return $query;
  }
  
  public function getList($transaction_type = null, $is_fulfilled = 0)
  {
    $query = $this->createQuery('r')
             ->where('r.is_fulfilled = ?', $is_fulfilled);
             
    if ($transaction_type)
    {
      $query->andWhere('r.transaction_type = ?', $transaction_type);
    }
    
    return $query->execute();

  }
}