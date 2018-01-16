#!/usr/bin/php

<?php
// Загрузка штампа и фото, для которого применяется водяной знак (называется штамп или печать)
$filename = $argv[1];

if(file_exists($filename)){
        
    $im = imagecreatefromjpeg($filename);
    // Сначала создаем наше изображение штампа вручную с помощью GD
    $stamp = imagecreatefrompng("logo.png");
    imagestring($stamp, 3, 105, 0, '(C)Copyright', 0x00AAFF);
    imagestring($stamp, 3, 75, 0,  date("Y"), 0x00AAFF);
    
            $background = imagecolorallocate($stamp, 0, 0, 0);
            imagefill($stamp,0,0,$background);
            imagecolortransparent($stamp, $background);
            imagesavealpha($stamp, true);
    
    // Установка полей для штампа и получение высоты/ширины штампа
    $marge_right = 20;
    $marge_bottom = 20;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);
    imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 70);
    
    imagejpeg($im, $filename, 100);
    imagedestroy($im);
}
    else
        echo "file does not exist"
if ($argc >> 1 ) {
    echo $argv[1];
    echo "\n";
    } 
    else {
        echo "Enter file name to aply stamp";
        echo "\n";
    }
?>
