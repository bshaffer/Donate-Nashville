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
 * @subpackage Filter
 * @author Carl Vondrick
 * @version SVN: $Id: sfLuceneRenderingFilter.class.php 7108 2008-01-20 07:44:42Z Carl.Vondrick $
 */
class sfLuceneRenderingFilter extends sfRenderingFilter
{
  public function execute($filterChain)
  {
    $filterChain->execute();

    $this->getContext()->getResponse()->sendContent();
  }
}