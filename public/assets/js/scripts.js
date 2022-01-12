// Utility function
function Util () {};

/* 
	class manipulation functions
*/
Util.hasClass = function(el, className) {
	return el.classList.contains(className);
};

Util.addClass = function(el, className) {
	var classList = className.split(' ');
 	el.classList.add(classList[0]);
 	if (classList.length > 1) Util.addClass(el, classList.slice(1).join(' '));
};

Util.removeClass = function(el, className) {
	var classList = className.split(' ');
	el.classList.remove(classList[0]);	
	if (classList.length > 1) Util.removeClass(el, classList.slice(1).join(' '));
};

Util.toggleClass = function(el, className, bool) {
	if(bool) Util.addClass(el, className);
	else Util.removeClass(el, className);
};

Util.setAttributes = function(el, attrs) {
  for(var key in attrs) {
    el.setAttribute(key, attrs[key]);
  }
};

/* 
  DOM manipulation
*/
Util.getChildrenByClassName = function(el, className) {
  var children = el.children,
    childrenByClass = [];
  for (var i = 0; i < children.length; i++) {
    if (Util.hasClass(children[i], className)) childrenByClass.push(children[i]);
  }
  return childrenByClass;
};

Util.is = function(elem, selector) {
  if(selector.nodeType){
    return elem === selector;
  }

  var qa = (typeof(selector) === 'string' ? document.querySelectorAll(selector) : selector),
    length = qa.length,
    returnArr = [];

  while(length--){
    if(qa[length] === elem){
      return true;
    }
  }

  return false;
};

/* 
	Animate height of an element
*/
Util.setHeight = function(start, to, element, duration, cb, timeFunction) {
	var change = to - start,
	    currentTime = null;

  var animateHeight = function(timestamp){  
    if (!currentTime) currentTime = timestamp;         
    var progress = timestamp - currentTime;
    if(progress > duration) progress = duration;
    var val = parseInt((progress/duration)*change + start);
    if(timeFunction) {
      val = Math[timeFunction](progress, start, to - start, duration);
    }
    element.style.height = val+"px";
    if(progress < duration) {
        window.requestAnimationFrame(animateHeight);
    } else {
    	if(cb) cb();
    }
  };
  
  //set the height of the element before starting animation -> fix bug on Safari
  element.style.height = start+"px";
  window.requestAnimationFrame(animateHeight);
};

/* 
	Smooth Scroll
*/

Util.scrollTo = function(final, duration, cb, scrollEl) {
  var element = scrollEl || window;
  var start = element.scrollTop || document.documentElement.scrollTop,
    currentTime = null;

  if(!scrollEl) start = window.scrollY || document.documentElement.scrollTop;
      
  var animateScroll = function(timestamp){
  	if (!currentTime) currentTime = timestamp;        
    var progress = timestamp - currentTime;
    if(progress > duration) progress = duration;
    var val = Math.easeInOutQuad(progress, start, final-start, duration);
    element.scrollTo(0, val);
    if(progress < duration) {
      window.requestAnimationFrame(animateScroll);
    } else {
      cb && cb();
    }
  };

  window.requestAnimationFrame(animateScroll);
};

/* 
  Focus utility classes
*/

//Move focus to an element
Util.moveFocus = function (element) {
  if( !element ) element = document.getElementsByTagName("body")[0];
  element.focus();
  if (document.activeElement !== element) {
    element.setAttribute('tabindex','-1');
    element.focus();
  }
};

/* 
  Misc
*/

Util.getIndexInArray = function(array, el) {
  return Array.prototype.indexOf.call(array, el);
};

Util.cssSupports = function(property, value) {
  if('CSS' in window) {
    return CSS.supports(property, value);
  } else {
    var jsProperty = property.replace(/-([a-z])/g, function (g) { return g[1].toUpperCase();});
    return jsProperty in document.body.style;
  }
};

// merge a set of user options into plugin defaults
// https://gomakethings.com/vanilla-javascript-version-of-jquery-extend/
Util.extend = function() {
  // Variables
  var extended = {};
  var deep = false;
  var i = 0;
  var length = arguments.length;

  // Check if a deep merge
  if ( Object.prototype.toString.call( arguments[0] ) === '[object Boolean]' ) {
    deep = arguments[0];
    i++;
  }

  // Merge the object into the extended object
  var merge = function (obj) {
    for ( var prop in obj ) {
      if ( Object.prototype.hasOwnProperty.call( obj, prop ) ) {
        // If deep merge and property is an object, merge properties
        if ( deep && Object.prototype.toString.call(obj[prop]) === '[object Object]' ) {
          extended[prop] = extend( true, extended[prop], obj[prop] );
        } else {
          extended[prop] = obj[prop];
        }
      }
    }
  };

  // Loop through each object and conduct a merge
  for ( ; i < length; i++ ) {
    var obj = arguments[i];
    merge(obj);
  }

  return extended;
};

// Check if Reduced Motion is enabled
Util.osHasReducedMotion = function() {
  if(!window.matchMedia) return false;
  var matchMediaObj = window.matchMedia('(prefers-reduced-motion: reduce)');
  if(matchMediaObj) return matchMediaObj.matches;
  return false; // return false if not supported
}; 

/* 
	Polyfills
*/
//Closest() method
if (!Element.prototype.matches) {
	Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
}

if (!Element.prototype.closest) {
	Element.prototype.closest = function(s) {
		var el = this;
		if (!document.documentElement.contains(el)) return null;
		do {
			if (el.matches(s)) return el;
			el = el.parentElement || el.parentNode;
		} while (el !== null && el.nodeType === 1); 
		return null;
	};
}

//Custom Event() constructor
if ( typeof window.CustomEvent !== "function" ) {

  function CustomEvent ( event, params ) {
    params = params || { bubbles: false, cancelable: false, detail: undefined };
    var evt = document.createEvent( 'CustomEvent' );
    evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
    return evt;
   }

  CustomEvent.prototype = window.Event.prototype;

  window.CustomEvent = CustomEvent;
}

