<div class="main-col">
  <h1>I Need Help...</h1>

  <?php include_partial('default/flashes') ?>
  <?php use_stylesheets_for_form($form) ?>
  <?php use_javascripts_for_form($form) ?>

  <?php use_helper('dh','FormField') ?>
  
  <?php include_partial('default/flashes') ?>

  <form action="<?php echo url_for('@add_need_time_create') ?>" method="post" name="time_resource" class="styled-form">
    <?php echo $form->renderGlobalErrors() ?>
    <?php echo $form->renderHiddenFields() ?>

    <fieldset>
    <legend>* Required field</legend>
    <ul>
    <h2>Resource Info</h2>
    
    <li>
      <label>Community *</label>
      <?php echo outputFormField($form['neighborhood']) ?>
    </li>
    
    <li class="form-date">
      <label>When *</label>
    
      <ul>
        <li>
        <label>Date:</label> <?php echo outputFormField($form['resource_date']) ?>
        </li>
    
        <li class="medium">
          <label>Time:</label> <?php echo outputFormField($form['start_time']) ?>
          to
            <?php echo outputFormField($form['end_time']) ?>
        </li>
      </ul>
    </li>
  
    <li class="large">
      <label>What *</label>
      <?php echo outputFormField($form['title']) ?>
    </li>

    <li class="small">
      <label># of Volunteers</label>
      <?php echo outputFormField($form['num_volunteers']) ?>
    </li>

    <li class="form-description">
      <label>Description *</label>
      <?php echo outputFormField($form['description']) ?>
    </li>
  
    </ul>
    <hr/>

    <h2>Contact Info</h2>
    <ul>
    <li>
      <label>Contact Name</label>
      <?php echo outputFormField($form['contact_name']) ?>
    </li>

    <li class="large">
      <label>Address</label>
      <?php echo outputFormField($form['address_1']) ?><br/>
      <?php echo outputFormField($form['address_2']) ?>
    </li>

    <li>
      <label>City</label>
      <?php echo outputFormField($form['city']) ?>
    </li>

    <li class="medium">
      <label>Zip</label>
      <?php echo outputFormField($form['zip']) ?>
    </li>
  
    <li>
      <label>Email *</label>
        <?php echo outputFormField($form['email']) ?>
    </li>
    
    <li>
      <label>Primary Phone Number</label>
        <?php echo outputFormField($form['phone_1']) ?>
    </li>
    
    <li>
      <label>Alternate Phone Number</label>
        <?php echo outputFormField($form['phone_2']) ?>
    </li>
  
    <li>
      <label>Privacy *</label>
        <?php echo outputFormField($form['privacy']) ?>
    </li>
  
    <li><input type="submit" value="submit" class="button"/></li>
    </ul>
    </fieldset>
  </form>
</div>

<?php slot('sidebar') ?>

<?php end_slot() ?>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>
