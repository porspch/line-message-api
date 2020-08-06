<?php
   $accessToken = "p7tGM4q/PdhBFVzB8N+IGaK7goIZKAT3ClnZ4CT5DyIjAG4orpG4pwZXlg2XxqgQHjlHY9ceiJpiwoHNLElXr5AvPppKn8joc4pzjWIH4FXMcCiUubVTSDQsMSmgcinjQz1ltjePk5xKCQgvj+Y/kgdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า
   $content = file_get_contents('php://input');
   $arrayJson = json_decode($content, true);
   $arrayHeader = array();
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
   //รับข้อความจากผู้ใช้
   $message = $arrayJson['events'][0]['message']['text'];
   //รับ id ของผู้ใช้
   $id = $arrayJson['events'][0]['source']['userId'];
   if(!empty($message)){
        // for($i=1;$i<=10;$i++){
        //     $arrayPostData['to'] = $id;
        //     $arrayPostData['messages'][0]['type'] = "text";
        //     $arrayPostData['messages'][0]['text'] = $i;
        //     pushMsg($arrayHeader,$arrayPostData);
        // }
        sleep(10);
        $arrayPostData['to'] = $id;
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "DOSCG";
        pushMsg($arrayHeader,$arrayPostData);
    }
   function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
   exit;
?>