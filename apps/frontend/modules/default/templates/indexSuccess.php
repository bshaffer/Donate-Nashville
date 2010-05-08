<div class="grid_16">
  <h1 id="power-line">Connecting people in need with neighbors who care.</h1>

  <div id="homepage-desc">
    When a community faces large-scale challenges, needs can easily fall through the cracks. We created
    Donate Nashville to fill in the gaps, inviting our community to post its needs, no matter how small
    or unusual, as well as its many resources. <?php echo link_to('More Info', '@about') ?>
  </div>

  <div class="options-block">
    <div class="left">
      <a href="<?php echo url_for('@need') ?>" title="I Need"><?php echo image_tag("buttons/need-super.png", array('class'=> 'button', 'width'=>'203', 'height' => '100', 'alt'=>"Need Super"))?></a>
  	
  	  <p>Click here if you <strong>need assistance</strong> in any of the following areas:</p>
      <ul>
        <li>Physical <strong>help</strong>, such as removing debris, repairing damage, cleaning, preparing meals and other volunteer-based activities.</li>
        <li><strong>Stuff</strong>, such as food, water, clothing, toys, pet and building supplies.</li>
        <li>Information on emergency <strong>housing</strong> options.</li>
      </ul>
    </div>
  	<?php echo image_tag('options-box-separator.png', array('class' => 'left', 'width' => '3', 'height' => '320', 'alt' => 'Options Box Separator')) ?>
    <div class="left">
      <a href="<?php echo url_for('@have') ?>" title="I Have"><?php echo image_tag("buttons/have-super.png", array('class'=> 'button', 'width'=>'203', 'height' => '100', 'alt'=>"Need Super"))?></a>
  	
  		<p>Click here to <strong>offer assistance</strong> in any of the following areas:</p>
      <ul>
        <li>Volunteer <strong>hours</strong> to remove debris, repair damages, clean, serve meals and other volunteer-based activities.</li>
        <li><strong>Stuff</strong> you can donate, such as food, water, clothing, toys, pet and building supplies.</li>
        <li><strong>Money</strong> for charities assisting flood victims.</li>
      </ul>
    </div>
  </div>
</div>

<?php if ($showPopUp): ?>
  <?php slot('popUp') ?>
  <?php include_partial('homepagePopUp') ?>
  <?php end_slot() ?>  
<?php endif ?>