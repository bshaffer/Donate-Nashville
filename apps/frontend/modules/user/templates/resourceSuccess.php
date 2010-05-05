Have Time<br />
<?php foreach($haveTimeResources as $haveTimeResource): ?>
  <?php echo $haveTimeResource->title ?><br />
<?php endforeach; ?>

Need Time<br />
<?php foreach($needTimeResources as $needTimeResource): ?>
  <?php echo $needTimeResource->title ?><br />
<?php endforeach; ?>

Have Stuff<br />
<?php foreach($haveStuffResources as $haveStuffResource): ?>
  <?php echo $haveStuffResource->title ?><br />
<?php endforeach; ?>

Need Stuff<br />
<?php foreach($needStuffResources as $needStuffResource): ?>
  <?php echo $needStuffResource->title ?><br />
<?php endforeach; ?>
