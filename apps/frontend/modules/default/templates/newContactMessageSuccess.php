<div class="main-col">
  <h1>Got questions?  Let us help.</h1>

  <?php include_partial('default/contact_form', array('form' => $form)) ?>
</div>

<?php slot('sidebar') ?>
  <!-- <div class="widget special clearfix">
    <h3 class="half-margin">Important Message</h3>
    <p class="half-margin">
      <strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</strong>
    </p>
  </div>
  <div class="widget clearfix">
    <h3 class="half-margin">Quick Message</h3>
    <ul>
      <li>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
      </li>
      <li>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </li>
    </ul>
  </div> -->
<?php end_slot() ?>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>
