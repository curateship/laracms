<div class="flex justify-between controlbar--sticky">
  <div class="margin-xs">
    <div class="inline-flex items-baseline">
      <h1 class="text-md color-contrast-high padding-y-xxxxs margin-x-xs" for="scraperFilter">Scrapers</h1>
      <div class="select inline-block js-select" data-trigger-class="reset text-sm color-contrast-high h1 inline-flex items-center cursor-pointer js-tab-focus">
        <select name="scraper_filter" id="scraperFilter">
          <optgroup label="Scraper Status">
            <option value="">Currently Running</option>
          </optgroup>
          <optgroup label="Scrapers">
            <?php
              $s_idx = 1;
            ?>
            @foreach($scraper_ids as $id)
              <option value="{{ $id }}" {{ isset($scraper_id) && $scraper_id == $id ? 'selected' : '' }}>Scraper {{ $s_idx }}</option>
              <?php
                $s_idx++;
              ?>
            @endforeach
          </optgroup>
        </select>
        <svg class="icon icon--xxxs margin-left-xxs" viewBox="0 0 8 8"><path d="M7.934,1.251A.5.5,0,0,0,7.5,1H.5a.5.5,0,0,0-.432.752l3.5,6a.5.5,0,0,0,.864,0l3.5-6A.5.5,0,0,0,7.934,1.251Z"/></svg>
      </div>
    </div>
  </div> <!-- end of <div class="margin-xs"> -->

  <!-- Menu Bar -->
  <div class="flex flex-wrap items-center justify-between margin-right-xxs">
    <div class="flex flex-wrap">
      <li class="menu-bar__item padding-top-xxxs">
        <a href="{{ url('/admin/scraper/scraper-v1') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>pencil</title><g fill="#000000"><path d="M18.85 4.39l-3.32-3.32a0.83 0.83 0 0 0-1.18 0l-11.62 11.62a0.84 0.84 0 0 0-0.2 0.33l-1.66 4.98a0.83 0.83 0 0 0 0.79 1.09 0.84 0.84 0 0 0 0.26-0.04l4.98-1.66a0.84 0.84 0 0 0 0.33-0.2l11.62-11.62a0.83 0.83 0 0 0 0-1.18z m-6.54 1.08l1.17-1.18 2.15 2.15-1.18 1.17z" fill="#000000"></path></g></svg>
        </a>
        <span class="menu-bar__label">Add Scraper</span>
      </li>

      <li class="menu-bar__item padding-top-xxxs">
        <a href="{{ url('/admin/scraper/settings') }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>cogwheel</title><g fill="#000000"><path d="M19.3 8.35l-2.48-0.28a7.05 7.05 0 0 0-0.62-1.49l1.56-1.95a0.83 0.83 0 0 0-0.06-1.11l-1.19-1.18a0.83 0.83 0 0 0-1.11-0.06l-1.95 1.56a7.05 7.05 0 0 0-1.49-0.62l-0.27-2.48a0.83 0.83 0 0 0-0.83-0.74h-1.67a0.83 0.83 0 0 0-0.84 0.74l-0.27 2.48a7.05 7.05 0 0 0-1.49 0.62l-1.95-1.56a0.83 0.83 0 0 0-1.11 0.06l-1.19 1.19a0.83 0.83 0 0 0-0.06 1.11l1.56 1.95a7.05 7.05 0 0 0-0.62 1.49l-2.48 0.27a0.83 0.83 0 0 0-0.74 0.83v1.67a0.83 0.83 0 0 0 0.74 0.84l2.48 0.28a7.05 7.05 0 0 0 0.62 1.49l-1.56 1.94a0.83 0.83 0 0 0 0.06 1.11l1.19 1.19a0.83 0.83 0 0 0 1.11 0.06l1.95-1.56a7.05 7.05 0 0 0 1.49 0.62l0.27 2.48a0.83 0.83 0 0 0 0.84 0.74h1.67a0.83 0.83 0 0 0 0.83-0.74l0.28-2.48a7.05 7.05 0 0 0 1.49-0.62l1.95 1.56a0.83 0.83 0 0 0 1.11-0.06l1.18-1.19a0.83 0.83 0 0 0 0.06-1.11l-1.56-1.95a7.05 7.05 0 0 0 0.62-1.49l2.48-0.27a0.83 0.83 0 0 0 0.74-0.83v-1.67a0.83 0.83 0 0 0-0.74-0.84z m-9.28 5.01a3.34 3.34 0 1 1 3.34-3.34 3.34 3.34 0 0 1-3.34 3.34z" fill="#000000"></path></g></svg>
        </a>
        <span class="menu-bar__label">Settings</span>
      </li>
    </div>
  </div> <!-- end of <div class="flex flex-wrap items-center justify-between margin-right-xxs"> -->
</div>
