(function() {
    var switchers = document.getElementsByClassName('themeSwitch')

    if (switchers.length > 0) {
        for (var i = 0; i < switchers.length; i++) {
            switchers[i].addEventListener('change', function (event) {
                const callerId = this.getAttribute('id')
                const theme = this.getAttribute('data-theme')

                $('.themeSwitch[data-theme="' + theme + '"]').each(function () {
                    if ($(this).attr('id') !== callerId) {
                        $(this).prop('checked', true)
                    }
                })

                console.log('Theme changed on: ' + theme)
                document.body.setAttribute('data-theme', theme)

                // Save theme in DB after switch;
                $.ajax({
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        theme: theme
                    },
                    url: '/users/saveTheme',
                    type: 'POST'
                });
            });
        }
    }
}());

