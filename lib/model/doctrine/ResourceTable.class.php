<?php


class ResourceTable extends Doctrine_Table
{
  public function getListQuery($search)
  {
    return Doctrine::getTable('Resource')->createQuery('p')
                ->select('p.title, LEFT(p.description, 200) as summary')
                ->addWhere('title like ?', "%$search%")
                ->orWhere('description like ?', "%$search%");
  }
}