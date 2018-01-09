<html><body>

<?php

// Загрузка штампа и фото, для которого применяется водяной знак (называется штамп или печать)
$im = imagecreatefromjpeg('1.jpg');

// Сначала создаем наше изображение штампа вручную с помощью GD
$stamp = imagecreatefrompng("logo.png");
imagestring($stamp, 3, 65, 0, '(C)Copyright', 0x0000FF);
imagestring($stamp, 3, 30, 0,  date("Y"), 0x0000FF);

        $background = imagecolorallocate($stamp, 0, 0, 0);
        // removing the black from the placeholder
        $white = imagecolorallocate($stamp, 255, 255, 255); 
        imagefill($stamp,0,0,$white);
        
        //imagecolortransparent($stamp, $background);

        // turning off alpha blending (to ensure alpha channel information is preserved, rather than removed (blending with the rest of the image in the form of black))
        imagealphablending($stamp, false);

        // turning on alpha channel information saving (to ensure the full range of transparency is preserved)
        imagesavealpha($stamp, true);

// Установка полей для штампа и получение высоты/ширины штампа
$marge_right = 20;
$marge_bottom = 20;
$sx = imagesx($stamp);
$sy = imagesy($stamp);

// Слияние штампа с фотографией. Прозрачность 50%

imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 70);

// Сохранение фотографии в файл и освобождение памяти

imagepng($im, 'photo_stamp.png');
imagedestroy($im);

?>

<img src="photo_stamp.png">
</body>
</html>