<?php

//phpinfo();
$file_id = '1497186191662';
$filepath = '/home/kusanagi/paidy_artws/padiy-app/storage/box_data/photo.png';
$name = 'photo.png';

$endpoint = $file_id.'/content';

$params = [
    'file' => new \CurlFile($filepath, mime_content_type($filepath), $name),
    'name' => 'updated'
];


$url = 'https://upload.box.com/api/2.0/files/'.$endpoint;
$headers = ["Authorization: Bearer 4j8K4RCLm1w696EEOLZfjuW7V4Q8JMmn"];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
echo 'TEST';
$response = curl_exec($ch);
print_r(curl_getinfo($ch));
curl_close($ch);
echo 'TEST2';
echo json_decode($response, true);

//echo $data;
