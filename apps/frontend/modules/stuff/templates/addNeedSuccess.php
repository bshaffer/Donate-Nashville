<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php use_helper('FormField') ?>

<div class="main-col">
  <h1>I Need Stuff... Add New Item</h1>

  <?php include_partial('default/flashes') ?>

  <form action="<?php echo url_for('@add_need_stuff') ?>" method="post" name="stuff_resource" class="styled-form">
    <?php echo $form->renderGlobalErrors() ?>
    <?php echo $form->renderHiddenFields() ?>
      <?php echo $form->renderGlobalErrors() ?>
      <?php echo $form->renderHiddenFields() ?>
      <fieldset id="" class="">
        <legend>* Required</legend>
        <h2>Item Information</h2>
        <ul>

        <li>
          <label>Community *</label>
          <?php echo outputFormField($form['neighborhood']) ?>
        </li>

        <li class="large">
            <label>What *</label>
            <?php echo outputFormField($form['title']) ?>
          </li>

          <li class="small">
            <label>Quantity</label>
            <?php echo outputFormField($form['quantity']) ?>
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
        <li><input type="submit" value="Add my Need" class="button"/></li>
    </ul>
    
    </fieldset>
  </form>
</div>
  <input type="submit" value="submit" />
</form>


<?php slot('sidebar') ?>
  
<?php end_slot() ?>

<?php slot('breadcrumbs', get_component('default', 'breadcrumbs')) ?>