// File#: _1_date-picker
// Usage: codyhouse.co/license
(function() {
    var DatePicker = function(opts) {
      this.options = Util.extend(DatePicker.defaults , opts);
      this.element = this.options.element;
      this.input = this.element.getElementsByClassName('js-date-input__text')[0];
      this.trigger = this.element.getElementsByClassName('js-date-input__trigger')[0];
      this.triggerLabel = this.trigger.getAttribute('aria-label');
      this.datePicker = this.element.getElementsByClassName('js-date-picker')[0];
      this.body = this.datePicker.getElementsByClassName('js-date-picker__dates')[0];
      this.navigation = this.datePicker.getElementsByClassName('js-date-picker__month-nav')[0];
      this.heading = this.datePicker.getElementsByClassName('js-date-picker__month-label')[0];
      this.pickerVisible = false;
      // date format
      this.dateIndexes = getDateIndexes(this); // store indexes of date parts (d, m, y)
      // set initial date
      resetCalendar(this);
      // selected date
      this.dateSelected = false;
      this.selectedDay = false;
      this.selectedMonth = false;
      this.selectedYear = false;
      // focus trap
      this.firstFocusable = false;
      this.lastFocusable = false;
      // date value - for custom control variation
      this.dateValueEl = this.element.getElementsByClassName('js-date-input__value');
      if(this.dateValueEl.length > 0) {
        this.dateValueLabelInit = this.dateValueEl[0].textContent; // initial input value
      }
      initCalendarAria(this);
      initCalendarEvents(this);
      // place picker according to available space
      placeCalendar(this);
    };
  
    DatePicker.prototype.showCalendar = function() {
      showCalendar(this);
    };
  
    DatePicker.prototype.showNextMonth = function() {
      showNext(this, true);
    };
  
    DatePicker.prototype.showPrevMonth = function() {
      showPrev(this, true);
    };
  
    function initCalendarAria(datePicker) {
      // reset calendar button label
      resetLabelCalendarTrigger(datePicker);
      if(datePicker.dateValueEl.length > 0) {
        resetCalendar(datePicker);
        resetLabelCalendarValue(datePicker);
      }
      // create a live region used to announce new month selection to SR
      var srLiveReagion = document.createElement('div');
      srLiveReagion.setAttribute('aria-live', 'polite');
      Util.addClass(srLiveReagion, 'sr-only js-date-input__sr-live');
      datePicker.element.appendChild(srLiveReagion);
      datePicker.srLiveReagion = datePicker.element.getElementsByClassName('js-date-input__sr-live')[0];
    };
  
    function initCalendarEvents(datePicker) {
      datePicker.input.addEventListener('focus', function(event){
        toggleCalendar(datePicker, true); // toggle calendar when focus is on input
      });
      if(datePicker.trigger) {
        datePicker.trigger.addEventListener('click', function(event){ // open calendar when clicking on calendar button
          event.preventDefault();
          datePicker.pickerVisible = false;
          toggleCalendar(datePicker);
          datePicker.trigger.setAttribute('aria-expanded', 'true');
        });
      }
  
      // select a date inside the date picker
      datePicker.body.addEventListener('click', function(event){
        event.preventDefault();
        var day = event.target.closest('button');
        if(day) {
          datePicker.dateSelected = true;
          datePicker.selectedDay = day.innerText;
          datePicker.selectedMonth = datePicker.currentMonth;
          datePicker.selectedYear = datePicker.currentYear;
          setInputValue(datePicker);
          datePicker.input.focus(); // focus on the input element and close picker
          resetLabelCalendarTrigger(datePicker);
          resetLabelCalendarValue(datePicker);
        }
      });
  
      // navigate using month nav
      datePicker.navigation.addEventListener('click', function(event){
        event.preventDefault();
        var btn = event.target.closest('.js-date-picker__month-nav-btn');
        if(btn) {
          Util.hasClass(btn, 'js-date-picker__month-nav-btn--prev') ? showPrev(datePicker, true) : showNext(datePicker, true);
        }
      });
  
      // hide calendar
      window.addEventListener('keydown', function(event){ // close calendar on esc
        if(event.keyCode && event.keyCode == 27 || event.key && event.key.toLowerCase() == 'escape') {
          if(document.activeElement.closest('.js-date-picker')) {
            datePicker.input.focus(); //if focus is inside the calendar -> move the focus to the input element 
          } else { // do not move focus -> only close calendar
            hideCalendar(datePicker); 
          }
        }
      });
      window.addEventListener('click', function(event){
        if(!event.target.closest('.js-date-picker') && !event.target.closest('.js-date-input') && datePicker.pickerVisible) {
          hideCalendar(datePicker);
        }
      });
  
      // navigate through days of calendar
      datePicker.body.addEventListener('keydown', function(event){
        var day = datePicker.currentDay;
        if(event.keyCode && event.keyCode == 40 || event.key && event.key.toLowerCase() == 'arrowdown') {
          day = day + 7;
          resetDayValue(day, datePicker);
        } else if(event.keyCode && event.keyCode == 39 || event.key && event.key.toLowerCase() == 'arrowright') {
          day = day + 1;
          resetDayValue(day, datePicker);
        } else if(event.keyCode && event.keyCode == 37 || event.key && event.key.toLowerCase() == 'arrowleft') {
          day = day - 1;
          resetDayValue(day, datePicker);
        } else if(event.keyCode && event.keyCode == 38 || event.key && event.key.toLowerCase() == 'arrowup') {
          day = day - 7;
          resetDayValue(day, datePicker);
        } else if(event.keyCode && event.keyCode == 35 || event.key && event.key.toLowerCase() == 'end') { // move focus to last day of week
          event.preventDefault();
          day = day + 6 - getDayOfWeek(datePicker.currentYear, datePicker.currentMonth, day);
          resetDayValue(day, datePicker);
        } else if(event.keyCode && event.keyCode == 36 || event.key && event.key.toLowerCase() == 'home') { // move focus to first day of week
          event.preventDefault();
          day = day - getDayOfWeek(datePicker.currentYear, datePicker.currentMonth, day);
          resetDayValue(day, datePicker);
        } else if(event.keyCode && event.keyCode == 34 || event.key && event.key.toLowerCase() == 'pagedown') {
          event.preventDefault();
          showNext(datePicker); // show next month
        } else if(event.keyCode && event.keyCode == 33 || event.key && event.key.toLowerCase() == 'pageup') {
          event.preventDefault();
          showPrev(datePicker); // show prev month
        }
      });
  
      // trap focus inside calendar
      datePicker.datePicker.addEventListener('keydown', function(event){
        if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
          //trap focus inside modal
          trapFocus(event, datePicker);
        }
      });
  
      datePicker.input.addEventListener('keydown', function(event){
        if(event.keyCode && event.keyCode == 13 || event.key && event.key.toLowerCase() == 'enter') {
          // update calendar on input enter
          resetCalendar(datePicker);
          resetLabelCalendarTrigger(datePicker);
          resetLabelCalendarValue(datePicker);
          hideCalendar(datePicker);
        } else if(event.keyCode && event.keyCode == 40 || event.key && event.key.toLowerCase() == 'arrowdown' && datePicker.pickerVisible) { // move focus to calendar using arrow down
          datePicker.body.querySelector('button[tabindex="0"]').focus();
        };
      });
    };
  
    function getCurrentDay(date) {
      return (date) 
        ? getDayFromDate(date)
        : new Date().getDate();
    };
  
    function getCurrentMonth(date) {
      return (date) 
        ? getMonthFromDate(date)
        : new Date().getMonth();
    };
  
    function getCurrentYear(date) {
      return (date) 
        ? getYearFromDate(date)
        : new Date().getFullYear();
    };
  
    function getDayFromDate(date) {
      var day = parseInt(date.split('-')[2]);
      return isNaN(day) ? getCurrentDay(false) : day;
    };
  
    function getMonthFromDate(date) {
      var month = parseInt(date.split('-')[1]) - 1;
      return isNaN(month) ? getCurrentMonth(false) : month;
    };
  
    function getYearFromDate(date) {
      var year = parseInt(date.split('-')[0]);
      return isNaN(year) ? getCurrentYear(false) : year;
    };
  
    function showNext(datePicker, bool) {
      // show next month
      datePicker.currentYear = (datePicker.currentMonth === 11) ? datePicker.currentYear + 1 : datePicker.currentYear;
      datePicker.currentMonth = (datePicker.currentMonth + 1) % 12;
      datePicker.currentDay = checkDayInMonth(datePicker);
      showCalendar(datePicker, bool);
      datePicker.srLiveReagion.textContent = datePicker.options.months[datePicker.currentMonth] + ' ' + datePicker.currentYear;
    };
  
    function showPrev(datePicker, bool) {
      // show prev month
      datePicker.currentYear = (datePicker.currentMonth === 0) ? datePicker.currentYear - 1 : datePicker.currentYear;
      datePicker.currentMonth = (datePicker.currentMonth === 0) ? 11 : datePicker.currentMonth - 1;
      datePicker.currentDay = checkDayInMonth(datePicker);
      showCalendar(datePicker, bool);
      datePicker.srLiveReagion.textContent = datePicker.options.months[datePicker.currentMonth] + ' ' + datePicker.currentYear;
    };
  
    function checkDayInMonth(datePicker) {
      return (datePicker.currentDay > daysInMonth(datePicker.currentYear, datePicker.currentMonth)) ? 1 : datePicker.currentDay;
    };
  
    function daysInMonth(year, month) {
      return 32 - new Date(year, month, 32).getDate();
    };
  
    function resetCalendar(datePicker) {
      var currentDate = false,
        selectedDate = datePicker.input.value;
  
      datePicker.dateSelected = false;
      if( selectedDate != '') {
        var date = getDateFromInput(datePicker);
        datePicker.dateSelected = true;
        currentDate = date;
      } 
      datePicker.currentDay = getCurrentDay(currentDate);
      datePicker.currentMonth = getCurrentMonth(currentDate); 
      datePicker.currentYear = getCurrentYear(currentDate); 
      
      datePicker.selectedDay = datePicker.dateSelected ? datePicker.currentDay : false;
      datePicker.selectedMonth = datePicker.dateSelected ? datePicker.currentMonth : false;
      datePicker.selectedYear = datePicker.dateSelected ? datePicker.currentYear : false;
    };
  
    function showCalendar(datePicker, bool) {
      // show calendar element
      var firstDay = getDayOfWeek(datePicker.currentYear, datePicker.currentMonth, '01');
      datePicker.body.innerHTML = '';
      datePicker.heading.innerHTML = datePicker.options.months[datePicker.currentMonth] + ' ' + datePicker.currentYear;
  
      // creating all cells
      var date = 1,
        calendar = '';
      for (var i = 0; i < 6; i++) {
        for (var j = 0; j < 7; j++) {
          if (i === 0 && j < firstDay) {
            calendar = calendar + '<li></li>';
          } else if (date > daysInMonth(datePicker.currentYear, datePicker.currentMonth)) {
            break;
          } else {
            var classListDate = '',
              tabindexValue = '-1';
            if (date === datePicker.currentDay) {
              tabindexValue = '0';
            } 
            if(!datePicker.dateSelected && getCurrentMonth() == datePicker.currentMonth && getCurrentYear() == datePicker.currentYear && date == getCurrentDay()){
              classListDate = classListDate+' date-picker__date--today'
            }
            if (datePicker.dateSelected && date === datePicker.selectedDay && datePicker.currentYear === datePicker.selectedYear && datePicker.currentMonth === datePicker.selectedMonth) {
              classListDate = classListDate+'  date-picker__date--selected';
            }
            calendar = calendar + '<li><button class="date-picker__date'+classListDate+'" tabindex="'+tabindexValue+'" type="button">'+date+'</button></li>';
            date++;
          }
        }
      }
      datePicker.body.innerHTML = calendar; // appending days into calendar body
      
      // show calendar
      if(!datePicker.pickerVisible) Util.addClass(datePicker.datePicker, 'date-picker--is-visible');
      datePicker.pickerVisible = true;
  
      //  if bool is false, move focus to calendar day
      if(!bool) datePicker.body.querySelector('button[tabindex="0"]').focus();
  
      // store first/last focusable elements
      getFocusableElements(datePicker);
  
      //place calendar
      placeCalendar(datePicker);
    };
  
    function hideCalendar(datePicker) {
      Util.removeClass(datePicker.datePicker, 'date-picker--is-visible');
      datePicker.pickerVisible = false;
  
      // reset first/last focusable
      datePicker.firstFocusable = false;
      datePicker.lastFocusable = false;
  
      // reset trigger aria-expanded attribute
      if(datePicker.trigger) datePicker.trigger.setAttribute('aria-expanded', 'false');
    };
  
    function toggleCalendar(datePicker, bool) {
      if(!datePicker.pickerVisible) {
        resetCalendar(datePicker);
        showCalendar(datePicker, bool);
      } else {
        hideCalendar(datePicker);
      }
    };
  
    function getDayOfWeek(year, month, day) {
      var weekDay = (new Date(year, month, day)).getDay() - 1;
      if(weekDay < 0) weekDay = 6;
      return weekDay;
    };
  
    function getDateIndexes(datePicker) {
      var dateFormat = datePicker.options.dateFormat.toLowerCase().replace(/-/g, '');
      return [dateFormat.indexOf('d'), dateFormat.indexOf('m'), dateFormat.indexOf('y')];
    };
  
    function setInputValue(datePicker) {
      datePicker.input.value = getDateForInput(datePicker);
    };
  
    function getDateForInput(datePicker) {
      var dateArray = [];
      dateArray[datePicker.dateIndexes[0]] = getReadableDate(datePicker.selectedDay);
      dateArray[datePicker.dateIndexes[1]] = getReadableDate(datePicker.selectedMonth+1);
      dateArray[datePicker.dateIndexes[2]] = datePicker.selectedYear;
      return dateArray[0]+datePicker.options.dateSeparator+dateArray[1]+datePicker.options.dateSeparator+dateArray[2];
    };
  
    function getDateFromInput(datePicker) {
      var dateArray = datePicker.input.value.split(datePicker.options.dateSeparator);
      return dateArray[datePicker.dateIndexes[2]]+'-'+dateArray[datePicker.dateIndexes[1]]+'-'+dateArray[datePicker.dateIndexes[0]];
    };
  
    function getReadableDate(date) {
      return (date < 10) ? '0'+date : date;
    };
  
    function resetDayValue(day, datePicker) {
      var totDays = daysInMonth(datePicker.currentYear, datePicker.currentMonth);
      if( day > totDays) {
        datePicker.currentDay = day - totDays;
        showNext(datePicker, false);
      } else if(day < 1) {
        var newMonth = datePicker.currentMonth == 0 ? 11 : datePicker.currentMonth - 1;
        datePicker.currentDay = daysInMonth(datePicker.currentYear, newMonth) + day;
        showPrev(datePicker, false);
      } else {
        datePicker.currentDay = day;
        datePicker.body.querySelector('button[tabindex="0"]').setAttribute('tabindex', '-1');
        // set new tabindex to selected item
        var buttons = datePicker.body.getElementsByTagName("button");
        for (var i = 0; i < buttons.length; i++) {
          if (buttons[i].textContent == datePicker.currentDay) {
            buttons[i].setAttribute('tabindex', '0');
            buttons[i].focus();
            break;
          }
        }
        getFocusableElements(datePicker); // update first focusable/last focusable element
      }
    };
  
    function resetLabelCalendarTrigger(datePicker) {
      if(!datePicker.trigger) return;
      // reset accessible label of the calendar trigger
      (datePicker.selectedYear && datePicker.selectedMonth !== false && datePicker.selectedDay) 
        ? datePicker.trigger.setAttribute('aria-label', datePicker.triggerLabel+', selected date is '+ new Date(datePicker.selectedYear, datePicker.selectedMonth, datePicker.selectedDay).toDateString())
        : datePicker.trigger.setAttribute('aria-label', datePicker.triggerLabel);
    };
  
    function resetLabelCalendarValue(datePicker) {
      // this is used for the --custom-control variation -> there's a label that should be updated with the selected date
      if(datePicker.dateValueEl.length < 1) return;
      (datePicker.selectedYear && datePicker.selectedMonth !== false && datePicker.selectedDay) 
        ? datePicker.dateValueEl[0].textContent = getDateForInput(datePicker)
        : datePicker.dateValueEl[0].textContent = datePicker.dateValueLabelInit;
    };
  
    function getFocusableElements(datePicker) {
      var allFocusable = datePicker.datePicker.querySelectorAll('[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable], audio[controls], video[controls], summary');
      getFirstFocusable(allFocusable, datePicker);
      getLastFocusable(allFocusable, datePicker);
    }
  
    function getFirstFocusable(elements, datePicker) {
      for(var i = 0; i < elements.length; i++) {
        if( (elements[i].offsetWidth || elements[i].offsetHeight || elements[i].getClientRects().length) &&  elements[i].getAttribute('tabindex') != '-1') {
          datePicker.firstFocusable = elements[i];
          return true;
        }
      }
    };
  
    function getLastFocusable(elements, datePicker) {
      //get last visible focusable element inside the modal
      for(var i = elements.length - 1; i >= 0; i--) {
        if( (elements[i].offsetWidth || elements[i].offsetHeight || elements[i].getClientRects().length) &&  elements[i].getAttribute('tabindex') != '-1' ) {
          datePicker.lastFocusable = elements[i];
          return true;
        }
      }
    };
  
    function trapFocus(event, datePicker) {
      if( datePicker.firstFocusable == document.activeElement && event.shiftKey) {
        //on Shift+Tab -> focus last focusable element when focus moves out of calendar
        event.preventDefault();
        datePicker.lastFocusable.focus();
      }
      if( datePicker.lastFocusable == document.activeElement && !event.shiftKey) {
        //on Tab -> focus first focusable element when focus moves out of calendar
        event.preventDefault();
        datePicker.firstFocusable.focus();
      }
    };
  
    function placeCalendar(datePicker) {
      // reset position
      datePicker.datePicker.style.left = '0px';
      datePicker.datePicker.style.right = 'auto';
      
      //check if you need to modify the calendar postion
      var pickerBoundingRect = datePicker.datePicker.getBoundingClientRect();
  
      if(pickerBoundingRect.right > window.innerWidth) {
        datePicker.datePicker.style.left = 'auto';
        datePicker.datePicker.style.right = '0px';
      }
    };
  
    DatePicker.defaults = {
      element : '',
      months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      dateFormat: 'd-m-y',
      dateSeparator: '/'
    };
  
    window.DatePicker = DatePicker;
  
    var datePicker = document.getElementsByClassName('js-date-input'),
      flexSupported = Util.cssSupports('align-items', 'stretch');
    if( datePicker.length > 0 ) {
      for( var i = 0; i < datePicker.length; i++) {(function(i){
        if(!flexSupported) {
          Util.addClass(datePicker[i], 'date-input--hide-calendar');
          return;
        }
        var opts = {element: datePicker[i]};
        if(datePicker[i].getAttribute('data-date-format')) {
          opts.dateFormat = datePicker[i].getAttribute('data-date-format');
        }
        if(datePicker[i].getAttribute('data-date-separator')) {
          opts.dateSeparator = datePicker[i].getAttribute('data-date-separator');
        }
        if(datePicker[i].getAttribute('data-months')) {
          opts.months = datePicker[i].getAttribute('data-months').split(',').map(function(item) {return item.trim();});
        }
        new DatePicker(opts);
      })(i);}
    }
  }());
  
  