(function() {
    $(document).on('click', '.pagination__item', function(e){
        e.preventDefault()

        let url = $(this).attr('href')
        const page = url.split('?')[1]
        let selectedCol

        if($('.int-table__cell--desc').length > 0){
            selectedCol = $('.int-table__cell--desc')
        }

        if($('.int-table__cell--asc').length > 0){
            selectedCol = $('.int-table__cell--asc')
        }

        if(selectedCol !== undefined){
            url = tableUrl(selectedCol, true).replace('*', page)
        }

        window.location.href = url
    })

    $(document).on('click', '.int-table__cell--sort', function(){
        window.location.href = tableUrl($(this), false)
    })

    function tableUrl(sortOwner, replacePage){
        const sortBy = sortOwner.attr('data-sort-col')
        let sortDesc = false

        if(sortOwner.hasClass('int-table__cell--desc')){
            sortDesc = 'desc'
        }

        if(sortOwner.hasClass('int-table__cell--asc')){
            sortDesc = 'asc'
        }

        const url = window.location.href
        const urlArray = url.split('?')
        let paramsResult = []

        if(urlArray[1] !== undefined){
            const paramsArray = urlArray[1].split('&')

            paramsArray.forEach(function(item){
                if(item.indexOf('page') !== -1 && !replacePage){
                    paramsResult.push(item)
                    return false
                }
            })

            if(replacePage){
                paramsResult.push('*')
            }
        }

        if(sortDesc !== false){
            paramsResult.push('sortBy=' + sortBy)
            paramsResult.push('sortDesc=' + sortDesc)
        }

        return urlArray[0] + (paramsResult.length > 0 ? '?' + paramsResult.join('&') : '')
    }
}());
