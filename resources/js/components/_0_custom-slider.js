const ele = document.getElementById('slider-box');

if(ele !== null){
    let pos = { top: 0, left: 0, x: 0, y: 0 };
    let scrollDirection

    // Desktop;
    const mouseDownHandler = function (e) {
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
        const dx = e.clientX - pos.x;
        const newScrollPost = pos.left - dx + 12;

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

        /*
        setTimeout(function(){
            const dx = e.clientX - pos.x;
            if(scrollDirection === 'right'){
                ele.scrollLeft = pos.left - dx + 40;
            }   else{
                ele.scrollLeft = pos.left - dx - 40;
            }
        }, 1)
         */
    };

    ele.addEventListener('mousedown', mouseDownHandler);


    // Mobile;
    const mouseDownHandlerMobile = function (e) {
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
        const dx = e.changedTouches[0].clientX - pos.x;
        const newScrollPost = pos.left - dx + 12;

        if(ele.scrollLeft > newScrollPost){
            scrollDirection = 'left'
        }   else{
            scrollDirection = 'right'
        }

        ele.scrollLeft = newScrollPost
    };

    const mouseUpHandlerMobile = function (e) {
        document.removeEventListener('touchmove', mouseMoveHandlerMobile);
        document.removeEventListener('touchend', mouseUpHandlerMobile);

        ele.style.cursor = 'grab';
        ele.style.removeProperty('user-select');
/*
        setTimeout(function(){
            const dx = e.changedTouches[0].clientX - pos.x;
            if(scrollDirection === 'right'){
                ele.scrollLeft = pos.left - dx + 40;
            }   else{
                ele.scrollLeft = pos.left - dx - 40;
            }
        }, 1)
 */
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
