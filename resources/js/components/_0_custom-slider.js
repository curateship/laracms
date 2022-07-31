const ele = document.getElementById('slider-box');
let pos = { top: 0, left: 0, x: 0, y: 0 };
let scrollDirection

const mouseDownHandler = function (e) {
    ele.style.cursor = 'grabbing';
    ele.style.userSelect = 'none';

    pos = {
        left: ele.scrollLeft,
        x: e.clientX,
    };

    document.addEventListener('mousemove', mouseMoveHandler);
    document.addEventListener('mouseup', mouseUpHandler);
};

const mouseMoveHandler = function (e) {
    const dx = e.clientX - pos.x;
    const newScrollPost = pos.left - dx;

    if(ele.scrollLeft > newScrollPost){
        scrollDirection = 'left'
    }   else{
        scrollDirection = 'right'
    }

    ele.scrollLeft = newScrollPost
};

const mouseUpHandler = function (e) {
    document.removeEventListener('mousemove', mouseMoveHandler);
    document.removeEventListener('mouseup', mouseUpHandler);

    ele.style.cursor = 'grab';
    ele.style.removeProperty('user-select');

    setTimeout(function(){
        const dx = e.clientX - pos.x;
        if(scrollDirection === 'right'){
            ele.scrollLeft = pos.left - dx + 40;
        }   else{
            ele.scrollLeft = pos.left - dx - 40;
        }
    }, 1)
};

ele.addEventListener('mousedown', mouseDownHandler);

function scrollWithArrow(direction){
    if(direction === 'right'){
        ele.scrollLeft += 150;
    }   else{
        ele.scrollLeft -= 150;
    }
}
