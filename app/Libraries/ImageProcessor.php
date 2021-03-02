<?php

namespace App\Libraries;

class ImageProcessor
{

    public static function is_image($path)
    {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'jfif']);
    }

    public static function image_cache($path, $w, $h)
    {
        $info = pathinfo($path);
        $hash = md5_file($path);
        $cp = "{$info['dirname']}/{$info['filename']}_{$w}_{$h}_{$hash}.{$info['extension']}";
        if (!is_file($cp)) {
            imagejpeg(static::resize_image($path, $w, $h), $cp);
        }
        return $cp;
    }

    public static function resize_image($file, $w, $h)
    {
        list($width, $height) = getimagesize($file);
        $x = 0;
        $y = 0;
        $r = $w / $h;
        $ratio = $width / $height;

        if ($r > $ratio) {
            $nh = $h / $w * $width;
            $y = ($height - $nh) / 2;
            $height = $nh;
        } else {
            $nw = $w / $h * $height;
            $x = ($width - $nw) / 2;
            $width = $nw;
        }

        switch (pathinfo($file, PATHINFO_EXTENSION)) {
            case 'jpg':
            case 'jpeg':
            case 'jfif':
                $src = imagecreatefromjpeg($file);
                break;
            case 'png':
                $src = imagecreatefrompng($file);
                break;
            case 'gif':
                $src = imagecreatefromgif($file);
                break;
            default:
                exit;
        }
        $dst = imagecreatetruecolor($w, $h);
        imagecopyresampled($dst, $src, 0, 0, $x, $y, $w, $h, $width, $height);

        return $dst;
    }
}
