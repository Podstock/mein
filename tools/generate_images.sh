#!/bin/bash

mkdir -p images
for i in {1..100}; do convert image.png -font arial -gravity Center -fill orange -pointsize 16 -define png:color-type=2 -annotate 0 "$i" images/output$(printf %04d $i).png; done

montage images/output*.png -tile 10x10 -geometry +0+0 zelte.png
