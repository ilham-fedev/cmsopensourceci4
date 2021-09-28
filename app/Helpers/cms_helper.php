<?php
/**
 * Helper CMS
 */
function dateConvert($date, $format = 'd m Y')
{
    return date($format, strtotime($date));
}

function shortNews($value)
{
    $isi_berita = strip_tags($value); 
    $isi = substr($isi_berita,0,100); 
    $isi = substr($isi_berita,0,strrpos($isi," "));

    return $isi;
}

function idmenu($menu)
{
    return strtolower(str_replace(" ","-",$menu));
}

function method($method)
{
    echo "<input type='hidden' name='_method' value='$method' />";
}

function thumb($image)
{
    $replace = str_replace(".webp","",$image);

    return "/images/thumb/" . $replace;
}

function checkImageExist($image, $destination, $alt_destination)
{
    if(file_exists($destination . $image))
    {
        return $destination . $image;
    }

    return $alt_destination . $image;
}

function checkImageFolder($image, $destination = 'album', $alternative = 'images/faces/none.jpg')
{
    $folder = 'images/' . $destination .'/';
    if(file_exists($folder . $image))
    {
        return $folder . $image;
    }

    return $alternative;
}