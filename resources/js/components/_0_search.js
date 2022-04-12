(function() {
    $(document).on('keydown', '#search-input', function(e){
        if (e.which === 13) {
            search($(this).val())
        }
    })

    $(document).on('keydown', '#megasite-search', function(e){
        e.preve
        if (e.which === 13) {
            search($(this).val())
        }
    })

    $(document).on('click', '.search-input__btn', function(e){
        search($('#search-input').val())
    })

    function search(searchValue){
        clearTimeout(window.searchTimer)

        window.searchTimer = setTimeout(function(){
            window.location.href = '/search/' + searchValue
        }, 500)
    }
}());
