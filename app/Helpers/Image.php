<?php

namespace App\Helpers;

class Image
{
    public static function resize_copy(string $file, string $dst, int $width)
    {
        $info = pathinfo($file);
        $dir = pathinfo($dst)['dirname'];
        if (!is_dir($dir))
            mkdir($dir, 0755, true);
        $ext = strtolower($info['extension']);

        $image = imagecreatefromstring(file_get_contents($file));
        $thumb = imagescale($image, $width, -1, IMG_BILINEAR_FIXED);

        switch ($ext) {
            case 'png':
                imagepng($thumb, $dst);
                break;
            case 'gif':
                imagegif($thumb, $dst);
                break;
            case 'jpeg':
            case 'jpg':
                imagejpeg($thumb, $dst);
                break;
        }
    }
}
