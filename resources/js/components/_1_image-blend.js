(function() {
    $('.img-blend').each(function(){
        const pattern = $(this).attr('data-blend-pattern').split(',')

        console.log(pattern)

        for(var i = 0 ; i < pattern.length ; i++){
            if(parseInt(pattern[i]) !== 1){
                continue
            }

            switch(i){
                case 0:
                    $(this).append('<div class="img-blend-top"></div>')
                    break

                case 1:
                    $(this).append('<div class="img-blend-right"></div>')
                    break

                case 2:
                    $(this).append('<div class="img-blend-bottom"></div>')
                    break

                case 3:
                    $(this).append('<div class="img-blend-left"></div>')
                    break
            }
        }
    })
}());
