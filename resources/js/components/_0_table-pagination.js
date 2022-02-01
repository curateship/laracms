(function() {
    $(document).on('click', '.int-table__cell--sort', function(e){
        e.preventDefault()

        const sortBy = $(this).attr('data-sort-col')
        let sortDesc = false

        if($(this).hasClass('int-table__cell--desc')){
            sortDesc = 'desc'
        }

        if($(this).hasClass('int-table__cell--asc')){
            sortDesc = 'asc'
        }

        const url = window.location.href
        const urlArray = url.split('?')
        let resultUrl

        if(urlArray[1] === undefined){
            resultUrl = urlArray[0]
        }   else{
            const paramsArray = urlArray[1].split('&')
            let paramsResult = []


            paramsArray.forEach(function(item){
                if(item.indexOf('page') !== -1){
                    paramsResult.push(item)
                    return false
                }
            })

            if(sortDesc !== false){
                paramsResult.push('sortBy=' + sortBy)
                paramsResult.push('sortDesc=' + sortDesc)
            }

            resultUrl = urlArray[0] + '?' + paramsResult.join('&')
        }

        window.location.href = resultUrl
    })
}());
