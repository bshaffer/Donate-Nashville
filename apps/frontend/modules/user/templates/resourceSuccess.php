<?php if ($haveTimeResources->count() || $needTimeResources->count() || $haveStuffResources->count() || $needStuffResources->count()): ?>

<?php if ($haveTimeResources->count()): ?>
<h3>Have Time</h3>
<ul>
  <?php foreach($haveTimeResources as $haveTimeResource): ?>
    <li><?php echo $haveTimeResource->title ?></li>
  <?php endforeach; ?>  
</ul>
<?php endif ?>

<?php if ($needTimeResources->count()): ?>
<h3>Need Time</h3>
<ul>
<?php foreach($needTimeResources as $needTimeResource): ?>
  <li><?php echo $needTimeResource->title ?><br /></li>
<?php endforeach; ?>
</ul>
<?php endif ?>

<?php if ($haveStuffResources->count()): ?>
<h3>Need Time</h3>
<ul>
<?php foreach($haveStuffResources as $haveStuffResource): ?>
  <li><?php echo $haveStuffResource->title ?></li>
<?php endforeach; ?>
</ul>
<?php endif ?>

<?php if ($needStuffResources->count()): ?>
<h3>Need Stuff</h3>
<ul>
<?php foreach($needStuffResources as $needStuffResource): ?>
  <li><?php echo $needStuffResource->title ?></li>
<?php endforeach; ?>
</ul>
<?php endif ?>

<?php else: ?>
  <p>You have no current activity! Click the links above to donate or find</p>
<?php endif ?>
