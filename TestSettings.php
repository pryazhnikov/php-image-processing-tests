<?php
/**
 * @team Features <ft@corp.badoo.com>
 * @maintainer Victor Pryazhnikov <v.pryazhnikov@corp.badoo.com>
 */

class TestSettings
{
    const NUM_RUNS = 100;

    const OUTPUT_IMAGE_WIDTH = 1000;
    const OUTPUT_IMAGE_HEIGHT = 1000;
    const OUTPUT_JPEG_QUALITY = 98;

    const INPUT_FILE = "landscape.jpg";
    const DOWNSCALE_FACTOR = 1.5;
    const ROTATE_ANGLE = 90;
    const PASTE_X = 100;
    const PASTE_Y = 100;

    public static function getAssetsDir()
    {
        return __DIR__ . "/assets/";
    }

    public static function getOutputDir()
    {
        return __DIR__ . "/output/";
    }
}
