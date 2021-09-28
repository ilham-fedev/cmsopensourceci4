<?php
namespace App\Libraries;

class Factory{
    /**
     * Rules function
     * 
     * @return void
     */
    static function rules() 
    {
        return [
            '0' => 'User',
            '1' => 'Admin'
        ];
    }
    /**
     * Bulan function
     *
     * @return void
     */
    static function bulan($bln = null)
    {
        $bulan = ['Pilih Bulan','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        if($bln == null)
        {
            return $bulan;
        }

        $a = abs($bln);
        return $bulan[$a];
    }

    /**
     * convertImageToWebP
     */
    static function convertImageToWebP($source, $destination, $quality=75) {
        $extension = pathinfo($source, PATHINFO_EXTENSION);
        if ($extension == 'jpeg' || $extension == 'jpg') 
            $image = imagecreatefromjpeg($source);
        elseif ($extension == 'gif') 
            $image = imagecreatefromgif($source);
        elseif ($extension == 'png') 
            $image = imagecreatefrompng($source);
        return imagewebp($image, $destination, $quality);
    }

    
}