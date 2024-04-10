<?php

//phpinfo();
$file_id = '1497186191662';
$filepath = '/home/kusanagi/paidy_artws/padiy-app/storage/box_data/photo.png';
$name = 'photo.png';

$endpoint = $file_id.'/content';

$params = [
    'attributes' => json_encode([
        'name' => $name
    ]),
    'file' => new \CurlFile($filepath, mime_content_type($filepath), $name)
];

$url = 'https://upload.box.com/api/2.0/files/'.$endpoint;
$headers = ["Authorization: Bearer Fc9NgXw1RJWsB4RoaLcVP1zROO0hQi0k", "Content-Type: multipart/form-data"];
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
