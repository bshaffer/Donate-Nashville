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
  * @subpackage Test
  * @author Carl Vondrick
  * @version SVN: $Id: prove.php 7108 2008-01-20 07:44:42Z Carl.Vondrick $
  */

require dirname(__FILE__) . '/bootstrap/unit.php';
require $sf_symfony_lib_dir . '/util/sfFinder.class.php';

$h = new lime_harness(new lime_output_color());
$h->base_dir = dirname(__FILE__);

// register unit tests
$finder = sfFinder::type('file')->ignore_version_control()->follow_link()->name('*Test.php');
$h->register($finder->in($h->base_dir));

$h->run();