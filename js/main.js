/**
 * Created by dom on 2/28/15.
 */

var images = [];
var currentImg = 0;
var rsvpBookingEnabled = false;

$( document ).ready(function() {
    $.getJSON("data/photos.php", function(data) {
        $.each( data, function( key, val ) {
            images.push(val);
        });
        if (images.length) {
            setPhoto();
        }
    });

    $("#rsvp-submit").click(function() {
        handleRsvpSubmit();
    });

    $("#rsvp-attendance").change(function() {
        if ($("#rsvp-attendance").val() == 1) {
            $("#rsvp-booking").show();
            $("#rsvp-song").show();
            rsvpBookingEnabled = true;
        } else {
            $("#rsvp-booking").hide();
            $("#rsvp-song").hide();
            rsvpBookingEnabled = false;
        }
    });

});

function handleRsvpSubmit() {
    $("#rsvp-error").hide();

    var name = $("#rsvp-name").val();
    var attendance = $("#rsvp-attendance").val();
    var booking = $("#rsvp-booking").val();
    var song = $("#rsvp-song").val();
    var error = "";

    // check for errors
    if (name == "") {
        error = "you must enter your name";
    } else if (attendance == 0) {
        error = "you must choose if you plan to attend";
    } else if (rsvpBookingEnabled && booking == 0) {
        error = "you must choose if you plan to book through Apple Vacations or through your own travel agent";
    }

    if (error != "") {
        $("#rsvp-error-text").html(error);
        $("#rsvp-error").show();
    } else {
        $("#rsvp-form").hide();
        $.get("data/rsvp.php?name=" + name + "&attendance=" + attendance + "&booking=" + booking + "&song=" + song, function(data) {
            $("#rsvp-success").show();
        });
    }
}

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
