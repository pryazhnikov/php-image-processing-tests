<?php

require_once "TestSettings.php";
dl("gd.so");

$input_file = __DIR__ . '/' . TestSettings::INPUT_FILE;
$output_file = __DIR__ . "/output/gd.jpg";

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
    $image1 = imagecreatefromjpeg($input_file);
    $timers['open'] += (microtime(true) - $time_open_start);

    $time_get_info_start = microtime(true);
    $width = imagesx($image1);
    $height = imagesy($image1);
    $timers['get_info'] += (microtime(true) - $time_get_info_start);

    $new_width  = ceil($width / TestSettings::DOWNSCALE_FACTOR);
    $new_height = ceil($height / TestSettings::DOWNSCALE_FACTOR);

    $time_scale_start = microtime(true);
    $image2 = imagescale($image1, $new_width, $new_height);
    $timers['scale'] += (microtime(true) - $time_scale_start);

    $gd_rotate_angle = 360 - TestSettings::ROTATE_ANGLE;

    $time_rotate_start = microtime(true);
    $white = imagecolorallocate($image2, 0xff, 0xff, 0xff);
    $image3 = imagerotate($image2, $gd_rotate_angle, $white);
    $timers['rotate'] += (microtime(true) - $time_rotate_start);

    $time_new_start = microtime(true);
    $image4 = imagecreatetruecolor(TestSettings::OUTPUT_IMAGE_WIDTH, TestSettings::OUTPUT_IMAGE_HEIGHT);
    $white = imagecolorallocate($image4, 0xff, 0xff, 0xff);
    imagefill($image4, 0, 0, $white);
    $timers['new'] += (microtime(true) - $time_new_start);

    $rotated_image_width = imagesx($image3);
    $rotated_image_height = imagesy($image3);

    $time_paste_start = microtime(true);
    imagecopymerge($image4, $image3, TestSettings::PASTE_X, TestSettings::PASTE_Y, 0, 0, $rotated_image_width, $rotated_image_height, 100);
    $timers['paste'] += (microtime(true) - $time_paste_start);

    $time_save_start = microtime(true);
    imagejpeg($image4, $output_file, TestSettings::OUTPUT_JPEG_QUALITY);
    $timers['save'] += (microtime(true) - $time_save_start);
}

print_r(['gd' => $timers]);
