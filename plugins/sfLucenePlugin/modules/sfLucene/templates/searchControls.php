<?php
/**
 * @package sfLucenePlugin
 * @subpackage Module
 * @author Carl Vondrick <carl@carlsoft.net>
 * @version SVN: $Id: searchControls.php 7108 2008-01-20 07:44:42Z Carl.Vondrick $
 */
?>

<?php use_helper('sfLucene', 'I18N') ?>

<h2><?php echo __('Search') ?></h2>
<p><?php echo __('Use our search engine to pinpoint exactly what you need on our site.') ?></p>

<?php include_search_controls($form) ?>