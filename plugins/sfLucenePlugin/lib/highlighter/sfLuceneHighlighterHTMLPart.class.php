<?php
/*
 * This file is part of the sfLucenePlugin package
 * (c) 2007 - 2008 Carl Vondrick <carl@carlsoft.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Highlighter for HTML that is not a full document.
 *
 * @package    sfLucenePlugin
 * @subpackage Highlighter
 * @author     Carl Vondrick <carl@carlsoft.net>
 * @version SVN: $Id: sfLuceneHighlighterHTMLPart.class.php 7108 2008-01-20 07:44:42Z Carl.Vondrick $
 */
class sfLuceneHighlighterHTMLPart extends sfLuceneHighlighterHTML
{
  protected $partToken = null;

  protected function prepare()
  {
    $this->partToken = '<!--[[' . md5(__FILE__) . ']]-->';

    // convert the data to a full document and we'll remove this part later
    $this->data = '<html><body>' . $this->partToken . $this->data . $this->partToken . '</body></html>';

    parent::prepare();
  }

  protected function cleanup()
  {
    parent::cleanup();

    $start = strpos($this->data, $this->partToken) + strlen($this->partToken);
    $end = strrpos($this->data, $this->partToken);

    $this->data = substr($this->data, $start, $end - $start);
  }
}