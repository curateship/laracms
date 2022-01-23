// File#: _2_dropdown
// Usage: codyhouse.co/license
(function() {
    var Dropdown = function(element) {
      this.element = element;
      this.trigger = this.element.getElementsByClassName('js-dropdown__trigger')[0];
      this.dropdown = this.element.getElementsByClassName('js-dropdown__menu')[0];
      this.triggerFocus = false;
      this.dropdownFocus = false;
      this.hideInterval = false;
      // sublevels
      this.dropdownSubElements = this.element.getElementsByClassName('js-dropdown__sub-wrapper');
      this.prevFocus = false; // store element that was in focus before focus changed
      this.addDropdownEvents();
    };

    Dropdown.prototype.addDropdownEvents = function(){
      //place dropdown
      var self = this;
      this.placeElement();
      this.element.addEventListener('placeDropdown', function(event){
        self.placeElement();
      });
      // init dropdown
      this.initElementEvents(this.trigger, this.triggerFocus); // this is used to trigger the primary dropdown
      this.initElementEvents(this.dropdown, this.dropdownFocus); // this is used to trigger the primary dropdown
      // init sublevels
      this.initSublevels(); // if there are additional sublevels -> bind hover/focus events
    };

    Dropdown.prototype.placeElement = function() {

      // remove inline style first
      this.dropdown.removeAttribute('style');
      // check dropdown position
      var triggerPosition = this.trigger.getBoundingClientRect(),
        isRight = (window.innerWidth < triggerPosition.left + parseInt(getComputedStyle(this.dropdown).getPropertyValue('width')));

      var right = 'right: 0px; left: auto;';
      var left = 'left: 0px; right: auto;';

      if(this.dropdown.getAttribute('id') === 'user-desktop-menu'){
          right = 'left: auto;';
          left = 'right: auto;';
      }

      var xPosition = isRight ? right : left;
      this.dropdown.setAttribute('style', xPosition);
    };

    Dropdown.prototype.initElementEvents = function(element, bool) {
      var self = this;
      element.addEventListener('mouseenter', function(){
        bool = true;
        self.showDropdown();
      });
      element.addEventListener('focus', function(){
        self.showDropdown();
      });
      element.addEventListener('mouseleave', function(){
        bool = false;
        self.hideDropdown();
      });
      element.addEventListener('focusout', function(){
        self.hideDropdown();
      });
    };

    Dropdown.prototype.showDropdown = function(){
      if(this.hideInterval) clearInterval(this.hideInterval);
      // remove style attribute
      this.dropdown.removeAttribute('style');
      this.placeElement();
      this.showLevel(this.dropdown, true);
    };

    Dropdown.prototype.hideDropdown = function(){
      var self = this;
      if(this.hideInterval) clearInterval(this.hideInterval);
      this.hideInterval = setTimeout(function(){
        var dropDownFocus = document.activeElement.closest('.js-dropdown'),
          inFocus = dropDownFocus && (dropDownFocus == self.element);
        // if not in focus and not hover -> hide
        if(!self.triggerFocus && !self.dropdownFocus && !inFocus) {
          self.hideLevel(self.dropdown, true);
          // make sure to hide sub/dropdown
          self.hideSubLevels();
          self.prevFocus = false;
        }
      }, 300);
    };

    Dropdown.prototype.initSublevels = function(){
      var self = this;
      var dropdownMenu = this.element.getElementsByClassName('js-dropdown__menu');
      for(var i = 0; i < dropdownMenu.length; i++) {
        var listItems = dropdownMenu[i].children;
        // bind hover
        new menuAim({
          menu: dropdownMenu[i],
          activate: function(row) {
              var subList = row.getElementsByClassName('js-dropdown__menu')[0];
              if(!subList) return;
              Util.addClass(row.querySelector('a'), 'dropdown__item--hover');
              self.showLevel(subList);
          },
          deactivate: function(row) {
              var subList = row.getElementsByClassName('dropdown__menu')[0];
              if(!subList) return;
              Util.removeClass(row.querySelector('a'), 'dropdown__item--hover');
              self.hideLevel(subList);
          },
          submenuSelector: '.js-dropdown__sub-wrapper',
        });
      }
      // store focus element before change in focus
      this.element.addEventListener('keydown', function(event) {
        if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
          self.prevFocus = document.activeElement;
        }
      });
      // make sure that sublevel are visible when their items are in focus
      this.element.addEventListener('keyup', function(event) {
        if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
          // focus has been moved -> make sure the proper classes are added to subnavigation
          var focusElement = document.activeElement,
            focusElementParent = focusElement.closest('.js-dropdown__menu'),
            focusElementSibling = focusElement.nextElementSibling;

          // if item in focus is inside submenu -> make sure it is visible
          if(focusElementParent && !Util.hasClass(focusElementParent, 'dropdown__menu--is-visible')) {
            self.showLevel(focusElementParent);
          }
          // if item in focus triggers a submenu -> make sure it is visible
          if(focusElementSibling && !Util.hasClass(focusElementSibling, 'dropdown__menu--is-visible')) {
            self.showLevel(focusElementSibling);
          }

          // check previous element in focus -> hide sublevel if required
          if( !self.prevFocus) return;
          var prevFocusElementParent = self.prevFocus.closest('.js-dropdown__menu'),
            prevFocusElementSibling = self.prevFocus.nextElementSibling;

          if( !prevFocusElementParent ) return;

          // element in focus and element prev in focus are siblings
          if( focusElementParent && focusElementParent == prevFocusElementParent) {
            if(prevFocusElementSibling) self.hideLevel(prevFocusElementSibling);
            return;
          }

          // element in focus is inside submenu triggered by element prev in focus
          if( prevFocusElementSibling && focusElementParent && focusElementParent == prevFocusElementSibling) return;

          // shift tab -> element in focus triggers the submenu of the element prev in focus
          if( focusElementSibling && prevFocusElementParent && focusElementSibling == prevFocusElementParent) return;

          var focusElementParentParent = focusElementParent.parentNode.closest('.js-dropdown__menu');

          // shift tab -> element in focus is inside the dropdown triggered by a siblings of the element prev in focus
          if(focusElementParentParent && focusElementParentParent == prevFocusElementParent) {
            if(prevFocusElementSibling) self.hideLevel(prevFocusElementSibling);
            return;
          }

          if(prevFocusElementParent && Util.hasClass(prevFocusElementParent, 'dropdown__menu--is-visible')) {
            self.hideLevel(prevFocusElementParent);
          }
        }
      });
    };

    Dropdown.prototype.hideSubLevels = function(){
      var visibleSubLevels = this.dropdown.getElementsByClassName('dropdown__menu--is-visible');
      if(visibleSubLevels.length == 0) return;
      while (visibleSubLevels[0]) {
        this.hideLevel(visibleSubLevels[0]);
         }
         var hoveredItems = this.dropdown.getElementsByClassName('dropdown__item--hover');
         while (hoveredItems[0]) {
        Util.removeClass(hoveredItems[0], 'dropdown__item--hover');
         }
    };

    Dropdown.prototype.showLevel = function(level, bool){
      if(bool == undefined) {
        //check if the sublevel needs to be open to the left
        Util.removeClass(level, 'dropdown__menu--left');
        var boundingRect = level.getBoundingClientRect();
        if(window.innerWidth - boundingRect.right < 5 && boundingRect.left + window.scrollX > 2*boundingRect.width) Util.addClass(level, 'dropdown__menu--left');
      }
      Util.addClass(level, 'dropdown__menu--is-visible');
      Util.removeClass(level, 'dropdown__menu--is-hidden');
    };

    Dropdown.prototype.hideLevel = function(level, bool){
      if(!Util.hasClass(level, 'dropdown__menu--is-visible')) return;
      Util.removeClass(level, 'dropdown__menu--is-visible');
      Util.addClass(level, 'dropdown__menu--is-hidden');

      level.addEventListener('transitionend', function cb(event){
        if(event.propertyName != 'opacity') return;
        level.removeEventListener('transitionend', cb);
        if(Util.hasClass(level, 'dropdown__menu--is-hidden')) Util.removeClass(level, 'dropdown__menu--is-hidden dropdown__menu--left');
        if(bool && !Util.hasClass(level, 'dropdown__menu--is-visible')) level.setAttribute('style', 'width: 0px; overflow: hidden;');
      });
    };

    window.Dropdown = Dropdown;

    var dropdown = document.getElementsByClassName('js-dropdown');
    if( dropdown.length > 0 ) { // init Dropdown objects
      for( var i = 0; i < dropdown.length; i++) {
        (function(i){new Dropdown(dropdown[i]);})(i);
      }
    }
  }());
