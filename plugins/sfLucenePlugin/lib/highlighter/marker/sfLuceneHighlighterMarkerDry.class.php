<?php
/*
 * This file is part of the sfLucenePlugin package
 * (c) 2007 - 2008 Carl Vondrick <carl@carlsoft.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * A dry highlighter that doesn't do any highlighting (ie, it's out of ink!)
 *
 * @package    sfLucenePlugin
 * @subpackage Highlighter
 * @author     Carl Vondrick <carl@carlsoft.net>
 * @version SVN: $Id: sfLuceneHighlighterMarkerDry.class.php 7108 2008-01-20 07:44:42Z Carl.Vondrick $
 */
class sfLuceneHighlighterMarkerDry extends sfLuceneHighlighterMarker
{
  public function highlight($input)
  {
    return $input;
  }

  static public function generate()
  {
    return new sfLuceneHighlighterMarkerHarness(array(new self));
  }
}