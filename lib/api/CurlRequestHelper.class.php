<?php 

class CurlRequestHelper
{
	 static public function processCurl($url, $postvars, $retries = 3, $verbose = false)
   {
       $count = 0;
			$success = false;
			try
			{
        while ($count < $retries)
        {
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_HEADER, true);
           curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
           curl_setopt($ch, CURLOPT_POST, true);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

           $response = curl_exec($ch);
           // $this->parseResults();
           if ($response)
           {
               $success = true;
               break;
           }
           else
           {
               $success = false;
               // break;
           }
           $count++;
        }
			}
			catch(Exception $e)
			{
				exit($e);
			}
       curl_close($ch);
			return $verbose ? $response : $success;
   }
}