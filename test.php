<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'p7tGM4q/PdhBFVzB8N+IGaK7goIZKAT3ClnZ4CT5DyIjAG4orpG4pwZXlg2XxqgQHjlHY9ceiJpiwoHNLElXr5AvPppKn8joc4pzjWIH4FXMcCiUubVTSDQsMSmgcinjQz1ltjePk5xKCQgvj+Y/kgdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '9c91e2af563a3e5ea510047cfdec0ba5';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array



if ( sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

		sleep(10);

        $reply_message = 'Cool down 10 seconds';
        $reply_token = $event['replyToken'];

		$data = [
            'replyToken' => $reply_token,
            'messages' => [['type' => 'text', $reply_message => json_encode($request_array)]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE); 
		
        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";
        
    }
}

echo "OK";

function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?>