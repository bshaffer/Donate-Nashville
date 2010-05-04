<?php
/*
 * This file is part of the sfLucenePlugin package
 * (c) 2007 - 2008 Carl Vondrick <carl@carlsoft.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @package sfLucenePlugin
 * @subpackage Indexer
 * @author Carl Vondrick
 * @version SVN: $Id: sfLuceneModelIndexerHandler.class.php 7108 2008-01-20 07:44:42Z Carl.Vondrick $
 */

abstract class sfLuceneModelIndexerHandler extends sfLuceneIndexerHandler
{
  public function rebuild()
  {
    $models = $this->getSearch()->getParameter('models');

    foreach ($models->getNames() as $name)
    {
      $this->rebuildModel($name);
    }
  }
}