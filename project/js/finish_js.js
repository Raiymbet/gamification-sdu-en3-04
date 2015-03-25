/**
 * Created by bako on 3/24/15.
 */

/*TODO:
 * 1.Плавная анимация цифр в окне награды
 * 2.По этапная анимация каждого пункта(Количество очков,времени)
 *
 * */

time_limit1 = 240;
time_limit2 = 160;
t1 = {value: 0};
t2 = {value: 0};
function animate() {
    var Timer = setInterval(function () {
        timerLast(time_limit1, t1, $("#time_1"));
        timerLast(time_limit2, t2, $("#time_2"));
    }, 50);
}
function timerLast(time, t, id) {
    var minuts = 0, seconds = 0;
    var time_limit = t.value;
    if (t.value > time) {
        //window.open("over.html", "_self");
        minuts = Math.round(++time_limit / 60);
        seconds = time_limit % 60;
        id.text((minuts < 10 ? "0" + minuts : minuts) + ":" + (seconds < 10 ? "0" + seconds : seconds));
    } else if (time_limit % 2 == 0) {
        minuts = Math.round(++time_limit / 60);
        seconds = time_limit % 60;
        id.text((minuts < 10 ? "0" + minuts : minuts) + ":" + (seconds < 10 ? "0" + seconds : seconds));
    } else if (time_limit % 2 == 1) {
        minuts = Math.round(++time_limit / 60);
        seconds = time_limit % 60;
        id.text((minuts < 10 ? "0" + minuts : minuts) + " " + (seconds < 10 ? "0" + seconds : seconds));
    }
    t.value = time_limit;
    console.log(time_limit);
}