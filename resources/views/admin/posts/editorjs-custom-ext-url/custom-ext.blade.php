<script>
    class ExtMediaUrl {
        static get toolbox() {
            return {
                title: 'External media URL',
                icon: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><title>code</title><g fill="currentColor"><path fill="currentColor" d="M12.7,11.7l-1.4-1.4L13.6,8l-2.3-2.3l1.4-1.4l3,3c0.4,0.4,0.4,1,0,1.4L12.7,11.7z"></path> <path fill="currentColor" d="M3.3,11.7l-3-3c-0.4-0.4-0.4-1,0-1.4l3-3l1.4,1.4L2.4,8l2.3,2.3L3.3,11.7z"></path> <path d="M6,15c-0.1,0-0.2,0-0.3-0.1c-0.5-0.2-0.8-0.7-0.6-1.3l4-12c0.2-0.5,0.7-0.8,1.3-0.6 c0.5,0.2,0.8,0.7,0.6,1.3l-4,12C6.8,14.7,6.4,15,6,15z"></path></g></svg>'
            };
        }

        constructor({data}){
            console.log('Constructor data...')
            console.log(data)

            this.data = data
            this.wrapper = undefined
        }

        render(){
            this.wrapper = document.createElement('div')
            this.wrapper.classList.add('custom-ext-box')

            const input = document.createElement('input')
            input.classList.add('custom-ext-input')
            input.placeholder = 'Enter external media URL (picture or video)'
            input.value = this.data && this.data.url ? this.data.url : ''
            this.wrapper.appendChild(input)

            const applyButton = document.createElement('button')
            applyButton.setAttribute('type', 'button')
            applyButton.classList.add('custom-ext-url-apply')
            applyButton.classList.add('btn')
            applyButton.classList.add('btn--subtle')
            applyButton.classList.add('radius-full')
            applyButton.innerHTML = 'Add URL'
            this.wrapper.appendChild(applyButton)

            const urlResult = document.createElement('div')
            urlResult.classList.add('custom-ext-url-result')
            this.wrapper.appendChild(urlResult)

            if(this.data && this.data.url){
                setTimeout(function(){
                    $('.custom-ext-url-apply').click()
                }, 200)
            }

            return this.wrapper
        }

        save(blockContent){
            blockContent = $(blockContent).children('.custom-ext-url-result')

            const type = blockContent.attr('data-ext-media-type')
            let url

            switch(type){
                case 'video':
                    url = blockContent.children('video').children('source').attr('src')
                    break;

                case 'image':
                    url = blockContent.children('img').attr('src')
                    break;
            }

            return {type, url}
        }
    }

    (function() {
        $(document).on('click', '.custom-ext-url-apply', function(){
            const parentBox = $(this).parents('.custom-ext-box')
            const input = parentBox.children('.custom-ext-input')
            const result = parentBox.children('.custom-ext-url-result')

            const parsingResult = parseContentFromUrl(input.val())
            result.html(parsingResult.content).removeClass('custom-ext-url-result-hidden').addClass('custom-ext-url-result').fadeIn()
            result.attr('data-ext-media-type', parsingResult.type)

            input.hide()
            $(this).remove()
        })
    }());

    function parseContentFromUrl(url){
        const urlExtension = get_url_extension(url)
        let content
        let type

        if(urlExtension === 'mp4'){
            content = '<video controls="controls" preload="metadata"><source src="' + url + '" type="video/mp4"></video>'
            type = 'video'
        }   else{
            content = '<img src="' + url + '" alt="ext-url-image">'
            type = 'image'
        }

        return {content, type}
    }

    function get_url_extension( url ) {
        return url.split(/[#?]/)[0].split('.').pop().trim();
    }
</script>

<style>
    .custom-ext-box{
        display: flex;
        gap: 20px;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .custom-ext-url-result-hidden{
        display: none;
    }

    .custom-ext-url-result{
        display: flex;
        justify-content: center;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
    }
</style>
