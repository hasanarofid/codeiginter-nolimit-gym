<?php

namespace App\Libraries;

use Picqer\Barcode\BarcodeGeneratorPNG;

class CardGenerator
{
    /**
     * Generate member card image
     * 
     * @param array $customerData Array containing id, nama, kdcab, etc.
     * @param string|null $framePath Path to the twibbon/frame PNG file
     * @return string Raw image data (PNG)
     */
    public function generate($customerData, $framePath = null)
    {
        // Card dimensions (standard ID card aspect ratio is ~1.58, but we'll use 1000x633 for high quality)
        $width = 1000;
        $height = 633;
        
        $card = imagecreatetruecolor($width, $height);
        
        // Enable alpha blending and save alpha
        imagealphablending($card, true);
        imagesavealpha($card, true);
        
        // Background color (White with full transparency if no frame, or just white)
        $white = imagecolorallocate($card, 255, 255, 255);
        imagefilledrectangle($card, 0, 0, $width, $height, $white);
        
        // Load Frame if exists
        if ($framePath && file_exists($framePath)) {
            $frame = imagecreatefrompng($framePath);
            if ($frame) {
                list($fWidth, $fHeight) = getimagesize($framePath);
                imagecopyresampled($card, $frame, 0, 0, 0, 0, $width, $height, $fWidth, $fHeight);
                imagedestroy($frame);
            }
        } else {
            // Default "Nolimit Gym" minimal design if no frame
            $red = imagecolorallocate($card, 200, 0, 0);
            imagefilledrectangle($card, 0, 0, $width, 50, $red);
            
            $black = imagecolorallocate($card, 33, 33, 33);
            imagestring($card, 5, 20, 15, "NOLIMIT GYM MEMBER CARD", $white);
        }
        
        // Load Profile Image if exists (fp_image)
        if (isset($customerData['fp_image']) && !empty($customerData['fp_image'])) {
            $photoPath = './img/uploads/member/fp/' . $customerData['fp_image'];
            if (file_exists($photoPath)) {
                $photo = null;
                $ext = pathinfo($photoPath, PATHINFO_EXTENSION);
                if (strtolower($ext) == 'jpg' || strtolower($ext) == 'jpeg') {
                    $photo = imagecreatefromjpeg($photoPath);
                } elseif (strtolower($ext) == 'png') {
                    $photo = imagecreatefrompng($photoPath);
                }
                
                if ($photo) {
                    // Position photo on the left
                    $pWidth = 200;
                    $pHeight = 250;
                    imagecopyresampled($card, $photo, 50, 150, 0, 0, $pWidth, $pHeight, imagesx($photo), imagesy($photo));
                    imagedestroy($photo);
                }
            }
        }
        
        // Barcode Generation
        $generator = new BarcodeGeneratorPNG();
        $barcodeData = $generator->getBarcode($customerData['id'], $generator::TYPE_CODE_128, 3, 100);
        $barcodeImg = imagecreatefromstring($barcodeData);
        
        if ($barcodeImg) {
            $bWidth = imagesx($barcodeImg);
            $bHeight = imagesy($barcodeImg);
            
            // Position barcode (Center bottom)
            $targetBWidth = 400;
            $targetBHeight = 120;
            imagecopyresampled($card, $barcodeImg, ($width - $targetBWidth) / 2, $height - 180, 0, 0, $targetBWidth, $targetBHeight, $bWidth, $bHeight);
            imagedestroy($barcodeImg);
        }
        
        // Text Information
        $black = imagecolorallocate($card, 0, 0, 0);
        $grey = imagecolorallocate($card, 100, 100, 100);
        
        // Using imagestring because TTF might not be available consistently in all envs without path certainty
        // But for "Premium" feel, it's better to use TTF if we can find one. 
        // For now, let's use imagestring but centered.
        
        $name = strtoupper($customerData['nama']);
        $memberId = "ID: " . $customerData['id'];
        
        imagestring($card, 5, ($width - (strlen($name) * 9)) / 2, $height - 240, $name, $black);
        imagestring($card, 4, ($width - (strlen($memberId) * 7)) / 2, $height - 215, $memberId, $grey);
        
        // Output as PNG
        ob_start();
        imagepng($card);
        $imageData = ob_get_clean();
        imagedestroy($card);
        
        return $imageData;
    }
}
