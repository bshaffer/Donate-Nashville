<?php
/**
 * @package sfLucenePlugin
 * @subpackage Module
 * @author Carl Vondrick <carl@carlsoft.net>
 * @version SVN: $Id: searchNoResults.php 7108 2008-01-20 07:44:42Z Carl.Vondrick $
 */
?>

<?php use_helper('sfLucene', 'I18N') ?>

<h2><?php echo __('No Results Found') ?></h2>
<p><?php echo __('We could not find any results with the search term you provided.') ?></p>

<?php include_search_controls($form) ?>