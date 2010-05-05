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

<h2>Search Form</h2>
<div>
<?php include_component('resource', $resource_type.'_filter_form', array('resource_action' => $resource_action)); ?>
</div>

<h2>Search Results</h2>
<div id="ResourceResultsList">
	<div class="emptyList">[ Search for items above ]</div>
</div>
