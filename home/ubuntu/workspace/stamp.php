<html><body>

<?php
// Загрузка штампа и фото, для которого применяется водяной знак (называется штамп или печать)
    $stamp = imagecreatefrompng('logo.png');
    $im = imagecreatefromjpeg('download.jpg');

// Установка полей для штампа и получение высоты/ширины штампа
$marge_right = 25;
$marge_bottom = 25;
$sx = imagesx($stamp);
$sy = imagesy($stamp);

    // Копирование изображения штампа на фотографию с помощью смещения края
    // и ширины фотографии для расчета позиционирования штампа. 
imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

// Вывод и освобождение памяти
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);

?>
<img="download.jpg">
</body>
</html>