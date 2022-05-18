function initBlend(){
    $('.img-blend').each(function(){
        const pattern = $(this).attr('data-blend-pattern').split(',')
        let color = $(this).attr('data-blend-color');
        const height = $(this).attr('data-blend-height');

        // Default color if this option does not exit in element;
        /*
        * Colors by CodyHouse
        * */
        //--color-bg-darker
        //--color-bg-dark
        //--color-bg
        //--color-bg-light
        //--color-bg-lighter

        // Default color;
        if(color === undefined){
            color = '--color-bg-light';
        }

        for(let i = 0 ; i < pattern.length ; i++){
            if(parseInt(pattern[i]) !== 1){
                continue
            }

            let added_style = {}

            // Can be set in %, px or something else;
            if(height !== undefined){
                added_style['height'] = height
            }

            switch(i){
                case 0:
                    added_style['background-image'] = 'linear-gradient(180deg, var(' + color + ') 20px, transparent)'

                    $(this).append('<div class="img-blend-top"></div>')
                    $(this).children('.img-blend-top').css(added_style)
                    break

                case 1:
                    added_style['background-image'] = 'linear-gradient(270deg, var(' + color + ') 20px, transparent)'

                    $(this).append('<div class="img-blend-right"></div>')
                    $(this).children('.img-blend-right').css(added_style)
                    break

                case 2:
                    added_style['background-image'] = 'linear-gradient(0deg, var(' + color + ') 20px, transparent)'

                    $(this).append('<div class="img-blend-bottom"></div>')
                    $(this).children('.img-blend-bottom').css(added_style)
                    break

                case 3:
                    added_style['background-image'] = 'linear-gradient(90deg, var(' + color + ') 20px, transparent)'

                    $(this).append('<div class="img-blend-left"></div>')
                    $(this).children('.img-blend-left').css(added_style)
                    break
            }
        }
    })
}

initBlend();
