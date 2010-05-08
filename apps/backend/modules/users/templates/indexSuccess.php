<div id="stat-tabs">
  <ul>
    <li><a href="#users">Users: <?php echo $users->count() ?></a></li>
    <li><a href="#groups">Groups: <?php echo $groups->count() ?></a></li>
    <li><a href="#permissions">Permissions: <?php echo $permissions->count() ?></a></li>
  </ul>
  <?php $list = array('users', 'groups', 'permissions'); ?>

  <div id="lists">
    <div id="users" class="list_type">
      <h2>Users</h2>    
      <?php include_partial('users/users', array('users' => $users)) ?>
    </div>

    <div id="groups" class="list_type">
      <h2>Groups</h2>    
      <?php include_partial('users/groups', array('groups' => $groups)) ?>
    </div>

    <div id="permissions" class="list_type">
      <h2>Permissions</h2>    
      <?php include_partial('users/permissions', array('permissions' => $permissions)) ?>
    </div>
  </div>
</div>