/* 
	Animation curves
*/
Math.easeInOutQuad = function (t, b, c, d) {
	t /= d/2;
	if (t < 1) return c/2*t*t + b;
	t--;
	return -c/2 * (t*(t-2) - 1) + b;
};

Math.easeInQuart = function (t, b, c, d) {
	t /= d;
	return c*t*t*t*t + b;
};

Math.easeOutQuart = function (t, b, c, d) { 
  t /= d;
	t--;
	return -c * (t*t*t*t - 1) + b;
};

Math.easeInOutQuart = function (t, b, c, d) {
	t /= d/2;
	if (t < 1) return c/2*t*t*t*t + b;
	t -= 2;
	return -c/2 * (t*t*t*t - 2) + b;
};

Math.easeOutElastic = function (t, b, c, d) {
  var s=1.70158;var p=d*0.7;var a=c;
  if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
  if (a < Math.abs(c)) { a=c; var s=p/4; }
  else var s = p/(2*Math.PI) * Math.asin (c/a);
  return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
};


/* JS Utility Classes */

// make focus ring visible only for keyboard navigation (i.e., tab key) 
(function() {
  var focusTab = document.getElementsByClassName('js-tab-focus'),
    shouldInit = false,
    outlineStyle = false,
    eventDetected = false;

  function detectClick() {
    if(focusTab.length > 0) {
      resetFocusStyle(false);
      window.addEventListener('keydown', detectTab);
    }
    window.removeEventListener('mousedown', detectClick);
    outlineStyle = false;
    eventDetected = true;
  };

  function detectTab(event) {
    if(event.keyCode !== 9) return;
    resetFocusStyle(true);
    window.removeEventListener('keydown', detectTab);
    window.addEventListener('mousedown', detectClick);
    outlineStyle = true;
  };

  function resetFocusStyle(bool) {
    var outlineStyle = bool ? '' : 'none';
    for(var i = 0; i < focusTab.length; i++) {
      focusTab[i].style.setProperty('outline', outlineStyle);
    }
  };

  function initFocusTabs() {
    if(shouldInit) {
      if(eventDetected) resetFocusStyle(outlineStyle);
      return;
    }
    shouldInit = focusTab.length > 0;
    window.addEventListener('mousedown', detectClick);
  };

  initFocusTabs();
  window.addEventListener('initFocusTabs', initFocusTabs);
}());

function resetFocusTabsStyle() {
  window.dispatchEvent(new CustomEvent('initFocusTabs'));
};
// File#: _1_anim-menu-btn
// Usage: codyhouse.co/license
(function() {
    var menuBtns = document.getElementsByClassName('js-anim-menu-btn');
    if( menuBtns.length > 0 ) {
      for(var i = 0; i < menuBtns.length; i++) {(function(i){
        initMenuBtn(menuBtns[i]);
      })(i);}
  
      function initMenuBtn(btn) {
        btn.addEventListener('click', function(event){	
          event.preventDefault();
          var status = !Util.hasClass(btn, 'anim-menu-btn--state-b');
          Util.toggleClass(btn, 'anim-menu-btn--state-b', status);
          // emit custom event
          var event = new CustomEvent('anim-menu-btn-clicked', {detail: status});
          btn.dispatchEvent(event);
        });
      };
    }
  }());
