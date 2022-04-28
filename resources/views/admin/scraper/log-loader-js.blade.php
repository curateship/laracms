@auth
<script>
  $(function(){
    var log_time = '';
    var scroll_to_bottom = true;
    $(document).on('click', '.btn-logs-clear', function(e) {
      e.preventDefault();
      $('.logs-section').html('');
    });

    $(document).on('click', '.log-item .log-action .delete-log', function(e) {
      e.preventDefault();
      var log_item = $(this).closest('.log-item');
      var log_id = $(log_item).attr('data-id');

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
      });

      $.ajax({
        url: "{{ url('scraper/delete_log_item') }}",
        dataType: 'json',
        method: 'post',
        data: {
          id: log_id
        },
        success: function(response){
          if (response.status == false) {
          } else {
            $(log_item).remove();
          }
        }
      });
    });

    function getLogTemplate(data) {
      var log_id = data['id'];
      var scraper_id = data['scraper_id'];
      var domain = data['domain'];
      var show_url = data['output_url'];
      var url = data['scraper_url'];
      var messages = data['messages'];

      var template = $('#log_template').html();
      template = template.replace('{log_id}', log_id);
      template = template.replace('{page_url}', url);
      template = template.replace('{scraper_id}', scraper_id);

      var message_templates = '';
      if (show_url) {
        var status_class = 'msg-error';
        var message_template = $('#log_message_template').html();
        message_template = message_template.replace('{status_class}', status_class);
        message_template = message_template.replace('{message}', url);
        message_templates += message_template;
      }
      messages.forEach(function(msg) {
        var status_class = !msg.status ? 'msg-error' : 'msg-info';
        var message_template = $('#log_message_template').html();
        message_template = message_template.replace('{status_class}', status_class);
        message_template = message_template.replace('{message}', msg.message);
        message_templates += message_template;
      });

      template = template.replace('{messages}', message_templates);
      return template;
    }

    function displayLog(logs_data) {
      logs_data.forEach(function(log_data) {
        $('#logs-section').append(getLogTemplate(log_data));
      });

      if (scroll_to_bottom)
        $('#logs-section').scrollTop($('#logs-section')[0].scrollHeight);
    }

    function removeLog(ids) {
      $('#logs-section .log-item').each(function() {
        var item_id = $(this).attr('data-id');
        if (ids.includes(parseInt(item_id)) == false) {
          $(this).remove();
        }
      });
    }

    function removeScrapers(ids) {
      $('.scraper-item').each(function() {
        var item_id = $(this).attr('data-id');
        if (ids.includes(parseInt(item_id)) == true) {
          $(this).remove();
        }
      });
    }

    function updateRescraperStatus(status) {
      if (status == false) {
        // Change rescraper section icon as play icon.
        $('.btn-scraper-try-again').html('<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"><title>triangle-sm-right</title><g fill="#000000"><path fill="#000000" d="M20.66 13.94l-10-6.25a1.25 1.25 0 0 0-1.91 1.06v12.5a1.25 1.25 0 0 0 1.91 1.06l10-6.25a1.25 1.25 0 0 0 0-2.12z"></path></g></svg>');
        $('.btn-scraper-try-again').siblings('.menu-bar__label').html('Re-scrape All');
      }
    }

    $('#logs-section').scroll(function() {
      if (this.scrollHeight - $(this).scrollTop() - $(this).outerHeight() < 1)
        scroll_to_bottom = true;
      else
        scroll_to_bottom = false;
    });

    function loadLogs() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
      });

      $.ajax({
        url: "{{ url('scraper/get_logs') }}",
        dataType: 'json',
        method: 'post',
        data: {
          time: log_time
        },
        success: function(response){
          if (response.status == false) {
          } else {
            log_time = response.log_time;
            displayLog(response.data);
            removeLog(response.ids);
            removeScrapers(response.scraper_ids);
            updateRescraperStatus(response.rescrape);
          }
        }
      });

      setTimeout(loadLogs, 5000); // every 5 seconds (because the time between each page scraper is at least 5 seconds)
    }

    loadLogs();
  });
</script>
@endauth
