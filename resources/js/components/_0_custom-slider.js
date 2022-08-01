const ele = document.getElementById('slider-box');

if(ele !== null){
    let pos = { top: 0, left: 0, x: 0, y: 0 };
    let lastEvent

    // Desktop;
    const mouseDownHandler = function (e) {
        lastEvent = 'down'

        ele.style.cursor = 'grabbing';
        ele.style.userSelect = 'none';

        pos = {
            left: ele.scrollLeft,
            x: e.clientX,
        };

        document.addEventListener('mousemove', mouseMoveHandler); //touchmove
        document.addEventListener('mouseup', mouseUpHandler); //touchend

        document.addEventListener('touchmove', mouseMoveHandlerMobile);
        document.addEventListener('touchend', mouseUpHandlerMobile);
    };

    const mouseMoveHandler = function (e) {
        lastEvent = 'moving'

        const dx = e.clientX - pos.x;
        ele.scrollLeft = pos.left - dx;
    };

    const mouseUpHandler = function (e) {
        if(lastEvent === 'down'){
            const item = e.srcElement.parentNode
            if(item.className === 'slider-item'){
                location.href = item.dataset.href
            }
        }

        lastEvent = 'up'

        document.removeEventListener('mousemove', mouseMoveHandler);
        document.removeEventListener('mouseup', mouseUpHandler);

        ele.style.cursor = 'grab';
        ele.style.removeProperty('user-select');
    };

    ele.addEventListener('mousedown', mouseDownHandler);


    // Mobile;
    const mouseDownHandlerMobile = function (e) {
        lastEvent = 'down'

        ele.style.cursor = 'grabbing';
        ele.style.userSelect = 'none';

        pos = {
            left: ele.scrollLeft,
            x: e.changedTouches[0].clientX,
        };

        document.addEventListener('touchmove', mouseMoveHandlerMobile);
        document.addEventListener('touchend', mouseUpHandlerMobile);
    };

    const mouseMoveHandlerMobile = function (e) {
        lastEvent = 'moving'

        const dx = e.changedTouches[0].clientX - pos.x;
        ele.scrollLeft = pos.left - dx;
    };

    const mouseUpHandlerMobile = function (e) {
        if(lastEvent === 'down'){
            const item = e.srcElement.parentNode
            if(item.className === 'slider-item'){
                location.href = item.dataset.href
            }
        }

        lastEvent = 'up'

        document.removeEventListener('touchmove', mouseMoveHandlerMobile);
        document.removeEventListener('touchend', mouseUpHandlerMobile);

        ele.style.cursor = 'grab';
        ele.style.removeProperty('user-select');
    };

    ele.addEventListener('touchstart', mouseDownHandlerMobile);

    function scrollWithArrow(direction){
        if(direction === 'right'){
            ele.scrollLeft += 150;
        }   else{
            ele.scrollLeft -= 150;
        }
    }
}