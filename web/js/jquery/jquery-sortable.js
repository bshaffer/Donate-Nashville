parent_container_class = 'sortable-container';
container_class = 'sortable';

$(document).ready(function(){
  reset_controls() 
});

function reset_controls() 
{
  path = '.'+parent_container_class+' .'+container_class;
  $('.'+container_class+' .up, .'+container_class+' .down').css('display', 'inline');
  // $('.'+container_class).parent().find('.'+container_class+':first .up:first, .'+container_class+':last .down:first').css('display', 'none');
  $(path+':first .up, '+path+':last .down').css('display', 'none');
}

function up(e)
{
  var pos = parseInt($(e).parents('.'+container_class).find('input.position:first').attr('value'));

  if(pos == 1) return;
  $("."+container_class+" input.position").each(function(e) {
    if ($(this).attr('value') == pos-1) {
      $(this).attr('value', pos);
    }
    else if($(this).attr('value') == pos)
    {
      $(this).attr('value', pos-1);
      $(this).parents('.'+container_class).prev().before($(this).parents('.'+container_class));
    }
  });
  reset_controls();
}

function down(e)
{
  var pos = parseInt($(e).parents('.'+container_class).find('input.position:first').attr('value'));
  var last = parseInt($("."+container_class+" input.position:last").attr('value'));
  if(pos == last) return;
  $("."+container_class+" input.position").each(function(e) {
    if ($(this).attr('value') == pos+1) {
      $(this).attr('value', pos);
    }
    else if($(this).attr('value') == pos)
    {
      $(this).attr('value', pos+1);
      $(this).parents('.'+container_class).next().after($(this).parents('.'+container_class));
    }
  });
  reset_controls();
}
