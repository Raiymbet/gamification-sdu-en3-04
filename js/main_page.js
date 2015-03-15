var current = "top";
$(function () {
    $(window).scroll(function(){
       //console.log($(this).scrollTop());
    });
    current="about";
    $('a[href*=#]:not([href=#])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
            var target = $(this.hash);
            $("#" + current+ "1").removeClass();
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            var menu = this.hash.slice(1);
            $("#" + menu + 1).addClass("active");
            current = menu;
            if (target.length==0) {
                $("html,body").animate({
                    scrollTop: target.pageY - 70
                }, 1000);
                return false;
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

    $(window).scroll( function(){
      //  console.log($(this).scrollTop());
        if($(this).scrollTop()>=85){
            $("nav").addClass("my-nav-fixed")
        }else{
            $("nav").removeClass("my-nav-fixed")
        }
    });

});