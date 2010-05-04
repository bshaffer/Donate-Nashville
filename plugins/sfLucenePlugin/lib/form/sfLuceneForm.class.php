<?php
/*
 * This file is part of the sfLucenePLugin package
 * (c) 2007 - 2008 Carl Vondrick <carl@carlsoft.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Base class for the simple form.  If you wish to overload this, please use
 * sfLuceneSimpleForm instead.
 *
 * @package    sfLucenePlugin
 * @subpackage Form
 * @author     Carl Vondrick <carl@carlsoft.net>
 * @version SVN: $Id: sfLuceneForm.class.php 7108 2008-01-20 07:44:42Z Carl.Vondrick $
 */

abstract class sfLuceneForm extends sfForm
{
  /**
   * Gives this form these categories
   * @param array $categories The array of categories to assign to this form
   */
  public function setCategories($categories)
  {
    if (!is_array($categories))
    {
      throw new sfLuceneException('Array of categories must be just that: an array (' . gettype($categories) . ' given');
    }

    // set categories
    $this->setOption('categories', $categories);

    // we now must reconfigure the form
    $this->setup();
    $this->configure();
  }

  /**
   * Returns all the categories configured for this form
   */
  public function getCategories()
  {
    return $this->getOption('categories', array());
  }

  /**
   * Returns true if the form has categories, false if not
   */
  public function hasCategories()
  {
    return count($this->getOption('categories', array())) > 0;
  }
}
