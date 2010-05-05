<?php

// include filter libraries
use_javascript('/js/jquery/jquery.debounce.min.js');
use_javascript('/js/app/ResourceFilter.js');


javsacript_tag("
ResourceFilter.attachEvent('test');
");

?>

<div>
	This will be the resource list.
</div>

<div>
	<form action="_resource_filter_submit" method="post" accept-charset="utf-8">
		<div><label for="need">Need</label><input type="text" name="need" value="" id="NeedFilter"></div>
		

		<p><input type="submit" value="Continue &rarr;"></p>
	</form>