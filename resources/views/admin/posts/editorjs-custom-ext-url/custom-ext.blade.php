<script>
    class ExtMediaUrl {
        static get toolbox() {
            return {
                title: 'External media URL',
                icon: '<svg width="16px" height="16px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><path fill-rule="evenodd" clip-rule="evenodd" d="M2 2h6v3.5l.5.5H12v1h1V4.8l-.15-.36-3.28-3.3L9.22 1H1.5l-.5.5v13l.5.5H5v-1H2V2zm7 0l3 3H9V2zm5.5 6h-8l-.5.5v6l.5.5h8l.5-.5v-6l-.5-.5zM14 9v4l-1.63-1.6h-.71l-1.16 1.17-2.13-2.13h-.71L7 11.1V9h7zm-2.8 4.27l.81-.81L13.55 14h-1.62l-.73-.73zM7 14v-1.49l1-1L10.52 14H7zm5.5-3.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/></svg>'
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
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
</style>
