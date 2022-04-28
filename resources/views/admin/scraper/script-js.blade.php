@auth

<script>
  $(function(){
    function showErrorMsg(errors) {
      $('.alert-main').addClass('alert-danger').removeClass('alert-success');
      $('.alert-main .msg-container').html("");

      for (const [key, error] of Object.entries(errors)) {
        for (let i=0; i<error.length; i++) {
          $('.alert-main .msg-container').append($('<p />').html(error[i]));
        }
      }
      $('.alert-main').addClass('alert--is-visible');
    }

    function showSuccessMsg(message) {
      $('.alert-main').addClass('alert-success').removeClass('alert-danger');
      $('.alert-main .msg-container').html("");

      $('.alert-main .msg-container').append($('<p />').html(message));

      $('.alert-main').addClass('alert--is-visible');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Main Controllber handlers - Start
    // load content when user clicked on sidebar links
    $(document).on('change', '#scraperFilter', function (e) {
      e.preventDefault();
      var $this = $(this);
      var url = "{{ url('/scraper') }}";
      if ($this.val()) {
        url = url + '/scraper-v1/' + $this.val();
      }
      document.location.href = url;
    });
    // Main Controllber handlers - End
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Scraper Global Settings Page - Start
    $(document).on('click', '#btnSave', function(e){
      e.preventDefault();

      $(this).html('Please wait...');
      var formData = new FormData($('#formSetting')[0]);

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
      });

      $.ajax({
        url: "{{ route('scraper.store') }}",
        dataType: 'json',
        type: 'post',
        contentType: false,
        processData: false,
        data: formData,
        success: function(response){
          console.log(response);

          if (response.status == false) {
            showErrorMsg(response.errors);
          } else {
            showSuccessMsg(response.message);
          }

          $('#btnSave').html('Save');
        }
      });
    });
    // Scraper Global Settings Page - End
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Scraper Management Page - Start
    $(document).on('click', '#formScraper .btn-do-scrape', function(e) {
      e.preventDefault();
      // Update action param, so as soon as create/update scraper, start scraping.
      $('#formScraper').find('input[name="action"').val('scrape');
      $('#formScraper').submit();
    });
    // Scraper Management Page - End
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Scraper List Page - Start
    $(document).on('click', '.btn-scraper-run-pause, .btn-scraper-stop, .btn-scraper-delete', function(e) {
      e.preventDefault();

      var scraper_item = $(this).closest('.scraper-item');
      var scraper_id = $(scraper_item).attr('data-id');

      var action = '';
      var ajax_url = '';
      if ($(this).hasClass('btn-scraper-run-pause')) {
        action = 'run_pause';
        ajax_url = "{{ url('scraper/run_pause') }}/" + scraper_id;
      } else if ($(this).hasClass('btn-scraper-stop')) {
        action = 'stop';
        ajax_url = "{{ url('scraper/stop') }}/" + scraper_id;
      } else if ($(this).hasClass('btn-scraper-delete')) {
        action = 'delete';
        ajax_url = "{{ url('scraper/delete') }}/" + scraper_id;
      } else {
        return;
      }

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
      });

      $.ajax({
        url: ajax_url,
        dataType: 'json',
        type: 'get',
        contentType: false,
        processData: false,
        success: function(response){
          if (response.status == false) {
            showErrorMsg(response.errors);
          } else {
            location.reload();
            // showSuccessMsg(response.message);
          }
        }
      });
    });

    $(document).on('click', '.btn-scraper-try-again', function(e) {
      e.preventDefault();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
      });

      $.ajax({
        url: "{{ url('scraper/retry') }}",
        dataType: 'json',
        type: 'get',
        contentType: false,
        processData: false,
        success: function(response){
          if (response.status == false) {
            showErrorMsg(response.errors);
          } else {
            location.reload();
            // showSuccessMsg(response.message);
          }
        }
      });
    });
    // Scraper Management Page - End
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  });
</script>
@endauth