// File#: _1_menu
// Usage: codyhouse.co/license
(function() {
    var Menu = function(element) {
      this.element = element;
      this.elementId = this.element.getAttribute('id');
      this.menuItems = this.element.getElementsByClassName('js-menu__content');
      this.trigger = document.querySelectorAll('[aria-controls="'+this.elementId+'"]');
      this.selectedTrigger = false;
      this.menuIsOpen = false;
      this.initMenu();
      this.initMenuEvents();
    };	
  
    Menu.prototype.initMenu = function() {
      // init aria-labels
      for(var i = 0; i < this.trigger.length; i++) {
        Util.setAttributes(this.trigger[i], {'aria-expanded': 'false', 'aria-haspopup': 'true'});
      }
      // init tabindex
      for(var i = 0; i < this.menuItems.length; i++) {
        this.menuItems[i].setAttribute('tabindex', '0');
      }
    };
  
    Menu.prototype.initMenuEvents = function() {
      var self = this;
      for(var i = 0; i < this.trigger.length; i++) {(function(i){
        self.trigger[i].addEventListener('click', function(event){
          event.preventDefault();
          // if the menu had been previously opened by another trigger element -> close it first and reopen in the right position
          if(Util.hasClass(self.element, 'menu--is-visible') && self.selectedTrigger !=  self.trigger[i]) {
            self.toggleMenu(false, false); // close menu
          }
          // toggle menu
          self.selectedTrigger = self.trigger[i];
          self.toggleMenu(!Util.hasClass(self.element, 'menu--is-visible'), true);
        });
      })(i);}
      
      // keyboard events
      this.element.addEventListener('keydown', function(event) {
        // use up/down arrow to navigate list of menu items
        if( !Util.hasClass(event.target, 'js-menu__content') ) return;
        if( (event.keyCode && event.keyCode == 40) || (event.key && event.key.toLowerCase() == 'arrowdown') ) {
          self.navigateItems(event, 'next');
        } else if( (event.keyCode && event.keyCode == 38) || (event.key && event.key.toLowerCase() == 'arrowup') ) {
          self.navigateItems(event, 'prev');
        }
      });
    };
  
    Menu.prototype.toggleMenu = function(bool, moveFocus) {
      var self = this;
      // toggle menu visibility
      Util.toggleClass(this.element, 'menu--is-visible', bool);
      this.menuIsOpen = bool;
      if(bool) {
        this.selectedTrigger.setAttribute('aria-expanded', 'true');
        Util.moveFocus(this.menuItems[0]);
        this.element.addEventListener("transitionend", function(event) {Util.moveFocus(self.menuItems[0]);}, {once: true});
        // position the menu element
        this.positionMenu();
        // add class to menu trigger
        Util.addClass(this.selectedTrigger, 'menu-control--active');
      } else if(this.selectedTrigger) {
        this.selectedTrigger.setAttribute('aria-expanded', 'false');
        if(moveFocus) Util.moveFocus(this.selectedTrigger);
        // remove class from menu trigger
        Util.removeClass(this.selectedTrigger, 'menu-control--active');
        this.selectedTrigger = false;
      }
    };
  
    Menu.prototype.positionMenu = function(event, direction) {
      var selectedTriggerPosition = this.selectedTrigger.getBoundingClientRect(),
        menuOnTop = (window.innerHeight - selectedTriggerPosition.bottom) < selectedTriggerPosition.top;
        // menuOnTop = window.innerHeight < selectedTriggerPosition.bottom + this.element.offsetHeight;
        
      var left = selectedTriggerPosition.left,
        right = (window.innerWidth - selectedTriggerPosition.right),
        isRight = (window.innerWidth < selectedTriggerPosition.left + this.element.offsetWidth);
  
      var horizontal = isRight ? 'right: '+right+'px;' : 'left: '+left+'px;',
        vertical = menuOnTop
          ? 'bottom: '+(window.innerHeight - selectedTriggerPosition.top)+'px;'
          : 'top: '+selectedTriggerPosition.bottom+'px;';
      // check right position is correct -> otherwise set left to 0
      if( isRight && (right + this.element.offsetWidth) > window.innerWidth) horizontal = 'left: '+ parseInt((window.innerWidth - this.element.offsetWidth)/2)+'px;';
      var maxHeight = menuOnTop ? selectedTriggerPosition.top - 20 : window.innerHeight - selectedTriggerPosition.bottom - 20;
      this.element.setAttribute('style', horizontal + vertical +'max-height:'+Math.floor(maxHeight)+'px;');
    };
  
    Menu.prototype.navigateItems = function(event, direction) {
      event.preventDefault();
      var index = Util.getIndexInArray(this.menuItems, event.target),
        nextIndex = direction == 'next' ? index + 1 : index - 1;
      if(nextIndex < 0) nextIndex = this.menuItems.length - 1;
      if(nextIndex > this.menuItems.length - 1) nextIndex = 0;
      Util.moveFocus(this.menuItems[nextIndex]);
    };
  
    Menu.prototype.checkMenuFocus = function() {
      var menuParent = document.activeElement.closest('.js-menu');
      if (!menuParent || !this.element.contains(menuParent)) this.toggleMenu(false, false);
    };
  
    Menu.prototype.checkMenuClick = function(target) {
      if( !this.element.contains(target) && !target.closest('[aria-controls="'+this.elementId+'"]')) this.toggleMenu(false);
    };
  
    window.Menu = Menu;
  
    //initialize the Menu objects
    var menus = document.getElementsByClassName('js-menu');
    if( menus.length > 0 ) {
      var menusArray = [];
      var scrollingContainers = [];
      for( var i = 0; i < menus.length; i++) {
        (function(i){
          menusArray.push(new Menu(menus[i]));
          var scrollableElement = menus[i].getAttribute('data-scrollable-element');
          if(scrollableElement && !scrollingContainers.includes(scrollableElement)) scrollingContainers.push(scrollableElement);
        })(i);
      }
  
      // listen for key events
      window.addEventListener('keyup', function(event){
        if( event.keyCode && event.keyCode == 9 || event.key && event.key.toLowerCase() == 'tab' ) {
          //close menu if focus is outside menu element
          menusArray.forEach(function(element){
            element.checkMenuFocus();
          });
        } else if( event.keyCode && event.keyCode == 27 || event.key && event.key.toLowerCase() == 'escape' ) {
          // close menu on 'Esc'
          menusArray.forEach(function(element){
            element.toggleMenu(false, false);
          });
        } 
      });
      // close menu when clicking outside it
      window.addEventListener('click', function(event){
        menusArray.forEach(function(element){
          element.checkMenuClick(event.target);
        });
      });
      // on resize -> close all menu elements
      window.addEventListener('resize', function(event){
        menusArray.forEach(function(element){
          element.toggleMenu(false, false);
        });
      });
      // on scroll -> close all menu elements
      window.addEventListener('scroll', function(event){
        menusArray.forEach(function(element){
          if(element.menuIsOpen) element.toggleMenu(false, false);
        });
      });
      // take into account additinal scrollable containers
      for(var j = 0; j < scrollingContainers.length; j++) {
        var scrollingContainer = document.querySelector(scrollingContainers[j]);
        if(scrollingContainer) {
          scrollingContainer.addEventListener('scroll', function(event){
            menusArray.forEach(function(element){
              if(element.menuIsOpen) element.toggleMenu(false, false);
            });
          });
        }
      }
    }
  }());
