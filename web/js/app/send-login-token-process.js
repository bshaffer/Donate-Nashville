initSendTokenAjaxForm = function()
{
  $('#send-token-form').ajaxForm({
    target: $('#send-token-form').parent()
  });
}