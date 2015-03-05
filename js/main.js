/**
 * Created by dom on 2/28/15.
 */

var images = [];
var currentImg = 0;

$( document ).ready(function() {
    $.getJSON("data/photos.php", function(data) {
        $.each( data, function( key, val ) {
            images.push(val);
        });
        if (images.length) {
            setPhoto();
        }
    });
});

function nextPhoto() {
    if (currentImg + 1 < images.length) {
        currentImg ++;
    } else {
        currentImg = 0;
    }
    setPhoto();
}

function lastPhoto() {
    if (currentImg != 0) {
        currentImg --;
    } else {
        currentImg = images.length - 1;
    }
    setPhoto();
}

function setPhoto() {
    $("#instagram-photo").attr("src", images[currentImg]);
}
