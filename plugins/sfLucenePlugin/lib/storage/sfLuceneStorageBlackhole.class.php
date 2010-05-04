<?php
/*
 * This file is part of the sfLucenePlugin package
 * (c) 2007 - 2008 Carl Vondrick <carl@carlsoft.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This storage container does not write to the disc, but instead just stores
 * in memory.  This is useful for unit testing.
 * @package    sfLucenePlugin
 * @subpackage Storage
 * @author     Carl Vondrick <carl@carlsoft.net>
 * @version SVN: $Id: sfLuceneStorageBlackhole.class.php 7108 2008-01-20 07:44:42Z Carl.Vondrick $
 */

class sfLuceneStorageBlackhole implements sfLuceneStorage
{
  protected $data = null;

  public function __construct($file)
  {
  }

  public function read()
  {
    return $this->data;
  }

  public function write($data)
  {
    $this->data = $data;

    return true;
  }

  public function delete()
  {
    $this->data = null;

    return true;
  }
}