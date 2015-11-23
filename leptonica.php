<?php

require_once "TestSettings.php";
dl("leptonica.so");

$input_file = TestSettings::getAssetsDir() . TestSettings::INPUT_FILE;
$output_file = TestSettings::getOutputDir() . "leptonica.jpg";

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
    $image1 = leptonica_open($input_file);
    $timers['open'] += (microtime(true) - $time_open_start);

    $time_get_info_start = microtime(true);
    $info = leptonica_image_info($image1);
    $timers['get_info'] += (microtime(true) - $time_get_info_start);

    $scale_multiplier_x = 1 / TestSettings::DOWNSCALE_FACTOR;
    $scale_multiplier_y = $scale_multiplier_x;

    $time_scale_start = microtime(true);
    $image2 = leptonica_scale($image1, $scale_multiplier_x, $scale_multiplier_y, LEPT_SCALE_SMOOTH);
    $timers['scale'] += (microtime(true) - $time_scale_start);

    $time_rotate_start = microtime(true);
    $image3 = leptonica_rotate($image2, TestSettings::ROTATE_ANGLE);
    $timers['rotate'] += (microtime(true) - $time_rotate_start);

    $time_new_start = microtime(true);
    $color = leptonica_color(0xff, 0xff, 0xff);
    $image4 = leptonica_new(TestSettings::OUTPUT_IMAGE_WIDTH, TestSettings::OUTPUT_IMAGE_HEIGHT, $color);
    $timers['new'] += (microtime(true) - $time_new_start);

    $time_paste_start = microtime(true);
    leptonica_paste($image4, $image3, TestSettings::PASTE_X, TestSettings::PASTE_Y);
    $timers['paste'] += (microtime(true) - $time_paste_start);

    $time_save_start = microtime(true);
    leptonica_save($image4, $output_file, LEPT_JPEG, TestSettings::OUTPUT_JPEG_QUALITY);
    $timers['save'] += (microtime(true) - $time_save_start);
}

print_r(['leptonica' => $timers]);
