var current = "top";
$(function () {
    $(window).scroll(function () {
        console.log($(this).scrollTop());
        var sc = $(this).scrollTop();
        $("#pages1").removeClass();
        $("#about1").removeClass();
        $("#comments1").removeClass();
        $("#helps1").removeClass();
        $("#contacts1").removeClass();
        if (sc > 630 && sc < 1250) {
            $("#pages1").addClass("active");
            current = "pages";
        } else if (sc > 1270 && sc < 1849) {
            $("#comments1").addClass("active");
            current = "comments";
        } else if (sc > 1850 && sc < 2299) {
            $("#helps1").addClass("active");
            current = "helps";
        } else if (sc > 2300) {
            $("#contacts1").addClass("active");
            current = "contacts";
        } else {
            $("#about1").addClass("active");
            current = "about";
        }
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
    $("button[name='reset']").click(function () {
        $("input").each(function () {
            $(this).val("");
        });
        $("textarea").val("");
    });
    $("button[name='submit']").click(function () {

        var v1 = $("#fname").val();
        var v2=$("#subject").val();
        var v3 = $("#email").val();
        var v4 = $("#phone").val();
        var v5 = $("#message").val();
        console.log({q:'1',name: v1, surname: v2, e_mail: v3, phone: v4, message: v5});
        $.ajax({
            url: "mail.php",
            type: "POST",
            cache: false,
            data: {q:'1',name: v1, surname: v2, email: v3, phone: v4, message: v5},
            success: function (msg) {
                alert(msg);
            }
        });
    });
});
