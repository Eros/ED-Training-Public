var ul;
var li_items;
var li_number;
var image_number = 0;
var slider_width = 0;
var image_width;
var current = 0;

function init() {
    ul = document.getElementById('image_slides');
    li_items = ul.children;
    li_number = li_items.length;
    for(i = 0; i < li_number; i++){
        image_width = li_items[i].childNodes[0].clientWidth;
        slider_width += image_width;
        image_number++;
    }

    ul.style.width = parseInt(slider_width) + 'px';
    slider();
}

function slider(){
    animate({
        delay: 17,
        duration: 3000,
        delta: function (p) {
            return Math.max(0, -1 + 2 * p)},
        step: function (delta) {
            ul.style.left = '-' + parseInt(current * image_width + delta * image_width);
        },
        callback: function () {
            current++;
            if(current < li_number - 1){
                slider();
            } else {
                let left = (li_number - 1) * image_width;
                setTimeout(function () {
                    back(left)
                }, 2000);
            }
        }
    });
}

function back(left_limits){
    current = 0;
    setInterval(function () {
        if(left_limits >= 0){
            ul.style.left = '-' + parseInt(left_limits) + 'px';
            left_limits -= image_width / 10;
        }
    }, 17);
}

function animate(opts){
    let start = new Date;
    let id = setInterval(function () {
        let timePassed = new Date - start;
        let progress = timePassed / opts.duration;
        if (progress > 1) {
            progress = 1;
        }
        let delta = opts.delta(progress);
        opts.step(delta);
        if (progress === 1) {
            clearInterval(id);
            opts.callback();
        }
    }, opts.delay || 17);
}

window.onload = init();

//loads the main script for the flowable labels
$('.FlowupLabels').FlowupLabels({
    feature_OnLoad: true,
     classFocused: 'focused',
    classPopulated: 'populated'
});
