$("a[role=link]").click(function () {
    var name = $(this).attr("name");
    $("a[role=link]").each(function () {
        $(this).removeClass().removeClass().addClass("list-group-item");
        console.log("CON");
    });
    $(this).addClass("active");
    if (name == 'Home') {
        $("#main-frame").fadeIn("fast");
        $("#nagrada-frame").fadeOut("fast");
        $("#raiting-frame").fadeOut("fast");

        $("#group-frame").fadeOut("fast");
        activate = 0;
    } else if (name == 'Profile') {
        $("#main-frame").fadeOut("fast");
        $("#nagrada-frame").fadeIn("fast");
        $("#raiting-frame").fadeOut("fast");

        $("#group-frame").fadeOut("fast");
        activate = 1;
    } else if (name == 'Messages') {
        $("#nagrada-frame").fadeOut("fast");
        $("#main-frame").fadeOut("fast");
        $("#raiting-frame").fadeIn("fast");

        $("#group-frame").fadeOut("fast");
        activate = 2;
    }else if (name == 'group'){
        $("#group-frame").fadeIn("fast");
        $("#nagrada-frame").fadeOut("fast");
        $("#main-frame").fadeOut("fast");
        $("#raiting-frame").fadeOut("fast");
    }
});
activate = 0;
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
$(".nagrada").children('img').each(function(){
    $(this).mouseenter(function(){
        var pos=$(this).position();
        var posDiv=$(".nagrada").position();
        var selecting=parseInt($(this).attr(("name")));
        console.log(selecting);
        console.log(nagrada_items_db[selecting].img);
        console.log(nagrada_items_db[selecting].description);
        $("#note_img").attr("src",nagrada_items_db[selecting].img);
        $("#note_description").text(nagrada_items_db[selecting].description);
        $("#note_awards").fadeIn("show").fadeIn("fast").
        css({"left":pos.left+"px","top":(posDiv.top-50)+"px","display":"block"});
    });
});
$(".nagrada").children('img').each(function(){
    $(this).mouseleave(function(){
        $("#note_awards").fadeOut("fast");
    });
});
nagrada_items_db=[{},{},{},{},{},{},{},{}];
function init_array(){
    nagrada_items_db[0].description='Он правильно ответил три раза подряд';
    nagrada_items_db[0].img="img/icon_award (3).png";
    nagrada_items_db[1].description='Первый раз все ответил правильно';
    nagrada_items_db[1].img="img/symbol_correct.png";
    nagrada_items_db[2].description='Первая победа!';
    nagrada_items_db[2].img="img/body_arm.png";
    nagrada_items_db[3].description='Прошел за минимальное время';
    nagrada_items_db[3].img="img/stopwatch.png";
    nagrada_items_db[3].description='Выиграль соперника выше по ранге';
    nagrada_items_db[3].img="img/award.png"; 
    nagrada_items_db[4].img="img/cup.png";
    nagrada_items_db[4].description='Десять игр подряд успешно!';
}
init_array();
$(document).ready(function () {
    console.log("HELLO, NEW FLOTR");
    var s1 = [[2002, 112000], [2003, 122000], [2004, 104000], [2005, 99000], [2006, 121000], 
    [2007, 148000], [2008, 114000], [2009, 133000], [2010, 161000], [2011, 173000]];
    var s2 = [[2002, 10200], [2003, 10800], [2004, 11200], [2005, 11800], [2006, 12400], 
    [2007, 12800], [2008, 13200], [2009, 12600], [2010, 13100]];

    plot1 = $.jqplot("staticChart", [s2, s1], {
        // Turns on animatino for all series in this plot.
        animate: true,
        // Will animate plot on calls to plot1.replot({resetAxes:true})
        animateReplot: true,
        cursor: {
            show: true,
            zoom: true,
            looseZoom: true,
            showTooltip: false
        },
        series:[
        {
            pointLabels: {
                show: true
            },
            renderer: $.jqplot.BarRenderer,
            showHighlight: false,
            yaxis: 'y2axis',
            rendererOptions: {
                    // Speed up the animation a little bit.
                    // This is a number of milliseconds.  
                    // Default for bar series is 3000.  
                    animation: {
                        speed: 2500
                    },
                    barWidth: 15,
                    barPadding: -15,
                    barMargin: 0,
                    highlightMouseOver: false
                }
            }, 
            {
                rendererOptions: {
                    // speed up the animation a little bit.
                    // This is a number of milliseconds.
                    // Default for a line series is 2500.
                    animation: {
                        speed: 2000
                    }
                }
            }
            ],
            axesDefaults: {
                pad: 0
            },
            axes: {
            // These options will set up the x axis like a category axis.
            xaxis: {
                tickInterval: 1,
                drawMajorGridlines: false,
                drawMinorGridlines: true,
                drawMajorTickMarks: false,
                rendererOptions: {
                    tickInset: 0.5,
                    minorTicks: 1
                }
            },
            yaxis: {
                tickOptions: {
                    formatString: "$%'d"
                },
                rendererOptions: {
                    forceTickAt0: true
                }
            },
            y2axis: {
                tickOptions: {
                    formatString: "$%'d"
                },
                rendererOptions: {
                    // align the ticks on the y2 axis with the y axis.
                    alignTicks: true,
                    forceTickAt0: true
                }
            }
        },
        highlighter: {
            show: true, 
            showLabel: true, 
            tooltipAxes: 'y',
            sizeAdjust: 7.5 , tooltipLocation : 'ne'
        }
    });

/*Teacher page JS*/
/*Checkbox selectection*/
var count_checked=0;
$("input[type='checkbox']").click(function(event){
    console.log('Hellow');
    $("#result_popup").html($(this).val()); 
});
$("#s").click(function(){
    alert("DDD");
});

$(".list-group-item").hover(function(){
    $(".messsage_window").append("Console.log");
});
});

