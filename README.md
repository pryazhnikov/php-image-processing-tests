# Performance test of image processing libraries

## How to use?

    git clone git@github.com:pryazhnikov/php-image-processing-tests.git .
    cd php-image-processing-tests
    ./run.sh

## Results
### Image magick:

    Array
    (
        [imagemagick] => Array
            (
                [new] => 0.991078138351
                [open] => 3.09436154366
                [get_info] => 0.000759840011597
                [scale] => 3.70287585258
                [rotate] => 1.39593052864
                [paste] => 0.886064291
                [save] => 7.91867828369
            )

    )

### Leptonica:
    Array
    (
        [leptonica] => Array
            (
                [new] => 1.79483890533
                [open] => 2.08567070961
                [get_info] => 0.000519990921021
                [scale] => 0.649325847626
                [rotate] => 1.76030039787
                [paste] => 0.0395681858063
                [save] => 3.53495025635
            )

    )
### GD:
    Array
    (
        [gd] => Array
            (
                [new] => 2.99832129478
                [open] => 2.34718394279
                [get_info] => 0.000257968902588
                [scale] => 3.7385494709
                [rotate] => 1.54862356186
                [paste] => 3.8748550415
                [save] => 4.44924497604
            )

    )
