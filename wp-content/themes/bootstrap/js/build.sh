FILES=(
    "vendor/bootstrap/transition.js"
    "vendor/bootstrap/alert.js"
    "vendor/bootstrap/button.js"
    "vendor/bootstrap/carousel.js"
    "vendor/bootstrap/collapse.js"
    "vendor/bootstrap/dropdown.js"
    "vendor/bootstrap/modal.js"
    "vendor/bootstrap/scrollspy.js"
    "vendor/bootstrap/tab.js"
    "vendor/bootstrap/tooltip.js"
    "vendor/bootstrap/typeahead.js"
    "vendor/bootstrap/popover.js"
    "vendor/bootstrap/affix.js"
    "vendor/blueimp/load-image.js"
    "vendor/blueimp/modal-gallery.js"
    "vendor/flesler/jquery.scrollTo.js"
    "all-in-one-nav.js"
    "main.js"
)
CMD="uglifyjs -nc"
CONCAT=true
DEST="main.min.js"

if $CONCAT; then
    > $DEST
fi

for file in ${FILES[@]}; do
    echo "$file..."
    if $CONCAT; then
        $CMD $file >> $DEST
    else
        basename=$(basename "$file")
        extension="${basename##*.}"
        filename="${basename%.*}"
        $CMD $file > "${filename}.min.${extension}"
        echo "> ${filename}.min.${extension}"
    fi
done

if $CONCAT; then
    echo "> ${DEST}"
else
    echo "Done"
fi