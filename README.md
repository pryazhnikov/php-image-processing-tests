# Performance test of image processing libraries

## How to use?

    git clone git@github.com:pryazhnikov/php-image-processing-tests.git php-image-processing-tests
    cd php-image-processing-tests
    ./run.sh

## Results:
### Image magick #1 (scaleImage):
    Array
    (
        [imagemagick] => Array
            (
                [new] => 0.907035589218
                [open] => 2.88931393623
                [get_info] => 0.000778198242188
                [scale] => 3.38761520386
                [rotate] => 1.35131168365
                [paste] => 0.822308540344
                [save] => 7.93782782555
            )
    
    )
    
### Image magick #2 (resizeImage):
    Array
    (
        [imagemagick] => Array
            (
                [new] => 0.933653831482
                [open] => 3.12051582336
                [get_info] => 0.000890970230103
                [resize] => 3.21064448357
                [rotate] => 1.31969761848
                [paste] => 0.902936458588
                [save] => 9.12675404549
            )
    
    )
    
### Leptonica:
    Array
    (
        [leptonica] => Array
            (
                [new] => 2.72314929962
                [open] => 3.15142464638
                [get_info] => 0.000614404678345
                [scale] => 0.990393161774
                [rotate] => 2.34805989265
                [paste] => 0.0779142379761
                [save] => 4.89394545555
            )
    
    )
### GD:
    Array
    (
        [gd] => Array
            (
                [new] => 3.17223024368
                [open] => 2.58377289772
                [get_info] => 0.000282049179077
                [scale] => 4.10224723816
                [rotate] => 1.71648216248
                [paste] => 4.09311056137
                [save] => 4.93549370766
            )
    
    )
