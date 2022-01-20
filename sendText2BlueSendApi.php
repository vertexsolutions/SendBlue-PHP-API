<?php
//----Simple Code to Send/Receive SendBlue Message API.
// if you need any help contact wtanoli@gmail.com
//------------------------------------------------------or Whatsapp +92 334 895 8685
//--- Complete Solution Automatic Bot ..............


$data_array =  array(
      "number"        => "+923348958685",
	  "content"        => "Hello Waseem Akhtar How are you today. This is a test Message.",
	  "send_style"        => "invisible",
	   "media_url" => "https://source.unsplash.com/random.png",
	  "statusCallback"        => "http://www.vbizsol.com/imessage/response.php",
       
);


$make_call = callAPI('POST', 'https://api.sendblue.co/api/send-message', json_encode($data_array,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
$response = json_decode($make_call, true);
$errors   = $response['response']['errors'];
$data     = $response['response']['data'][0];

echo "Done";
echo "<br>";
echo '<pre>'; print_r($response); echo '</pre>';

echo "<br>";echo "<br>";

echo $response['is_outbound'];
echo $response['status'];



function callAPI($method, $url, $data){
   $curl = curl_init();
   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }
   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'sb-api-key-id: 660dc39e9beeef400eb595054def3fed',
	  'sb-api-secret-key: 868f274ae5d52cbc1e0eddf506e8d97a',
      'Content-Type: application/json',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}





?>