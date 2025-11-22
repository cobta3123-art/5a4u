<?php
header("Content-Type: image/png");

// Caminhos
$imgPath  = "https://i.ibb.co/HfMR2L38/model2.png";
$fontPath = __DIR__ . "/fonts/Chalk Board.ttf";

// Nome digitado DK Lemon Yellow Sun.otf Hand_Of_Sean_Demo.ttf PermanentMarker-Regular.ttf
$texto = $_GET['name'] ?? 'Sem nome';

// Abre imagem
$img = imagecreatefrompng($imgPath);

// Converte para truecolor
$tmp = imagecreatetruecolor(imagesx($img), imagesy($img));
imagecopy($tmp, $img, 0, 0, 0, 0, imagesx($img), imagesy($img));
imagedestroy($img);
$img = $tmp;

/* -----------------------------------------------------
   Efeito de escurecimento (ajuda a simular espelho real)
------------------------------------------------------ */
$overlay = imagecreatetruecolor(imagesx($img), imagesy($img));
$cinza = imagecolorallocatealpha($overlay, 0, 0, 0, 110); 
imagefill($overlay, 0, 0, $cinza);
imagecopymerge($img, $overlay, 0, 0, 0, 0, imagesx($img), imagesy($img), 20);
imagedestroy($overlay);

/* -----------------------------------------------------
   Cor do texto
------------------------------------------------------ */
$corTexto = imagecolorallocatealpha($img, 178, 55, 55, 30);
 // vermelho marcador
$sombra   = imagecolorallocate($img, 20, 20, 20); // sombra

// posição
$x = 400;
$y = 1509;
$tamanho = 226;
$rotacao = -8;

/* -----------------------------------------------------
   Sombra
------------------------------------------------------ */
imagettftext(
    $img,
    $tamanho,
    $rotacao,
    $x + 2,
    $y + 2,
    $sombra,
    $fontPath,
    $texto
);

/* -----------------------------------------------------
   Texto principal
------------------------------------------------------ */
imagettftext(
    $img,
    $tamanho,
    $rotacao,
    $x,
    $y,
    $corTexto,
    $fontPath,
    $texto
);

/* -----------------------------------------------------
   Desfoque leve para integrar ao vidro
------------------------------------------------------ */
if (function_exists('imagefilter')) {
    imagefilter($img, IMG_FILTER_GAUSSIAN_BLUR);
}

// Saída
imagepng($img);
imagedestroy($img);
?>
