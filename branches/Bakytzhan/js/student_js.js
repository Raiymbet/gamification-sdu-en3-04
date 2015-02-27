$("a[role=link]").click(function () {
    var name = $(this).attr("name");
    console.clear();
    $("a[role=link]").each(function () {
        $(this).removeClass().removeClass().addClass("list-group-item");
        console.log("CON");
    });
    $(this).addClass("active");
    if (name == 'Home') {
        $("#main-frame").fadeIn("fast");
        $("#nagrada-frame").fadeOut("fast");
        $("#raiting-frame").fadeOut("fast");
        activate = 0;
    } else if (name == 'Profile') {
        $("#main-frame").fadeOut("fast");
        $("#nagrada-frame").fadeIn("fast");
        $("#raiting-frame").fadeOut("fast");
        activate = 1;
    } else if (name == 'Messages') {
        $("#nagrada-frame").fadeOut("fast");
        $("#main-frame").fadeOut("fast");
        $("#raiting-frame").fadeIn("fast");
        activate = 2;
    }
});
activate = 0;
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
setInterval("basic()", 250);
function basic() {
    var element = document.getElementById("container");
    var d1 = [], i, graph;

    for (i = 0; i < 10; i += 1) {
        d1.push([i, Math.random(i) * 100]);
    }
    graph = Flotr.draw(element, [d1], {
        title: "Статистика",
        xaxis: {
            minorTickFreq: 4
        },
        grid: {
            minorVerticalLines: false
        }
    });
}