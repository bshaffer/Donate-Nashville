<?php
/*
Incoming variables:
$resource_type will be 'stuff' or 'time'
$resource_action will be 'have' or 'need'
*/

//////////////////////////////
// js

// dependencies for resource filter
// jquery is included in the overall layout
use_javascript('/js/jquery/jquery.debounce.min.js');

// include filter library
use_javascript('/js/app/ResourceFilter.js');

// call the resource filter onload code
//  use different onload for time and stuff
use_javascript('/js/app/ResourceFilterInit'.ucwords($resource_type).'.js');


//////////////////////////////
// css

use_stylesheet('/css/app/resource_list.css');

?>
<div class="clear">&nbsp;<?php echo $resource_action ?></div>
<h2 class="half-margin"><?php include_partial('resource/list_header', array('type' => $resource_type, 'action' => $resource_action)) ?></h2>
<?php echo image_tag('icons/magnify-large.png', array('class'=>"left", 'width'=>"44", 'height'=>"41", 'alt'=>"Magnify Large")) ?>
<?php include_component('resource', $resource_type.'_filter_form', array('resource_action' => $resource_action)); ?>
<hr />
<div id="ResourceResultsList">
	<div id="ResultsContainer">

    <div class="emptyList">Please search for items above.</div>
     
    <?php /* the following line is shown only when a search is executed and no results are found. */ ?>
    <div class="noResults hidden">No results were found for this search.</div>

    <?php /* the following line is shown only when a search has additional results. */ ?>
    <div class="moreResults hidden"><span class="moreResultsLink">+ <a title="more results">Load more results</a></div>
  </div>
</div>