// File#: _1_modal-window
// Usage: codyhouse.co/license
(function() {
    var Modal = function(element) {
      this.element = element;
      this.triggers = document.querySelectorAll('[aria-controls="'+this.element.getAttribute('id')+'"]');
      this.firstFocusable = null;
      this.lastFocusable = null;
      this.moveFocusEl = null; // focus will be moved to this element when modal is open
      this.modalFocus = this.element.getAttribute('data-modal-first-focus') ? this.element.querySelector(this.element.getAttribute('data-modal-first-focus')) : null;
      this.selectedTrigger = null;
      this.preventScrollEl = this.getPreventScrollEl();
      this.showClass = "modal--is-visible";
      this.initModal();
    };
  
    Modal.prototype.getPreventScrollEl = function() {
      var scrollEl = false;
      var querySelector = this.element.getAttribute('data-modal-prevent-scroll');
      if(querySelector) scrollEl = document.querySelector(querySelector);
      return scrollEl;
    };
  
    Modal.prototype.initModal = function() {
      var self = this;
      //open modal when clicking on trigger buttons
      if ( this.triggers ) {
        for(var i = 0; i < this.triggers.length; i++) {
          this.triggers[i].addEventListener('click', function(event) {
            event.preventDefault();
            if(Util.hasClass(self.element, self.showClass)) {
              self.closeModal();
              return;
            }
            self.selectedTrigger = event.target;
            self.showModal();
            self.initModalEvents();
          });
        }
      }
  
      // listen to the openModal event -> open modal without a trigger button
      this.element.addEventListener('openModal', function(event){
        if(event.detail) self.selectedTrigger = event.detail;
        self.showModal();
        self.initModalEvents();
      });
  
      // listen to the closeModal event -> close modal without a trigger button
      this.element.addEventListener('closeModal', function(event){
        if(event.detail) self.selectedTrigger = event.detail;
        self.closeModal();
      });
  
      // if modal is open by default -> initialise modal events
      if(Util.hasClass(this.element, this.showClass)) this.initModalEvents();
    };
  
    Modal.prototype.showModal = function() {
      var self = this;
      Util.addClass(this.element, this.showClass);
      this.getFocusableElements();
      if(this.moveFocusEl) {
        this.moveFocusEl.focus();
        // wait for the end of transitions before moving focus
        this.element.addEventListener("transitionend", function cb(event) {
          self.moveFocusEl.focus();
          self.element.removeEventListener("transitionend", cb);
        });
      }
      this.emitModalEvents('modalIsOpen');
      // change the overflow of the preventScrollEl
      if(this.preventScrollEl) this.preventScrollEl.style.overflow = 'hidden';
    };
  
    Modal.prototype.closeModal = function() {
      if(!Util.hasClass(this.element, this.showClass)) return;
      console.log('close')
      Util.removeClass(this.element, this.showClass);
      this.firstFocusable = null;
      this.lastFocusable = null;
      this.moveFocusEl = null;
      if(this.selectedTrigger) this.selectedTrigger.focus();
      //remove listeners
      this.cancelModalEvents();
      this.emitModalEvents('modalIsClose');
      // change the overflow of the preventScrollEl
      if(this.preventScrollEl) this.preventScrollEl.style.overflow = '';
    };
  
    Modal.prototype.initModalEvents = function() {
      //add event listeners
      this.element.addEventListener('keydown', this);
      this.element.addEventListener('click', this);
    };
  
    Modal.prototype.cancelModalEvents = function() {
      //remove event listeners
      this.element.removeEventListener('keydown', this);
      this.element.removeEventListener('click', this);
    };
  
    Modal.prototype.handleEvent = function (event) {
      switch(event.type) {
        case 'click': {
          this.initClick(event);
        }
        case 'keydown': {
          this.initKeyDown(event);
        }
      }
    };
  
    Modal.prototype.initKeyDown = function(event) {
      if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
        //trap focus inside modal
        this.trapFocus(event);
      } else if( (event.keyCode && event.keyCode == 13 || event.key && event.key == 'Enter') && event.target.closest('.js-modal__close')) {
        event.preventDefault();
        this.closeModal(); // close modal when pressing Enter on close button
      }	
    };
  
    Modal.prototype.initClick = function(event) {
      //close modal when clicking on close button or modal bg layer 
      if( !event.target.closest('.js-modal__close') && !Util.hasClass(event.target, 'js-modal') ) return;
      event.preventDefault();
      this.closeModal();
    };
  
    Modal.prototype.trapFocus = function(event) {
      if( this.firstFocusable == document.activeElement && event.shiftKey) {
        //on Shift+Tab -> focus last focusable element when focus moves out of modal
        event.preventDefault();
        this.lastFocusable.focus();
      }
      if( this.lastFocusable == document.activeElement && !event.shiftKey) {
        //on Tab -> focus first focusable element when focus moves out of modal
        event.preventDefault();
        this.firstFocusable.focus();
      }
    }
  
    Modal.prototype.getFocusableElements = function() {
      //get all focusable elements inside the modal
      var allFocusable = this.element.querySelectorAll(focusableElString);
      this.getFirstVisible(allFocusable);
      this.getLastVisible(allFocusable);
      this.getFirstFocusable();
    };
  
    Modal.prototype.getFirstVisible = function(elements) {
      //get first visible focusable element inside the modal
      for(var i = 0; i < elements.length; i++) {
        if( isVisible(elements[i]) ) {
          this.firstFocusable = elements[i];
          break;
        }
      }
    };
  
    Modal.prototype.getLastVisible = function(elements) {
      //get last visible focusable element inside the modal
      for(var i = elements.length - 1; i >= 0; i--) {
        if( isVisible(elements[i]) ) {
          this.lastFocusable = elements[i];
          break;
        }
      }
    };
  
    Modal.prototype.getFirstFocusable = function() {
      if(!this.modalFocus || !Element.prototype.matches) {
        this.moveFocusEl = this.firstFocusable;
        return;
      }
      var containerIsFocusable = this.modalFocus.matches(focusableElString);
      if(containerIsFocusable) {
        this.moveFocusEl = this.modalFocus;
      } else {
        this.moveFocusEl = false;
        var elements = this.modalFocus.querySelectorAll(focusableElString);
        for(var i = 0; i < elements.length; i++) {
          if( isVisible(elements[i]) ) {
            this.moveFocusEl = elements[i];
            break;
          }
        }
        if(!this.moveFocusEl) this.moveFocusEl = this.firstFocusable;
      }
    };
  
    Modal.prototype.emitModalEvents = function(eventName) {
      var event = new CustomEvent(eventName, {detail: this.selectedTrigger});
      this.element.dispatchEvent(event);
    };
  
    function isVisible(element) {
      return element.offsetWidth || element.offsetHeight || element.getClientRects().length;
    };
  
    window.Modal = Modal;
  
    //initialize the Modal objects
    var modals = document.getElementsByClassName('js-modal');
    // generic focusable elements string selector
    var focusableElString = '[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable], audio[controls], video[controls], summary';
    if( modals.length > 0 ) {
      var modalArrays = [];
      for( var i = 0; i < modals.length; i++) {
        (function(i){modalArrays.push(new Modal(modals[i]));})(i);
      }
  
      window.addEventListener('keydown', function(event){ //close modal window on esc
        if(event.keyCode && event.keyCode == 27 || event.key && event.key.toLowerCase() == 'escape') {
          for( var i = 0; i < modalArrays.length; i++) {
            (function(i){modalArrays[i].closeModal();})(i);
          };
        }
      });
    }
  }());
