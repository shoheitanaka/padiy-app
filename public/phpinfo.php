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
$headers = ["Authorization: Bearer UWR82JEP4pcWnm8m9GIEgFccE6BicSkO"];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
$response = curl_exec($ch);
curl_close($ch);
echo 'TEST';
echo json_decode($response, true);

//echo $data;