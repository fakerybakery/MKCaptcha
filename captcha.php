function generateCaptcha($str) {

    $width = strlen($str) * 25;
    $height = 40;

    $image = imagecreatetruecolor($width, $height);

    $background_color = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $background_color);

    // Add random noise to the background
    for ($i = 0; $i < ($width * $height) / 3; $i++) {
        $x = rand(0, $width - 1);
        $y = rand(0, $height - 1);
        imagesetpixel($image, $x, $y, imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255)));
    }

    // Write each letter with random rotation and font size
    $x = 5;
    $y = ($height - 10);
    for ($i = 0; $i < strlen($str); $i++) {
        $char = $str[$i];
        $angle = rand(-20, 20); // Random rotation angle between -20 and 20 degrees
        $font_size = rand(20, 30); // Random font size between 20 and 30 pixels
        $text_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255)); // Random text color
        $font_file = "font.ttf"; // Use a different font file if you like
        imagettftext($image, $font_size, $angle, $x, $y, $text_color, $font_file, $char);
        $x += 25;
    }

    header("Content-type: image/png");
    imagepng($image);

    imagedestroy($image);
}
