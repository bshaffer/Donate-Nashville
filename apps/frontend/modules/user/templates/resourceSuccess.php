<div class="main-col">
<h1>Dashboard</h1>

<?php if ($haveTimeResources->count() || $needTimeResources->count() || $haveStuffResources->count() || $needStuffResources->count()): ?>
  <?php if ($haveTimeResources->count()): ?>
  <h3>Have Time</h3>
  <ul>
    <?php foreach($haveTimeResources as $haveTimeResource): ?>
    <?php include_partial('resource/list_item', array('resource' => $haveTimeResource)) ?>
    <?php endforeach; ?>  
  </ul>
  <?php endif ?>

  <?php if ($needTimeResources->count()): ?>
  <h3>Need Time</h3>
  <ul>
  <?php foreach($needTimeResources as $needTimeResource): ?>
    <?php include_partial('resource/list_item', array('resource' => $needTimeResource)) ?>
  <?php endforeach; ?>
  </ul>
  <?php endif ?>

  <?php if ($haveStuffResources->count()): ?>
  <h3>Need Time</h3>
  <ul>
  <?php foreach($haveStuffResources as $haveStuffResource): ?>
    <?php include_partial('resource/list_item', array('resource' => $haveStuffResource)) ?>
  <?php endforeach; ?>
  </ul>
  <?php endif ?>

  <?php if ($needStuffResources->count()): ?>
  <h3>Need Stuff</h3>
  <ul>
  <?php foreach($needStuffResources as $needStuffResource): ?>
    <?php include_partial('resource/list_item', array('resource' => $needStuffResource)) ?>
  <?php endforeach; ?>
  </ul>
  <?php endif ?>

  <?php else: ?>
    <p>You have no current activity! Click the links above to donate or find</p>
  <?php endif ?>
</div>
