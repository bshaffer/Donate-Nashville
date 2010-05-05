<?php

//////////////////////////////
// js

// dependencies for resource filter
use_javascript('/js/jquery/jquery.debounce.min.js');

// include filter library
use_javascript('/js/app/ResourceFilter.js');

// call the resource filter onload code
use_javascript('/js/app/ResourceFilterInit.js');


//////////////////////////////
// css

use_stylesheet('/css/app/resource_list.css');

?>

<h2>Search Results</h2>
<div id="ResourceResultsList">
	<div class="emptyList">[ Search for items below ]</div>
</div>

<h2>Search Form</h2>
<div>
	<form class="resourceFilter" action="<?php echo url_for('@stuff_list'); ?>" method="get" accept-charset="utf-8">
		<div><label for="resource">Need</label><input type="text" class="resource" name="resource" value="" id="ResourceFilter"></div>
	</form>
</div>