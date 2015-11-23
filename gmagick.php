<?php

require_once "TestSettings.php";
dl("gmagick.so");

$input_file = __DIR__ . '/' . TestSettings::INPUT_FILE;
$output_file = __DIR__ . "/output/gmagick.jpg";

$timers = [
    'new'      => 0,
    'open'     => 0,
    'get_info' => 0,
    'scale'    => 0,
    'rotate'   => 0,
    'paste'    => 0,
    'save'     => 0,
];

for ($i = 0; $i < TestSettings::NUM_RUNS; $i++) {
    $time_open_start = microtime(true);
    $Image1 = new Gmagick();
    $Image1->readImage($input_file);
    $timers['open'] += (microtime(true) - $time_open_start);

    $time_get_info_start = microtime(true);
    $width = $Image1->getImageWidth();
    $height = $Image1->getImageHeight();
    $timers['get_info'] += (microtime(true) - $time_get_info_start);

    $time_get_info_start = microtime(true);
    $new_width = ceil($width / TestSettings::DOWNSCALE_FACTOR);
    $new_height = ceil($height / TestSettings::DOWNSCALE_FACTOR);
    $timers['get_info'] += (microtime(true) - $time_get_info_start);

    $time_scale_start = microtime(true);
    $Image1->scaleImage($new_width, $new_height);
    $timers['scale'] += (microtime(true) - $time_scale_start);


    $time_rotate_start = microtime(true);
    $WhiteColor = new GmagickPixel('white');
    $Image1->rotateImage($WhiteColor, TestSettings::ROTATE_ANGLE);
    $timers['rotate'] += (microtime(true) - $time_rotate_start);

    $time_new_start = microtime(true);

    $Image2 = new Gmagick();
    $Image2->newImage(TestSettings::OUTPUT_IMAGE_WIDTH, TestSettings::OUTPUT_IMAGE_HEIGHT, 'white');
    $timers['new'] += (microtime(true) - $time_new_start);

    $time_paste_start = microtime(true);
    $Image2->compositeImage($Image1, 1, TestSettings::PASTE_X, TestSettings::PASTE_Y);
    $timers['paste'] += (microtime(true) - $time_paste_start);

    $time_save_start = microtime(true);
    $Image2->setImageFormat('JPEG');
    $Image2->setCompressionQuality(TestSettings::OUTPUT_JPEG_QUALITY);
    file_put_contents($output_file,$Image2);
    $timers['save'] += (microtime(true) - $time_save_start);
}

print_r(['gmagick' => $timers]);
