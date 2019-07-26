<?php

if(!isset($_POST['base64']) || $_POST['base64']=='') {
    echo '{"status":"fail","message":"Image base64 code is not found."}';
    exit;
}

$base64 = $_POST['base64'];

$data = [
    "requests" => [
        "image" => [
            "content"=> $base64
        ],
        "features"=> [
        [
          "maxResults" => 50,
          "type" => "LANDMARK_DETECTION"
        ],
        [
          "maxResults" => 50,
          "type" => "FACE_DETECTION"
        ],
        [
          "maxResults" => 50,
          "type" => "OBJECT_LOCALIZATION"
        ],
        [
          "maxResults" => 50,
          "type" => "LOGO_DETECTION"
        ],
        [
          "maxResults"=> 50,
          "type"=> "LABEL_DETECTION"
        ],
        [
          "maxResults"=> 50,
          "type"=> "DOCUMENT_TEXT_DETECTION"
        ],
        [
          "maxResults"=> 50,
          "type"=> "SAFE_SEARCH_DETECTION"
        ],
        [
          "maxResults"=> 50,
          "type"=> "IMAGE_PROPERTIES"
        ],
        [
          "maxResults"=> 50,
          "type"=> "CROP_HINTS"
        ],
        [
          "maxResults"=> 50,
          "type"=> "WEB_DETECTION"
        ]
      ]
    ]
];
$api_key = '*******************************************';
$url = "https://vision.googleapis.com/v1/images:annotate?key=".$api_key;

$payload = json_encode($data);

// Prepare new cURL resource
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload))
);

$result = json_decode(curl_exec($ch), true);
curl_close($ch);

if(isset($result['error']))
    $resp = array('status'=>'fail','message'=>$result['error']['message']);

if(isset($result['responses']))
    $resp = array('status'=>'success','data'=>$result);

$json = json_encode($resp);
print_r($json);
exit;

?>
