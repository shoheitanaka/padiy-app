<?php

//phpinfo();
$file_id = '1496375257863';
$filepath = '/home/kusanagi/paidy_artws/padiy-app/storage/box_data/woocommerce_merchant_list.xlsx';
$name = 'woocommerce_merchant_list.xlsx';

$endpoint = $file_id.'/content';

$params = [
    'attributes' => json_encode([
        'name' => $name
    ]),
    'file' => new \CurlFile($filepath, mime_content_type($filepath), $name)
];

$url = 'https://upload.box.com/api/2.0/files/'.$endpoint;
$headers = ["Authorization: Bearer PawjC5OWevz4bZk3cMFS1aPRdHiDinZW", "Content-Type: multipart/form-data"];
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
