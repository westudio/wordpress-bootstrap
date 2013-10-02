FILES=(
    "../vendor/bootstrap/js/transition.js"
    "../vendor/bootstrap/js/alert.js"
    "../vendor/bootstrap/js/button.js"
    "../vendor/bootstrap/js/carousel.js"
    "../vendor/bootstrap/js/collapse.js"
    "../vendor/bootstrap/js/dropdown.js"
    "../vendor/bootstrap/js/modal.js"
    "../vendor/bootstrap/js/scrollspy.js"
    "../vendor/bootstrap/js/tab.js"
    "../vendor/bootstrap/js/tooltip.js"
    "../vendor/bootstrap/js/typeahead.js"
    "../vendor/bootstrap/js/popover.js"
    "../vendor/bootstrap/js/affix.js"
    "../vendor/blueimp/load-image/load-image.js"
    "../vendor/blueimp/modal-gallery/modal-gallery.js"
    # "../vendor/flesler/jquery.scrollTo.js"
    # "all-in-one-nav.js"
    "js.js"
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