// File#: _1_side-navigation
// Usage: codyhouse.co/license
(function() {
    function initSideNav(nav) {
      nav.addEventListener('click', function(event){
        var btn = event.target.closest('.js-sidenav__sublist-control');
        if(!btn) return;
        var listItem = btn.parentElement,
          bool = Util.hasClass(listItem, 'sidenav__item--expanded');
        btn.setAttribute('aria-expanded', !bool);
        Util.toggleClass(listItem, 'sidenav__item--expanded', !bool);
      });
    };
  
    var sideNavs = document.getElementsByClassName('js-sidenav');
    if( sideNavs.length > 0 ) {
      for( var i = 0; i < sideNavs.length; i++) {
        (function(i){initSideNav(sideNavs[i]);})(i);
      }
    }
  }());
// File#: _2_flexi-header
// Usage: codyhouse.co/license
(function() {
    var flexHeader = document.getElementsByClassName('js-f-header');
    if(flexHeader.length > 0) {
      var menuTrigger = flexHeader[0].getElementsByClassName('js-anim-menu-btn')[0],
        firstFocusableElement = getMenuFirstFocusable();
  
      // we'll use these to store the node that needs to receive focus when the mobile menu is closed 
      var focusMenu = false;
  
      resetFlexHeaderOffset();
      setAriaButtons();
  
      menuTrigger.addEventListener('anim-menu-btn-clicked', function(event){
        toggleMenuNavigation(event.detail);
      });
  
      // listen for key events
      window.addEventListener('keyup', function(event){
        // listen for esc key
        if( (event.keyCode && event.keyCode == 27) || (event.key && event.key.toLowerCase() == 'escape' )) {
          // close navigation on mobile if open
          if(menuTrigger.getAttribute('aria-expanded') == 'true' && isVisible(menuTrigger)) {
            focusMenu = menuTrigger; // move focus to menu trigger when menu is close
            menuTrigger.click();
          }
        }
        // listen for tab key
        if( (event.keyCode && event.keyCode == 9) || (event.key && event.key.toLowerCase() == 'tab' )) {
          // close navigation on mobile if open when nav loses focus
          if(menuTrigger.getAttribute('aria-expanded') == 'true' && isVisible(menuTrigger) && !document.activeElement.closest('.js-f-header')) menuTrigger.click();
        }
      });
  
      // detect click on a dropdown control button - expand-on-mobile only
      flexHeader[0].addEventListener('click', function(event){
        var btnLink = event.target.closest('.js-f-header__dropdown-control');
        if(!btnLink) return;
        !btnLink.getAttribute('aria-expanded') ? btnLink.setAttribute('aria-expanded', 'true') : btnLink.removeAttribute('aria-expanded');
      });
  
      // detect mouseout from a dropdown control button - expand-on-mobile only
      flexHeader[0].addEventListener('mouseout', function(event){
        var btnLink = event.target.closest('.js-f-header__dropdown-control');
        if(!btnLink) return;
        // check layout type
        if(getLayout() == 'mobile') return;
        btnLink.removeAttribute('aria-expanded');
      });
  
      // close dropdown on focusout - expand-on-mobile only
      flexHeader[0].addEventListener('focusin', function(event){
        var btnLink = event.target.closest('.js-f-header__dropdown-control'),
          dropdown = event.target.closest('.f-header__dropdown');
        if(dropdown) return;
        if(btnLink && btnLink.hasAttribute('aria-expanded')) return;
        // check layout type
        if(getLayout() == 'mobile') return;
        var openDropdown = flexHeader[0].querySelector('.js-f-header__dropdown-control[aria-expanded="true"]');
        if(openDropdown) openDropdown.removeAttribute('aria-expanded');
      });
  
      // listen for resize
      var resizingId = false;
      window.addEventListener('resize', function() {
        clearTimeout(resizingId);
        resizingId = setTimeout(doneResizing, 500);
      });
  
      function getMenuFirstFocusable() {
        var focusableEle = flexHeader[0].getElementsByClassName('f-header__nav')[0].querySelectorAll('[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable], audio[controls], video[controls], summary'),
          firstFocusable = false;
        for(var i = 0; i < focusableEle.length; i++) {
          if( focusableEle[i].offsetWidth || focusableEle[i].offsetHeight || focusableEle[i].getClientRects().length ) {
            firstFocusable = focusableEle[i];
            break;
          }
        }
  
        return firstFocusable;
      };
      
      function isVisible(element) {
        return (element.offsetWidth || element.offsetHeight || element.getClientRects().length);
      };
  
      function doneResizing() {
        if( !isVisible(menuTrigger) && Util.hasClass(flexHeader[0], 'f-header--expanded')) {
          menuTrigger.click();
        }
        resetFlexHeaderOffset();
      };
      
      function toggleMenuNavigation(bool) { // toggle menu visibility on small devices
        Util.toggleClass(document.getElementsByClassName('f-header__nav')[0], 'f-header__nav--is-visible', bool);
        Util.toggleClass(flexHeader[0], 'f-header--expanded', bool);
        menuTrigger.setAttribute('aria-expanded', bool);
        if(bool) firstFocusableElement.focus(); // move focus to first focusable element
        else if(focusMenu) {
          focusMenu.focus();
          focusMenu = false;
        }
      };
  
      function resetFlexHeaderOffset() {
        // on mobile -> update max height of the flexi header based on its offset value (e.g., if there's a fixed pre-header element)
        document.documentElement.style.setProperty('--f-header-offset', flexHeader[0].getBoundingClientRect().top+'px');
      };
  
      function setAriaButtons() {
        var btnDropdown = flexHeader[0].getElementsByClassName('js-f-header__dropdown-control');
        for(var i = 0; i < btnDropdown.length; i++) {
          var id = 'f-header-dropdown-'+i,
            dropdown = btnDropdown[i].nextElementSibling;
          if(dropdown.hasAttribute('id')) {
            id = dropdown.getAttribute('id');
          } else {
            dropdown.setAttribute('id', id);
          }
          btnDropdown[i].setAttribute('aria-controls', id);	
        }
      };
  
      function getLayout() {
        return getComputedStyle(flexHeader[0], ':before').getPropertyValue('content').replace(/\'|"/g, '');
      };
    }
  }());
// File#: _2_menu-bar
// Usage: codyhouse.co/license
(function() {
    var MenuBar = function(element) {
      this.element = element;
      this.items = Util.getChildrenByClassName(this.element, 'menu-bar__item');
      this.mobHideItems = this.element.getElementsByClassName('menu-bar__item--hide');
      this.moreItemsTrigger = this.element.getElementsByClassName('js-menu-bar__trigger');
      initMenuBar(this);
    };
  
    function initMenuBar(menu) {
      setMenuTabIndex(menu); // set correct tabindexes for menu item
      initMenuBarMarkup(menu); // create additional markup
      checkMenuLayout(menu); // set menu layout
      Util.addClass(menu.element, 'menu-bar--loaded'); // reveal menu
  
      // custom event emitted when window is resized
      menu.element.addEventListener('update-menu-bar', function(event){
        checkMenuLayout(menu);
        if(menu.menuInstance) menu.menuInstance.toggleMenu(false, false); // close dropdown
      });
  
      // keyboard events 
      // open dropdown when pressing Enter on trigger element
      if(menu.moreItemsTrigger.length > 0) {
        menu.moreItemsTrigger[0].addEventListener('keydown', function(event) {
          if( (event.keyCode && event.keyCode == 13) || (event.key && event.key.toLowerCase() == 'enter') ) {
            if(!menu.menuInstance) return;
            menu.menuInstance.selectedTrigger = menu.moreItemsTrigger[0];
            menu.menuInstance.toggleMenu(!Util.hasClass(menu.subMenu, 'menu--is-visible'), true);
          }
        });
  
        // close dropdown on esc
        menu.subMenu.addEventListener('keydown', function(event) {
          if((event.keyCode && event.keyCode == 27) || (event.key && event.key.toLowerCase() == 'escape')) { // close submenu on esc
            if(menu.menuInstance) menu.menuInstance.toggleMenu(false, true);
          }
        });
      }
      
      // navigate menu items using left/right arrows
      menu.element.addEventListener('keydown', function(event) {
        if( (event.keyCode && event.keyCode == 39) || (event.key && event.key.toLowerCase() == 'arrowright') ) {
          navigateItems(menu.items, event, 'next');
        } else if( (event.keyCode && event.keyCode == 37) || (event.key && event.key.toLowerCase() == 'arrowleft') ) {
          navigateItems(menu.items, event, 'prev');
        }
      });
    };
  
    function setMenuTabIndex(menu) { // set tabindexes for the menu items to allow keyboard navigation
      var nextItem = false;
      for(var i = 0; i < menu.items.length; i++ ) {
        if(i == 0 || nextItem) menu.items[i].setAttribute('tabindex', '0');
        else menu.items[i].setAttribute('tabindex', '-1');
        if(i == 0 && menu.moreItemsTrigger.length > 0) nextItem = true;
        else nextItem = false;
      }
    };
  
    function initMenuBarMarkup(menu) {
      if(menu.mobHideItems.length == 0 ) { // no items to hide on mobile - remove trigger
        if(menu.moreItemsTrigger.length > 0) menu.element.removeChild(menu.moreItemsTrigger[0]);
        return;
      }
  
      if(menu.moreItemsTrigger.length == 0) return;
  
      // create the markup for the Menu element
      var content = '';
      menu.menuControlId = 'submenu-bar-'+Date.now();
      for(var i = 0; i < menu.mobHideItems.length; i++) {
        var item = menu.mobHideItems[i].cloneNode(true),
          svg = item.getElementsByTagName('svg')[0],
          label = item.getElementsByClassName('menu-bar__label')[0];
  
        svg.setAttribute('class', 'icon menu__icon');
        content = content + '<li role="menuitem"><span class="menu__content js-menu__content">'+svg.outerHTML+'<span>'+label.innerHTML+'</span></span></li>';
      }
  
      Util.setAttributes(menu.moreItemsTrigger[0], {'role': 'button', 'aria-expanded': 'false', 'aria-controls': menu.menuControlId, 'aria-haspopup': 'true'});
  
      var subMenu = document.createElement('menu'),
        customClass = menu.element.getAttribute('data-menu-class');
      Util.setAttributes(subMenu, {'id': menu.menuControlId, 'class': 'menu js-menu '+customClass});
      subMenu.innerHTML = content;
      document.body.appendChild(subMenu);
  
      menu.subMenu = subMenu;
      menu.subItems = subMenu.getElementsByTagName('li');
  
      menu.menuInstance = new Menu(menu.subMenu); // this will handle the dropdown behaviour
    };
  
    function checkMenuLayout(menu) { // switch from compressed to expanded layout and viceversa
      var layout = getComputedStyle(menu.element, ':before').getPropertyValue('content').replace(/\'|"/g, '');
      Util.toggleClass(menu.element, 'menu-bar--collapsed', layout == 'collapsed');
    };
  
    function navigateItems(list, event, direction, prevIndex) { // keyboard navigation among menu items
      event.preventDefault();
      var index = (typeof prevIndex !== 'undefined') ? prevIndex : Util.getIndexInArray(list, event.target),
        nextIndex = direction == 'next' ? index + 1 : index - 1;
      if(nextIndex < 0) nextIndex = list.length - 1;
      if(nextIndex > list.length - 1) nextIndex = 0;
      // check if element is visible before moving focus
      (list[nextIndex].offsetParent === null) ? navigateItems(list, event, direction, nextIndex) : Util.moveFocus(list[nextIndex]);
    };
  
    function checkMenuClick(menu, target) { // close dropdown when clicking outside the menu element
      if(menu.menuInstance && !menu.moreItemsTrigger[0].contains(target) && !menu.subMenu.contains(target)) menu.menuInstance.toggleMenu(false, false);
    };
  
    // init MenuBars objects
    var menuBars = document.getElementsByClassName('js-menu-bar');
    if( menuBars.length > 0 ) {
      var j = 0,
        menuBarArray = [];
      for( var i = 0; i < menuBars.length; i++) {
        var beforeContent = getComputedStyle(menuBars[i], ':before').getPropertyValue('content');
        if(beforeContent && beforeContent !='' && beforeContent !='none') {
          (function(i){menuBarArray.push(new MenuBar(menuBars[i]));})(i);
          j = j + 1;
        }
      }
      
      if(j > 0) {
        var resizingId = false,
          customEvent = new CustomEvent('update-menu-bar');
        // update Menu Bar layout on resize  
        window.addEventListener('resize', function(event){
          clearTimeout(resizingId);
          resizingId = setTimeout(doneResizing, 150);
        });
  
        // close menu when clicking outside it
        window.addEventListener('click', function(event){
          menuBarArray.forEach(function(element){
            checkMenuClick(element, event.target);
          });
        });
  
        function doneResizing() {
          for( var i = 0; i < menuBars.length; i++) {
            (function(i){menuBars[i].dispatchEvent(customEvent)})(i);
          };
        };
      }
    }
  }());
// File#: _3_interactive-table
// Usage: codyhouse.co/license
(function() {
    var IntTable = function(element) {
      this.element = element;
      this.header = this.element.getElementsByClassName('js-int-table__header')[0];
      this.headerCols = this.header.getElementsByTagName('tr')[0].children;
      this.body = this.element.getElementsByClassName('js-int-table__body')[0];
      this.sortingRows = this.element.getElementsByClassName('js-int-table__sort-row');
      initIntTable(this);
    };
  
    function initIntTable(table) {
      // check if table has actions
      initIntTableActions(table);
      // check if there are checkboxes to select/deselect a row/all rows
      var selectAll = table.element.getElementsByClassName('js-int-table__select-all');
      if(selectAll.length > 0) initIntTableSelection(table, selectAll);
      // check if there are sortable columns
      table.sortableCols = table.element.getElementsByClassName('js-int-table__cell--sort');
      if(table.sortableCols.length > 0) {
        // add a data-order attribute to all rows so that we can reset the order
        setDataRowOrder(table);
        // listen to the click event on a sortable column
        table.header.addEventListener('click', function(event){
          var selectedCol = event.target.closest('.js-int-table__cell--sort');
          if(!selectedCol || event.target.tagName.toLowerCase() == 'input') return;
          sortColumns(table, selectedCol);
        });
        table.header.addEventListener('change', function(event){ // detect change in selected checkbox (SR only)
          var selectedCol = event.target.closest('.js-int-table__cell--sort');
          if(!selectedCol) return;
          sortColumns(table, selectedCol, event.target.value);
        });
        table.header.addEventListener('keydown', function(event){ // keyboard navigation - change sorting on enter
          if( event.keyCode && event.keyCode == 13 || event.key && event.key.toLowerCase() == 'enter') {
            var selectedCol = event.target.closest('.js-int-table__cell--sort');
            if(!selectedCol) return;
            sortColumns(table, selectedCol);
          }
        });
  
        // change cell style when in focus
        table.header.addEventListener('focusin', function(event){
          var closestCell = document.activeElement.closest('.js-int-table__cell--sort');
          if(closestCell) Util.addClass(closestCell, 'int-table__cell--focus');
        });
        table.header.addEventListener('focusout', function(event){
          for(var i = 0; i < table.sortableCols.length; i++) {
            Util.removeClass(table.sortableCols[i], 'int-table__cell--focus');
          }
        });
      }
    };
  
    function initIntTableActions(table) {
      // check if table has actions and store them
      var tableId = table.element.getAttribute('id');
      if(!tableId) return;
      var tableActions = document.querySelector('[data-table-controls="'+tableId+'"]');
      if(!tableActions) return;
      table.actionsSelection = tableActions.getElementsByClassName('js-int-table-actions__items-selected');
      table.actionsNoSelection = tableActions.getElementsByClassName('js-int-table-actions__no-items-selected');
    };
  
    function initIntTableSelection(table, select) { // checkboxes for rows selection
      table.selectAll = select[0];
      table.selectRow = table.element.getElementsByClassName('js-int-table__select-row');
      // select/deselect all rows
      table.selectAll.addEventListener('click', function(event){ // we cannot use the 'change' event as on IE/Edge the change from "indeterminate" to either "checked" or "unchecked"  does not trigger that event
        toggleRowSelection(table);
      });
      // select/deselect single row - reset all row selector 
      table.body.addEventListener('change', function(event){
        if(!event.target.closest('.js-int-table__select-row')) return;
        toggleAllSelection(table);
      });
      // toggle actions
      toggleActions(table, table.element.getElementsByClassName('int-table__row--checked').length > 0);
    };
  
    function toggleRowSelection(table) { // 'Select All Rows' checkbox has been selected/deselected
      var status = table.selectAll.checked;
      for(var i = 0; i < table.selectRow.length; i++) {
        table.selectRow[i].checked = status;
        Util.toggleClass(table.selectRow[i].closest('.int-table__row'), 'int-table__row--checked', status);
      }
      toggleActions(table, status);
    };
  
    function toggleAllSelection(table) { // Single row has been selected/deselected
      var allChecked = true,
        oneChecked = false;
      for(var i = 0; i < table.selectRow.length; i++) {
        if(!table.selectRow[i].checked) {allChecked = false;}
        else {oneChecked = true;}
        Util.toggleClass(table.selectRow[i].closest('.int-table__row'), 'int-table__row--checked', table.selectRow[i].checked);
      }
      table.selectAll.checked = oneChecked;
      // if status if false but one input is checked -> set an indeterminate state for the 'Select All' checkbox
      if(!allChecked) {
        table.selectAll.indeterminate = oneChecked;
      } else if(allChecked && oneChecked) {
        table.selectAll.indeterminate = false;
      }
      toggleActions(table, oneChecked);
    };
  
    function setDataRowOrder(table) { // add a data-order to rows element - will be used when resetting the sorting 
      var rowsArray = table.body.getElementsByTagName('tr');
      for(var i = 0; i < rowsArray.length; i++) {
        rowsArray[i].setAttribute('data-order', i);
      }
    };
  
    function sortColumns(table, selectedCol, customOrder) {
      // determine sorting order (asc/desc/reset)
      var order = customOrder || getSortingOrder(selectedCol),
        colIndex = Util.getIndexInArray(table.headerCols, selectedCol);
      // sort table
      sortTableContent(table, order, colIndex, selectedCol);
      
      // reset appearance of the th column that was previously sorted (if any) 
      for(var i = 0; i < table.headerCols.length; i++) {
        Util.removeClass(table.headerCols[i], 'int-table__cell--asc int-table__cell--desc');
      }
      // reset appearance for the selected th column
      if(order == 'asc') Util.addClass(selectedCol, 'int-table__cell--asc');
      if(order == 'desc') Util.addClass(selectedCol, 'int-table__cell--desc');
      // reset checkbox selection
      if(!customOrder) selectedCol.querySelector('input[value="'+order+'"]').checked = true;
    };
  
    function getSortingOrder(selectedCol) { // determine sorting order
      if( Util.hasClass(selectedCol, 'int-table__cell--asc') ) return 'desc';
      if( Util.hasClass(selectedCol, 'int-table__cell--desc') ) return 'none';
      return 'asc';
    };
  
    function sortTableContent(table, order, index, selctedCol) { // determine the new order of the rows
      var rowsArray = table.body.getElementsByTagName('tr'),
        switching = true,
        i = 0,
        shouldSwitch;
      while (switching) {
        switching = false;
        for (i = 0; i < rowsArray.length - 1; i++) {
          var contentOne = (order == 'none') ? rowsArray[i].getAttribute('data-order') : rowsArray[i].children[index].textContent.trim(),
            contentTwo = (order == 'none') ? rowsArray[i+1].getAttribute('data-order') : rowsArray[i+1].children[index].textContent.trim();
  
          shouldSwitch = compareValues(contentOne, contentTwo, order, selctedCol);
          if(shouldSwitch) {
            table.body.insertBefore(rowsArray[i+1], rowsArray[i]);
            switching = true;
            break;
          }
        }
      }
    };
  
    function compareValues(val1, val2, order, selctedCol) {
      var compare,
        dateComparison = selctedCol.getAttribute('data-date-format');
      if( dateComparison && order != 'none') { // comparing dates
        compare =  (order == 'asc' || order == 'none') ? parseCustomDate(val1, dateComparison) > parseCustomDate(val2, dateComparison) : parseCustomDate(val2, dateComparison) > parseCustomDate(val1, dateComparison);
      } else if( !isNaN(val1) && !isNaN(val2) ) { // comparing numbers
        compare =  (order == 'asc' || order == 'none') ? Number(val1) > Number(val2) : Number(val2) > Number(val1);
      } else { // comparing strings
        compare =  (order == 'asc' || order == 'none') 
          ? val2.toString().localeCompare(val1) < 0
          : val1.toString().localeCompare(val2) < 0;
      }
      return compare;
    };
  
    function parseCustomDate(date, format) {
      var parts = date.match(/(\d+)/g), 
        i = 0, fmt = {};
      // extract date-part indexes from the format
      format.replace(/(yyyy|dd|mm)/g, function(part) { fmt[part] = i++; });
  
      return new Date(parts[fmt['yyyy']], parts[fmt['mm']]-1, parts[fmt['dd']]);
    };
  
    function toggleActions(table, selection) {
      if(table.actionsSelection && table.actionsSelection.length > 0) {
        Util.toggleClass(table.actionsSelection[0], 'is-hidden', !selection);
      }
      if(table.actionsNoSelection && table.actionsNoSelection.length > 0) {
        Util.toggleClass(table.actionsNoSelection[0], 'is-hidden', selection);
      }
    };
  
    //initialize the IntTable objects
    var intTable = document.getElementsByClassName('js-int-table');
    if( intTable.length > 0 ) {
      for( var i = 0; i < intTable.length; i++) {
        (function(i){new IntTable(intTable[i]);})(i);
      }
    }
  }());