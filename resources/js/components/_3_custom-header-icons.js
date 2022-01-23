(function() {
    $(document).on('click', '.anim-menu-btn--search', function(){
        const target = $(this).attr('menu-target')

        if(target === 'search-menu' && $('#' + target).hasClass('header-v2__nav--is-visible')){
            setTimeout(function(){
                $('input#megasite-search').focus()
            }, 10)
        }
    })
}());
