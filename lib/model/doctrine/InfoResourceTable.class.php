<?php


class InfoResourceTable extends ResourceTable
{
  public function getKeywordQuery($search, $type = null)
  {
    $search = str_replace(' ', '%', trim($search));
    
    $query = $this->createQuery('p')
              ->select('p.title, description, abstract, p.created_at')
              ->andWhere('keywords like ?', "%$search%");

    if ($type) 
    {
      $query->andWhere('transaction_type IS NULL or transaction_type = ?', $type);
    }

    return $query;
  }
}