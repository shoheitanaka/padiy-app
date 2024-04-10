<?php
//phpinfo();
$filepath = '/home/kusanagi/paidy_artws/padiy-app/storage/box_data/photo.png';
$name = 'photo.png';
$data = new \CurlFile($filepath, mime_content_type($filepath), $name);
//echo $data;
