<?php if ($haveTimeResources->count() || $needTimeResources->count() || $haveStuffResources->count() || $needStuffResources->count()): ?>

<div class="main-col">
<h2 class="half-margin">Manage Posts</h2>
<hr>
  <?php if ($haveTimeResources->count()): ?>
  <h3>Have Time</h3>
  <ul class="results-list search-results clearfix">
    <?php $i = 0; ?>
    <?php foreach($haveTimeResources as $haveTimeResource): ?>
    <?php include_partial('resource/list_item', array('resource' => $haveTimeResource, 'class' => $i % 2 == 0 ? 'alt' : '')) ?>
    <?php $i++; ?>
    <?php endforeach; ?>  
  </ul>
  <?php endif ?>

  <?php if ($needTimeResources->count()): ?>
  <h3>Need Time</h3>
  <ul class="results-list search-results clearfix">
    <?php $i = 0; ?>
    <?php foreach($needTimeResources as $needTimeResource): ?>
    <?php include_partial('resource/list_item', array('resource' => $needTimeResource, 'class' => $i % 2 == 0 ? 'alt' : '')) ?>
    <?php $i++; ?>
    <?php endforeach; ?>
  </ul>
  <?php endif ?>

  <?php if ($haveStuffResources->count()): ?>
  <h3>Have Stuff</h3>
  <ul class="results-list search-results clearfix">
    <?php $i = 0; ?>
    <?php foreach($haveStuffResources as $haveStuffResource): ?>
    <?php include_partial('resource/list_item', array('resource' => $haveStuffResource, 'class' => $i % 2 == 0 ? 'alt' : '')) ?>
    <?php $i++; ?>
    <?php endforeach; ?>
  </ul>
  <?php endif ?>

  <?php if ($needStuffResources->count()): ?>
  <h3>Need Stuff</h3>
  <ul class="results-list search-results clearfix">
    <?php $i = 0; ?>
    <?php foreach($needStuffResources as $needStuffResource): ?>
    <?php include_partial('resource/list_item', array('resource' => $needStuffResource, 'class' => $i % 2 == 0 ? 'alt' : '')) ?>
    <?php $i++; ?>
    <?php endforeach; ?>
  </ul>
  <?php endif ?>

  <?php else: ?>
    <p>You have no current activity! Click the links above to donate or find</p>
  <?php endif ?>
</div>
