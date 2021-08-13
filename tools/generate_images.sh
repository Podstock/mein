#!/bin/bash

mkdir -p /tmp/zelte
for i in {1..100}; do convert image.png -font arial -gravity Center -fill orange -pointsize 16 -define png:color-type=2 -annotate 0 "$i" /tmp/zelte/output$(printf %04d $i).png; done

php ../artisan build:tents

montage /tmp/zelte/output*.png -tile 10x10 -geometry +0+0 ../public/storage/zelte.png
