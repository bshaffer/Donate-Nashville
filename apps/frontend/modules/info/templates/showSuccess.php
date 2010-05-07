<div class="main-col info-resource">
  <h1><?php echo $resource->url ? link_to($resource->title, $resource->url) : $resource->title ?></h1>
  <p class="text-large">
		<?php echo $resource->description ?>
	</p>

  <?php if ($resource->url): ?>
    <?php echo link_to('Click to visit the site more information', $resource->url, array('target' => '_blank', 'class' => 'button')) ?>
  <?php endif ?>
</div>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>

<?php slot('sidebar') ?>
  <?php if ($resource->showContactInformation()): ?>
     <div class='contact-info right full-margin'>
       <h3 class="no-margin">Contact Info</h3>
       <?php include_partial('resource/contact_info', array('resource' => $resource)) ?>
     </div>
   <?php endif; ?>
<?php end_slot() ?>