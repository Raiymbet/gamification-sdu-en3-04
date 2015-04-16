var current = "top";
$(function () {
    $(window).scroll(function () {
        //console.log($(this).scrollTop());
    });
    current = "about";
    $('a[href*=#]:not([href=#])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
            var name = this.hash.slice(1);
            var target = this.hash.slice(1) > 2 ? null : $('#' + name);
            if (target) {
                $("#" + current + "1").removeClass();
                $("#" + name + "1").addClass("active");
                current = name;
                $("html, body").animate({scrollTop: target.offset().top - 60}, 1000);
            }
        }
    });
    function initialize() {
        var mapProp = {
            center: new google.maps.LatLng(43.2083297, 76.6689786),
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    $(window).scroll(function () {
        //  console.log($(this).scrollTop());
        if ($(this).scrollTop() >= 85) {
            $("nav").addClass("my-nav-fixed")
        } else {
            $("nav").removeClass("my-nav-fixed")
        }
    });
});
