// File#: _1_drawer
// Usage: codyhouse.co/license
(function() {
  var Drawer = function(element) {
    this.element = element;
    this.content = document.getElementsByClassName('js-drawer__body')[0];
    this.triggers = document.querySelectorAll('[aria-controls="'+this.element.getAttribute('id')+'"]');
    this.firstFocusable = null;
    this.lastFocusable = null;
    this.selectedTrigger = null;
    this.isModal = Util.hasClass(this.element, 'js-drawer--modal');
    this.showClass = "drawer--is-visible";
    this.preventScrollEl = this.getPreventScrollEl();
    this.initDrawer();
  };

  Drawer.prototype.getPreventScrollEl = function() {
    var scrollEl = false;
    var querySelector = this.element.getAttribute('data-drawer-prevent-scroll');
    if(querySelector) scrollEl = document.querySelector(querySelector);
    return scrollEl;
  };

  Drawer.prototype.initDrawer = function() {
    var self = this;
    //open drawer when clicking on trigger buttons
    if ( this.triggers ) {
      for(var i = 0; i < this.triggers.length; i++) {
        this.triggers[i].addEventListener('click', function(event) {
          event.preventDefault();
          if(Util.hasClass(self.element, self.showClass)) {
            self.closeDrawer(event.target);
            return;
          }
          self.selectedTrigger = event.target;
          self.showDrawer();
          self.initDrawerEvents();
        });
      }
    }

    // if drawer is already open -> we should initialize the drawer events
    if(Util.hasClass(this.element, this.showClass)) this.initDrawerEvents();
  };

  Drawer.prototype.showDrawer = function() {
    var self = this;
    this.content.scrollTop = 0;
    Util.addClass(this.element, this.showClass);
    this.getFocusableElements();
    Util.moveFocus(this.element);
    // wait for the end of transitions before moving focus
    this.element.addEventListener("transitionend", function cb(event) {
      Util.moveFocus(self.element);
      self.element.removeEventListener("transitionend", cb);
    });
    this.emitDrawerEvents('drawerIsOpen', this.selectedTrigger);
    // change the overflow of the preventScrollEl
    if(this.preventScrollEl) this.preventScrollEl.style.overflow = 'hidden';
  };

  Drawer.prototype.closeDrawer = function(target) {
    Util.removeClass(this.element, this.showClass);
    this.firstFocusable = null;
    this.lastFocusable = null;
    if(this.selectedTrigger) this.selectedTrigger.focus();
    //remove listeners
    this.cancelDrawerEvents();
    this.emitDrawerEvents('drawerIsClose', target);
    // change the overflow of the preventScrollEl
    if(this.preventScrollEl) this.preventScrollEl.style.overflow = '';
  };

  Drawer.prototype.initDrawerEvents = function() {
    //add event listeners
    this.element.addEventListener('keydown', this);
    this.element.addEventListener('click', this);
  };

  Drawer.prototype.cancelDrawerEvents = function() {
    //remove event listeners
    this.element.removeEventListener('keydown', this);
    this.element.removeEventListener('click', this);
  };

  Drawer.prototype.handleEvent = function (event) {
    switch(event.type) {
      case 'click': {
        this.initClick(event);
      }
      case 'keydown': {
        this.initKeyDown(event);
      }
    }
  };

  Drawer.prototype.initKeyDown = function(event) {
    if( event.keyCode && event.keyCode == 27 || event.key && event.key == 'Escape' ) {
      //close drawer window on esc
      this.closeDrawer(false);
    } else if( this.isModal && (event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' )) {
      //trap focus inside drawer
      this.trapFocus(event);
    }
  };

  Drawer.prototype.initClick = function(event) {
    //close drawer when clicking on close button or drawer bg layer 
    if( !event.target.closest('.js-drawer__close') && !Util.hasClass(event.target, 'js-drawer') ) return;
    event.preventDefault();
    this.closeDrawer(event.target);
  };

  Drawer.prototype.trapFocus = function(event) {
    if( this.firstFocusable == document.activeElement && event.shiftKey) {
      //on Shift+Tab -> focus last focusable element when focus moves out of drawer
      event.preventDefault();
      this.lastFocusable.focus();
    }
    if( this.lastFocusable == document.activeElement && !event.shiftKey) {
      //on Tab -> focus first focusable element when focus moves out of drawer
      event.preventDefault();
      this.firstFocusable.focus();
    }
  }

  Drawer.prototype.getFocusableElements = function() {
    //get all focusable elements inside the drawer
    var allFocusable = this.element.querySelectorAll('[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable], audio[controls], video[controls], summary');
    this.getFirstVisible(allFocusable);
    this.getLastVisible(allFocusable);
  };

  Drawer.prototype.getFirstVisible = function(elements) {
    //get first visible focusable element inside the drawer
    for(var i = 0; i < elements.length; i++) {
      if( elements[i].offsetWidth || elements[i].offsetHeight || elements[i].getClientRects().length ) {
        this.firstFocusable = elements[i];
        return true;
      }
    }
  };

  Drawer.prototype.getLastVisible = function(elements) {
    //get last visible focusable element inside the drawer
    for(var i = elements.length - 1; i >= 0; i--) {
      if( elements[i].offsetWidth || elements[i].offsetHeight || elements[i].getClientRects().length ) {
        this.lastFocusable = elements[i];
        return true;
      }
    }
  };

  Drawer.prototype.emitDrawerEvents = function(eventName, target) {
    var event = new CustomEvent(eventName, {detail: target});
    this.element.dispatchEvent(event);
  };

  window.Drawer = Drawer;

  //initialize the Drawer objects
  var drawer = document.getElementsByClassName('js-drawer');
  if( drawer.length > 0 ) {
    for( var i = 0; i < drawer.length; i++) {
      (function(i){new Drawer(drawer[i]);})(i);
    }
  }
}());