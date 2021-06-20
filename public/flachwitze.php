<?php
$dir = dirname($_SERVER['DOCUMENT_ROOT']) . "/storage/app/public/flachwitze";
$random = sprintf('%02d', mt_rand(1, 39));
$file = $dir . "/" . $random . '.mp3';

if (file_exists($file)) {
    header("Content-type: audio/mpeg, audio/x-mpeg, audio/x-mpeg-3, audio/mpeg3");
    header('Content-length: ' . filesize($file));
    header('Content-Disposition: filename="flachwitz.mp3"');
    header('X-Pad: avoid browser bug');
    header('Cache-Control: no-cache');
    readfile($file);
} else {
    header("HTTP/1.0 404 Not Found");
}
