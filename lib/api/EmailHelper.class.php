<?php

/**
*  Swift Mailer Helper Class
*/
class EmailHelper
{
	static function sendEmail($params)
	{
		$mailTo = $params['to'];
 		$mailFrom = $params['from'];
    try
    {
      // Create the Mail Object
      $mailer = new Swift(new Swift_Connection_NativeMail());
      $message = new Swift_Message($params['subject'], $params['body'], 'text/html');

      // Send
      $mailer->send($message, $mailTo, $mailFrom);
      $mailer->disconnect();
      // echo 'Email Sent';
    }
    catch(Exception $e)
    {
      $mailer->disconnect();
      echo 'Error: ' . $e;
    }
	}
}
