// File#: _3_explorer
// Usage: codyhouse.co/license
(function() {
    /// 👇you should remove this from your live code

    // demo only: array of static results -> replace with your real values
    var explorerQuickLinks = [
        {
            label: 'New List',
            class: 'js-explorer__command',
            icon: '<svg class="icon" viewBox="0 0 20 20"><g stroke-width="2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"><path d="M10,19H4a3,3,0,0,1-3-3V1H8l2,4h9v5" /><line x1="15" y1="11" x2="15" y2="19" /><line x1="11" y1="15" x2="19" y2="15" /></g></svg>',
            template: 'button'
        },
        {
            label: 'List 1',
            class: 'js-explorer__command',
            icon: '<svg class="icon" viewBox="0 0 20 20"><g stroke-width="2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"><path d="M11,19H4a3,3,0,0,1-3-3V1H8l2,4h9V9" /><line x1="9" y1="14" x2="19" y2="14" /><polyline points="15 10 19 14 15 18" /></g></svg>',
            shortcut: '<i class="explorer__shortcut">43</i>',
            template: 'button'
        },
        {
            label: 'List 2',
            class: 'js-explorer__command',
            icon: '<svg class="icon" viewBox="0 0 20 20"><g stroke-width="2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"><path d="M11,19H4a3,3,0,0,1-3-3V1H8l2,4h9V9" /><line x1="9" y1="14" x2="19" y2="14" /><polyline points="15 10 19 14 15 18" /></g></svg>',
            shortcut: '<i class="explorer__shortcut">25</i>',
            template: 'button'
        }
    ];

    var explorerAdditionalLinks = [
        {
            label: 'List 3',
            class: 'js-explorer__command',
            icon: '<svg class="icon" viewBox="0 0 20 20"><g stroke-width="2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"><path d="M10,19H4a3,3,0,0,1-3-3V1H8l2,4h9v5" /><line x1="11" y1="15" x2="19" y2="15" /></g></svg>',
            shortcut: '<i class="explorer__shortcut">11</i>',
            template: 'button'
        }
    ];

    if(document.getElementById('explorer-link-variation')) { // --link variation
        // use different results for the --link variation
        explorerQuickLinks = [
            {
                label: 'Link 1',
                class: 'js-explorer__link',
                url: '#0',
                category: 'Category',
                template: 'link'
            },
            {
                label: 'Project 1',
                class: 'js-explorer__link',
                url: '#0',
                category: 'Category',
                template: 'link'
            },
            {
                label: 'Link 2',
                class: 'js-explorer__link',
                url: '#0',
                category: 'Category',
                template: 'link'
            }
        ];

        explorerAdditionalLinks = [
            {
                label: 'Project 2',
                class: 'js-explorer__link',
                url: '#0',
                category: 'Category',
                template: 'link'
            }
        ];
    }

    /// 👆end of demo code


    function explorerSearch(query, cb) {
        // get search results
        // more info: https://codyhouse.co/ds/components/info/autocomplete#search-data

        // quick links - visible when the input is empty
        if(query == '') {
            cb(explorerQuickLinks); // pass your real list of quick links
            return;
        }

        // 👇 get results - you should modify this with your real data
        var quickLinks = explorerQuickLinks.filter(function(item){
            // return item if item['label'] contains 'query'
            return item['label'].toLowerCase().indexOf(query.toLowerCase()) > -1;
        });
        var data = explorerAdditionalLinks.filter(function(item){
            // return item if item['label'] contains 'query'
            return item['label'].toLowerCase().indexOf(query.toLowerCase()) > -1;
        });
        data = quickLinks.concat(data);
        // 👆 get results - you should modify this with your real data

        if(data.length == 0) { // fallback for no results found
            // no results found
            data = [{
                label: 'No results',
                template: 'no-results'
            }];
        }

        // make sure to call the callback function and pass the data array as its argument
        cb(data);
    };

    function explorerClick(option, obj, event) {
        // custom function to be execute when user selects an option
        // more info: https://codyhouse.co/ds/components/info/autocomplete#on-click
        event.preventDefault();
    };

    var explorer = document.getElementsByClassName('js-explorer');
    if(explorer.length > 0) {
        var modalExplorer = explorer[0].closest('.js-modal');
        var explorerInput =  explorer[0].getElementsByClassName('js-autocomplete__input');
        new Autocomplete({
            element: explorer[0],
            characters: 0,
            searchData: function(value, cb) { // function that gets result data
                explorerSearch(value, cb);
            },
            onClick: function(option, obj, event) { // function to be executed on click
                explorerClick(option, obj, event);
            }
        });

        if(modalExplorer) {
            modalExplorer.addEventListener('modalIsClose', function(event){
                // reset search input when closing the modal window
                if(explorerInput.length > 0) {
                    explorerInput[0].value = '';
                }
            });
        }
    }
}());
