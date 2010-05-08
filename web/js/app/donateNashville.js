$(document).ready(function() {
  $('#popup').fancybox({
    padding       : 20,
    type          : 'inline',
    width         : 400,
    height        : 400,
    autoDimensions : false,
    onStart       : function() { $('#popup').css('display', 'block')},
    onClosed        : function() { $('#popup').css('display', 'none')},
  });
  
  $("#popup").trigger('click');
});
