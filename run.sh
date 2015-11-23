#!/bin/bash

echo "### Image magick #1 (scaleImage):"
php ./imagick.php

echo "### Image magick #2 (resizeImage):"
php ./imagick_resize.php

echo "### Leptonica:"
php ./leptonica.php

echo "### GD:"
php ./gd.php