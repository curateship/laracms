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
// File#: _1_accordion
// Usage: codyhouse.co/license
(function() {
    var Accordion = function(element) {
      this.element = element;
      this.items = Util.getChildrenByClassName(this.element, 'js-accordion__item');
      this.version = this.element.getAttribute('data-version') ? '-'+this.element.getAttribute('data-version') : '';
      this.showClass = 'accordion'+this.version+'__item--is-open';
      this.animateHeight = (this.element.getAttribute('data-animation') == 'on');
      this.multiItems = !(this.element.getAttribute('data-multi-items') == 'off'); 
      // deep linking options
      this.deepLinkOn = this.element.getAttribute('data-deep-link') == 'on';
      // init accordion
      this.initAccordion();
    };
  
    Accordion.prototype.initAccordion = function() {
      //set initial aria attributes
      for( var i = 0; i < this.items.length; i++) {
        var button = this.items[i].getElementsByTagName('button')[0],
          content = this.items[i].getElementsByClassName('js-accordion__panel')[0],
          isOpen = Util.hasClass(this.items[i], this.showClass) ? 'true' : 'false';
        Util.setAttributes(button, {'aria-expanded': isOpen, 'aria-controls': 'accordion-content-'+i, 'id': 'accordion-header-'+i});
        Util.addClass(button, 'js-accordion__trigger');
        Util.setAttributes(content, {'aria-labelledby': 'accordion-header-'+i, 'id': 'accordion-content-'+i});
      }
  
      //listen for Accordion events
      this.initAccordionEvents();
  
      // check deep linking option
      this.initDeepLink();
    };
  
    Accordion.prototype.initAccordionEvents = function() {
      var self = this;
  
      this.element.addEventListener('click', function(event) {
        var trigger = event.target.closest('.js-accordion__trigger');
        //check index to make sure the click didn't happen inside a children accordion
        if( trigger && Util.getIndexInArray(self.items, trigger.parentElement) >= 0) self.triggerAccordion(trigger);
      });
    };
  
    Accordion.prototype.triggerAccordion = function(trigger) {
      var bool = (trigger.getAttribute('aria-expanded') === 'true');
  
      this.animateAccordion(trigger, bool, false);
  
      if(!bool && this.deepLinkOn) {
        history.replaceState(null, '', '#'+trigger.getAttribute('aria-controls'));
      }
    };
  
    Accordion.prototype.animateAccordion = function(trigger, bool, deepLink) {
      var self = this;
      var item = trigger.closest('.js-accordion__item'),
        content = item.getElementsByClassName('js-accordion__panel')[0],
        ariaValue = bool ? 'false' : 'true';
  
      if(!bool) Util.addClass(item, this.showClass);
      trigger.setAttribute('aria-expanded', ariaValue);
      self.resetContentVisibility(item, content, bool);
  
      if( !this.multiItems && !bool || deepLink) this.closeSiblings(item);
    };
  
    Accordion.prototype.resetContentVisibility = function(item, content, bool) {
      Util.toggleClass(item, this.showClass, !bool);
      content.removeAttribute("style");
      if(bool && !this.multiItems) { // accordion item has been closed -> check if there's one open to move inside viewport 
        this.moveContent();
      }
    };
  
    Accordion.prototype.closeSiblings = function(item) {
      //if only one accordion can be open -> search if there's another one open
      var index = Util.getIndexInArray(this.items, item);
      for( var i = 0; i < this.items.length; i++) {
        if(Util.hasClass(this.items[i], this.showClass) && i != index) {
          this.animateAccordion(this.items[i].getElementsByClassName('js-accordion__trigger')[0], true, false);
          return false;
        }
      }
    };
  
    Accordion.prototype.moveContent = function() { // make sure title of the accordion just opened is inside the viewport
      var openAccordion = this.element.getElementsByClassName(this.showClass);
      if(openAccordion.length == 0) return;
      var boundingRect = openAccordion[0].getBoundingClientRect();
      if(boundingRect.top < 0 || boundingRect.top > window.innerHeight) {
        var windowScrollTop = window.scrollY || document.documentElement.scrollTop;
        window.scrollTo(0, boundingRect.top + windowScrollTop);
      }
    };
  
    Accordion.prototype.initDeepLink = function() {
      if(!this.deepLinkOn) return;
      var hash = window.location.hash.substr(1);
      if(!hash || hash == '') return;
      var trigger = this.element.querySelector('.js-accordion__trigger[aria-controls="'+hash+'"]');
      if(trigger && trigger.getAttribute('aria-expanded') !== 'true') {
        this.animateAccordion(trigger, false, true);
        setTimeout(function(){trigger.scrollIntoView(true);});
      }
    };
  
    window.Accordion = Accordion;
    
    //initialize the Accordion objects
    var accordions = document.getElementsByClassName('js-accordion');
    if( accordions.length > 0 ) {
      for( var i = 0; i < accordions.length; i++) {
        (function(i){new Accordion(accordions[i]);})(i);
      }
    }
  }());
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
jQuery(document).ready(function($){
	var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;

	//open team-member bio
	$('#cd-team').find('ul a').on('click', function(event){
		event.preventDefault();
		var selected_member = $(this).data('type');
		$('.cd-member-bio.'+selected_member+'').addClass('slide-in');
		$('.cd-member-bio-close').addClass('is-visible');

		// firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
		if( is_firefox ) {
			$('main').addClass('slide-out').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('body').addClass('overflow-hidden');
			});
		} else {
			$('main').addClass('slide-out');
			$('body').addClass('overflow-hidden');
		}

	});

	//close team-member bio
	$(document).on('click', '.cd-overlay, .cd-member-bio-close', function(event){
		event.preventDefault();
		$('.cd-member-bio').removeClass('slide-in');
		$('.cd-member-bio-close').removeClass('is-visible');

		if( is_firefox ) {
			$('main').removeClass('slide-out').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('body').removeClass('overflow-hidden');
			});
		} else {
			$('main').removeClass('slide-out');
			$('body').removeClass('overflow-hidden');
		}
	});
});
// File#: _1_choice-tags
// Usage: codyhouse.co/license
(function() {
    var ChoiceTags = function(element) {
      this.element = element;
      this.labels = this.element.getElementsByClassName('js-choice-tag');
      this.inputs = getChoiceInput(this);
      this.isRadio = this.inputs[0].type.toString() == 'radio';
      this.checkedClass = 'choice-tag--checked';
      initChoiceTags(this);
      initChoiceTagEvent(this);
    }
  
    function getChoiceInput(element) {
      var inputs = [];
      for(var i = 0; i < element.labels.length; i++) {
        inputs.push(element.labels[i].getElementsByTagName('input')[0]);
      }
      return inputs;
    };
  
    function initChoiceTags(element) {
      // if tag is selected by default - add checkedClass to the label element
      for(var i = 0; i < element.inputs.length; i++) {
        Util.toggleClass(element.labels[i], element.checkedClass, element.inputs[i].checked);
      }
    };
  
    function initChoiceTagEvent(element) {
      element.element.addEventListener('change', function(event) {
        var inputIndex = Util.getIndexInArray(element.inputs, event.target);
        if(inputIndex < 0) return;
        Util.toggleClass(element.labels[inputIndex], element.checkedClass, event.target.checked);
        if(element.isRadio && event.target.checked) resetRadioTags(element, inputIndex);
      });
    };
  
    function resetRadioTags(element, index) {
      // when a radio input is checked - reset all the others
      for(var i = 0; i < element.labels.length; i++) {
        if(i != index) Util.removeClass(element.labels[i], element.checkedClass);
      }
    };
  
    //initialize the ChoiceTags objects
    var choiceTags = document.getElementsByClassName('js-choice-tags');
    if( choiceTags.length > 0 ) {
      for( var i = 0; i < choiceTags.length; i++) {
        (function(i){new ChoiceTags(choiceTags[i]);})(i);
      }
    };
  }());
// File#: _1_details
// Usage: codyhouse.co/license
(function() {
    var Details = function(element, index) {
      this.element = element;
      this.summary = this.element.getElementsByClassName('js-details__summary')[0];
      this.details = this.element.getElementsByClassName('js-details__content')[0];
      this.htmlElSupported = 'open' in this.element;
      this.initDetails(index);
      this.initDetailsEvents();
    };
  
    Details.prototype.initDetails = function(index) {
      // init aria attributes 
      Util.setAttributes(this.summary, {'aria-expanded': 'false', 'aria-controls': 'details--'+index, 'role': 'button'});
      Util.setAttributes(this.details, {'aria-hidden': 'true', 'id': 'details--'+index});
    };
  
    Details.prototype.initDetailsEvents = function() {
      var self = this;
      if( this.htmlElSupported ) { // browser supports the <details> element 
        this.element.addEventListener('toggle', function(event){
          var ariaValues = self.element.open ? ['true', 'false'] : ['false', 'true'];
          // update aria attributes when details element status change (open/close)
          self.updateAriaValues(ariaValues);
        });
      } else { //browser does not support <details>
        this.summary.addEventListener('click', function(event){
          event.preventDefault();
          var isOpen = self.element.getAttribute('open'),
            ariaValues = [];
  
          isOpen ? self.element.removeAttribute('open') : self.element.setAttribute('open', 'true');
          ariaValues = isOpen ? ['false', 'true'] : ['true', 'false'];
          self.updateAriaValues(ariaValues);
        });
      }
    };
  
    Details.prototype.updateAriaValues = function(values) {
      this.summary.setAttribute('aria-expanded', values[0]);
      this.details.setAttribute('aria-hidden', values[1]);
    };
  
    //initialize the Details objects
    var detailsEl = document.getElementsByClassName('js-details');
    if( detailsEl.length > 0 ) {
      for( var i = 0; i < detailsEl.length; i++) {
        (function(i){new Details(detailsEl[i], i);})(i);
      }
    }
  }());
// File#: _1_diagonal-movement
// Usage: codyhouse.co/license
/*
  Modified version of the jQuery-menu-aim plugin
  https://github.com/kamens/jQuery-menu-aim
  - Replaced jQuery with Vanilla JS
  - Minor changes
*/
(function() {
    var menuAim = function(opts) {
      init(opts);
    };
  
    window.menuAim = menuAim;
  
    function init(opts) {
      var activeRow = null,
        mouseLocs = [],
        lastDelayLoc = null,
        timeoutId = null,
        options = Util.extend({
          menu: '',
          rows: false, //if false, get direct children - otherwise pass nodes list 
          submenuSelector: "*",
          submenuDirection: "right",
          tolerance: 75,  // bigger = more forgivey when entering submenu
          enter: function(){},
          exit: function(){},
          activate: function(){},
          deactivate: function(){},
          exitMenu: function(){}
        }, opts),
        menu = options.menu;
  
      var MOUSE_LOCS_TRACKED = 3,  // number of past mouse locations to track
        DELAY = 300;  // ms delay when user appears to be entering submenu
  
      /**
       * Keep track of the last few locations of the mouse.
       */
      var mouseMoveFallback = function(event) {
        (!window.requestAnimationFrame) ? mousemoveDocument(event) : window.requestAnimationFrame(function(){mousemoveDocument(event);});
      };
  
      var mousemoveDocument = function(e) {
        mouseLocs.push({x: e.pageX, y: e.pageY});
  
        if (mouseLocs.length > MOUSE_LOCS_TRACKED) {
          mouseLocs.shift();
        }
      };
  
      /**
       * Cancel possible row activations when leaving the menu entirely
       */
      var mouseleaveMenu = function() {
        if (timeoutId) {
          clearTimeout(timeoutId);
        }
  
        // If exitMenu is supplied and returns true, deactivate the
        // currently active row on menu exit.
        if (options.exitMenu(this)) {
          if (activeRow) {
            options.deactivate(activeRow);
          }
  
          activeRow = null;
        }
      };
  
      /**
       * Trigger a possible row activation whenever entering a new row.
       */
      var mouseenterRow = function() {
        if (timeoutId) {
          // Cancel any previous activation delays
          clearTimeout(timeoutId);
        }
  
        options.enter(this);
        possiblyActivate(this);
      },
      mouseleaveRow = function() {
        options.exit(this);
      };
  
      /*
       * Immediately activate a row if the user clicks on it.
       */
      var clickRow = function() {
        activate(this);
      };  
  
      /**
       * Activate a menu row.
       */
      var activate = function(row) {
        if (row == activeRow) {
          return;
        }
  
        if (activeRow) {
          options.deactivate(activeRow);
        }
  
        options.activate(row);
        activeRow = row;
      };
  
      /**
       * Possibly activate a menu row. If mouse movement indicates that we
       * shouldn't activate yet because user may be trying to enter
       * a submenu's content, then delay and check again later.
       */
      var possiblyActivate = function(row) {
        var delay = activationDelay();
  
        if (delay) {
          timeoutId = setTimeout(function() {
            possiblyActivate(row);
          }, delay);
        } else {
          activate(row);
        }
      };
  
      /**
       * Return the amount of time that should be used as a delay before the
       * currently hovered row is activated.
       *
       * Returns 0 if the activation should happen immediately. Otherwise,
       * returns the number of milliseconds that should be delayed before
       * checking again to see if the row should be activated.
       */
      var activationDelay = function() {
        if (!activeRow || !Util.is(activeRow, options.submenuSelector)) {
          // If there is no other submenu row already active, then
          // go ahead and activate immediately.
          return 0;
        }
  
        function getOffset(element) {
          var rect = element.getBoundingClientRect();
          return { top: rect.top + window.pageYOffset, left: rect.left + window.pageXOffset };
        };
  
        var offset = getOffset(menu),
            upperLeft = {
                x: offset.left,
                y: offset.top - options.tolerance
            },
            upperRight = {
                x: offset.left + menu.offsetWidth,
                y: upperLeft.y
            },
            lowerLeft = {
                x: offset.left,
                y: offset.top + menu.offsetHeight + options.tolerance
            },
            lowerRight = {
                x: offset.left + menu.offsetWidth,
                y: lowerLeft.y
            },
            loc = mouseLocs[mouseLocs.length - 1],
            prevLoc = mouseLocs[0];
  
        if (!loc) {
          return 0;
        }
  
        if (!prevLoc) {
          prevLoc = loc;
        }
  
        if (prevLoc.x < offset.left || prevLoc.x > lowerRight.x || prevLoc.y < offset.top || prevLoc.y > lowerRight.y) {
          // If the previous mouse location was outside of the entire
          // menu's bounds, immediately activate.
          return 0;
        }
  
        if (lastDelayLoc && loc.x == lastDelayLoc.x && loc.y == lastDelayLoc.y) {
          // If the mouse hasn't moved since the last time we checked
          // for activation status, immediately activate.
          return 0;
        }
  
        // Detect if the user is moving towards the currently activated
        // submenu.
        //
        // If the mouse is heading relatively clearly towards
        // the submenu's content, we should wait and give the user more
        // time before activating a new row. If the mouse is heading
        // elsewhere, we can immediately activate a new row.
        //
        // We detect this by calculating the slope formed between the
        // current mouse location and the upper/lower right points of
        // the menu. We do the same for the previous mouse location.
        // If the current mouse location's slopes are
        // increasing/decreasing appropriately compared to the
        // previous's, we know the user is moving toward the submenu.
        //
        // Note that since the y-axis increases as the cursor moves
        // down the screen, we are looking for the slope between the
        // cursor and the upper right corner to decrease over time, not
        // increase (somewhat counterintuitively).
        function slope(a, b) {
          return (b.y - a.y) / (b.x - a.x);
        };
  
        var decreasingCorner = upperRight,
          increasingCorner = lowerRight;
  
        // Our expectations for decreasing or increasing slope values
        // depends on which direction the submenu opens relative to the
        // main menu. By default, if the menu opens on the right, we
        // expect the slope between the cursor and the upper right
        // corner to decrease over time, as explained above. If the
        // submenu opens in a different direction, we change our slope
        // expectations.
        if (options.submenuDirection == "left") {
          decreasingCorner = lowerLeft;
          increasingCorner = upperLeft;
        } else if (options.submenuDirection == "below") {
          decreasingCorner = lowerRight;
          increasingCorner = lowerLeft;
        } else if (options.submenuDirection == "above") {
          decreasingCorner = upperLeft;
          increasingCorner = upperRight;
        }
  
        var decreasingSlope = slope(loc, decreasingCorner),
          increasingSlope = slope(loc, increasingCorner),
          prevDecreasingSlope = slope(prevLoc, decreasingCorner),
          prevIncreasingSlope = slope(prevLoc, increasingCorner);
  
        if (decreasingSlope < prevDecreasingSlope && increasingSlope > prevIncreasingSlope) {
          // Mouse is moving from previous location towards the
          // currently activated submenu. Delay before activating a
          // new menu row, because user may be moving into submenu.
          lastDelayLoc = loc;
          return DELAY;
        }
  
        lastDelayLoc = null;
        return 0;
      };
  
      var reset = function(triggerDeactivate) {
        if (timeoutId) {
          clearTimeout(timeoutId);
        }
  
        if (activeRow && triggerDeactivate) {
          options.deactivate(activeRow);
        }
  
        activeRow = null;
      };
  
      var destroyInstance = function() {
        menu.removeEventListener('mouseleave', mouseleaveMenu);  
        document.removeEventListener('mousemove', mouseMoveFallback);
        if(rows.length > 0) {
          for(var i = 0; i < rows.length; i++) {
            rows[i].removeEventListener('mouseenter', mouseenterRow);  
            rows[i].removeEventListener('mouseleave', mouseleaveRow);
            rows[i].removeEventListener('click', clickRow);  
          }
        }
        
      };
  
      /**
       * Hook up initial menu events
       */
      menu.addEventListener('mouseleave', mouseleaveMenu);  
      var rows = (options.rows) ? options.rows : menu.children;
      if(rows.length > 0) {
        for(var i = 0; i < rows.length; i++) {(function(i){
          rows[i].addEventListener('mouseenter', mouseenterRow);  
          rows[i].addEventListener('mouseleave', mouseleaveRow);
          rows[i].addEventListener('click', clickRow);  
        })(i);}
      }
  
      document.addEventListener('mousemove', mouseMoveFallback);
  
      /* Reset/destroy menu */
      menu.addEventListener('reset', function(event){
        reset(event.detail);
      });
      menu.addEventListener('destroy', destroyInstance);
    };
  }());
  
  
// File#: _1_form-validator
// Usage: codyhouse.co/license
(function() {
    var FormValidator = function(opts) {
      this.options = Util.extend(FormValidator.defaults , opts);
      this.element = this.options.element;
      this.input = [];
      this.textarea = [];
      this.select = [];
      this.errorFields = [];
      this.errorFieldListeners = [];
      initFormValidator(this);
    };
  
    //public functions
    FormValidator.prototype.validate = function(cb) {
      validateForm(this);
      if(cb) cb(this.errorFields);
    };
  
    // private methods
    function initFormValidator(formValidator) {
      formValidator.input = formValidator.element.querySelectorAll('input');
      formValidator.textarea = formValidator.element.querySelectorAll('textarea');
      formValidator.select = formValidator.element.querySelectorAll('select');
    };
  
    function validateForm(formValidator) {
      // reset input with errors
      formValidator.errorFields = []; 
      // remove change/input events from fields with error
      resetEventListeners(formValidator);
      
      // loop through fields and push to errorFields if there are errors
      for(var i = 0; i < formValidator.input.length; i++) {
        validateField(formValidator, formValidator.input[i]);
      }
  
      for(var i = 0; i < formValidator.textarea.length; i++) {
        validateField(formValidator, formValidator.textarea[i]);
      }
  
      for(var i = 0; i < formValidator.select.length; i++) {
        validateField(formValidator, formValidator.select[i]);
      }
  
      // show errors if any was found
      for(var i = 0; i < formValidator.errorFields.length; i++) {
        showError(formValidator, formValidator.errorFields[i]);
      }
  
      // move focus to first field with error
      if(formValidator.errorFields.length > 0) formValidator.errorFields[0].focus();
    };
  
    function validateField(formValidator, field) {
      if(!field.checkValidity()) {
        formValidator.errorFields.push(field);
        return;
      }
      // check for custom functions
      var customValidate = field.getAttribute('data-validate');
      if(customValidate && formValidator.options.customValidate[customValidate]) {
        formValidator.options.customValidate[customValidate](field, function(result) {
          if(!result) formValidator.errorFields.push(field);
        });
      }
    };
  
    function showError(formValidator, field) {
      // add error classes
      toggleErrorClasses(formValidator, field, true);
  
      // add event listener
      var index = formValidator.errorFieldListeners.length;
      formValidator.errorFieldListeners[index] = function() {
        toggleErrorClasses(formValidator, field, false);
        field.removeEventListener('change', formValidator.errorFieldListeners[index]);
        field.removeEventListener('input', formValidator.errorFieldListeners[index]);
      };
      field.addEventListener('change', formValidator.errorFieldListeners[index]);
      field.addEventListener('input', formValidator.errorFieldListeners[index]);
    };
  
    function toggleErrorClasses(formValidator, field, bool) {
      bool ? Util.addClass(field, formValidator.options.inputErrorClass) : Util.removeClass(field, formValidator.options.inputErrorClass);
      if(formValidator.options.inputWrapperErrorClass) {
        var wrapper = field.closest('.js-form-validate__input-wrapper');
        if(wrapper) {
          bool ? Util.addClass(wrapper, formValidator.options.inputWrapperErrorClass) : Util.removeClass(wrapper, formValidator.options.inputWrapperErrorClass);
        }
      }
    };
  
    function resetEventListeners(formValidator) {
      for(var i = 0; i < formValidator.errorFields.length; i++) {
        toggleErrorClasses(formValidator, formValidator.errorFields[i], false);
        formValidator.errorFields[i].removeEventListener('change', formValidator.errorFieldListeners[i]);
        formValidator.errorFields[i].removeEventListener('input', formValidator.errorFieldListeners[i]);
      }
  
      formValidator.errorFields = [];
      formValidator.errorFieldListeners = [];
    };
    
    FormValidator.defaults = {
      element : '',
      inputErrorClass : 'form-control--error',
      inputWrapperErrorClass: 'form-validate__input-wrapper--error',
      customValidate: {}
    };
    window.FormValidator = FormValidator;
  }());
// File#: _1_hiding-nav
// Usage: codyhouse.co/license
(function() {
    var hidingNav = document.getElementsByClassName('js-hide-nav');
    if(hidingNav.length > 0 && window.requestAnimationFrame) {
      var mainNav = Array.prototype.filter.call(hidingNav, function(element) {
        return Util.hasClass(element, 'js-hide-nav--main');
      }),
      subNav = Array.prototype.filter.call(hidingNav, function(element) {
        return Util.hasClass(element, 'js-hide-nav--sub');
      });
      
      var scrolling = false,
        previousTop = window.scrollY,
        currentTop = window.scrollY,
        scrollDelta = 10,
        scrollOffset = 150, // scrollY needs to be bigger than scrollOffset to hide navigation
        headerHeight = 0; 
  
      var navIsFixed = false; // check if main navigation is fixed
      if(mainNav.length > 0 && Util.hasClass(mainNav[0], 'hide-nav--fixed')) navIsFixed = true;
  
      // store button that triggers navigation on mobile
      var triggerMobile = getTriggerMobileMenu();
      var prevElement = createPrevElement();
      var mainNavTop = 0;
      // list of classes the hide-nav has when it is expanded -> do not hide if it has those classes
      var navOpenClasses = hidingNav[0].getAttribute('data-nav-target-class'),
        navOpenArrayClasses = [];
      if(navOpenClasses) navOpenArrayClasses = navOpenClasses.split(' ');
      getMainNavTop();
      if(mainNavTop > 0) {
        scrollOffset = scrollOffset + mainNavTop;
      }
      
      // init navigation and listen to window scroll event
      getHeaderHeight();
      initSecondaryNav();
      initFixedNav();
      resetHideNav();
      window.addEventListener('scroll', function(event){
        if(scrolling) return;
        scrolling = true;
        window.requestAnimationFrame(resetHideNav);
      });
  
      window.addEventListener('resize', function(event){
        if(scrolling) return;
        scrolling = true;
        window.requestAnimationFrame(function(){
          if(headerHeight > 0) {
            getMainNavTop();
            getHeaderHeight();
            initSecondaryNav();
            initFixedNav();
          }
          // reset both navigation
          hideNavScrollUp();
  
          scrolling = false;
        });
      });
  
      function getHeaderHeight() {
        headerHeight = mainNav[0].offsetHeight;
      };
  
      function initSecondaryNav() { // if there's a secondary nav, set its top equal to the header height
        if(subNav.length < 1 || mainNav.length < 1) return;
        subNav[0].style.top = (headerHeight - 1)+'px';
      };
  
      function initFixedNav() {
        if(!navIsFixed || mainNav.length < 1) return;
        mainNav[0].style.marginBottom = '-'+headerHeight+'px';
      };
  
      function resetHideNav() { // check if navs need to be hidden/revealed
        currentTop = window.scrollY;
        if(currentTop - previousTop > scrollDelta && currentTop > scrollOffset) {
          hideNavScrollDown();
        } else if( previousTop - currentTop > scrollDelta || (previousTop - currentTop > 0 && currentTop < scrollOffset) ) {
          hideNavScrollUp();
        } else if( previousTop - currentTop > 0 && subNav.length > 0 && subNav[0].getBoundingClientRect().top > 0) {
          setTranslate(subNav[0], '0%');
        }
        // if primary nav is fixed -> toggle bg class
        if(navIsFixed) {
          var scrollTop = window.scrollY || window.pageYOffset;
          Util.toggleClass(mainNav[0], 'hide-nav--has-bg', (scrollTop > headerHeight + mainNavTop));
        }
        previousTop = currentTop;
        scrolling = false;
      };
  
      function hideNavScrollDown() {
        // if there's a secondary nav -> it has to reach the top before hiding nav
        if( subNav.length  > 0 && subNav[0].getBoundingClientRect().top > headerHeight) return;
        // on mobile -> hide navigation only if dropdown is not open
        if(triggerMobile && triggerMobile.getAttribute('aria-expanded') == "true") return;
        // check if main nav has one of the following classes
        if( mainNav.length > 0 && (!navOpenClasses || !checkNavExpanded())) {
          setTranslate(mainNav[0], '-100%'); 
          mainNav[0].addEventListener('transitionend', addOffCanvasClass);
        }
        if( subNav.length  > 0 ) setTranslate(subNav[0], '-'+headerHeight+'px');
      };
  
      function hideNavScrollUp() {
        if( mainNav.length > 0 ) {setTranslate(mainNav[0], '0%'); Util.removeClass(mainNav[0], 'hide-nav--off-canvas');mainNav[0].removeEventListener('transitionend', addOffCanvasClass);}
        if( subNav.length  > 0 ) setTranslate(subNav[0], '0%');
      };
  
      function addOffCanvasClass() {
        mainNav[0].removeEventListener('transitionend', addOffCanvasClass);
        Util.addClass(mainNav[0], 'hide-nav--off-canvas');
      };
  
      function setTranslate(element, val) {
        element.style.transform = 'translateY('+val+')';
      };
  
      function getTriggerMobileMenu() {
        // store trigger that toggle mobile navigation dropdown
        var triggerMobileClass = hidingNav[0].getAttribute('data-mobile-trigger');
        if(!triggerMobileClass) return false;
        if(triggerMobileClass.indexOf('#') == 0) { // get trigger by ID
          var trigger = document.getElementById(triggerMobileClass.replace('#', ''));
          if(trigger) return trigger;
        } else { // get trigger by class name
          var trigger = hidingNav[0].getElementsByClassName(triggerMobileClass);
          if(trigger.length > 0) return trigger[0];
        }
        
        return false;
      };
  
      function createPrevElement() {
        // create element to be inserted right before the mainNav to get its top value
        if( mainNav.length < 1) return false;
        var newElement = document.createElement("div"); 
        newElement.setAttribute('aria-hidden', 'true');
        mainNav[0].parentElement.insertBefore(newElement, mainNav[0]);
        var prevElement =  mainNav[0].previousElementSibling;
        prevElement.style.opacity = '0';
        return prevElement;
      };
  
      function getMainNavTop() {
        if(!prevElement) return;
        mainNavTop = prevElement.getBoundingClientRect().top + window.scrollY;
      };
  
      function checkNavExpanded() {
        var navIsOpen = false;
        for(var i = 0; i < navOpenArrayClasses.length; i++){
          if(Util.hasClass(mainNav[0], navOpenArrayClasses[i].trim())) {
            navIsOpen = true;
            break;
          }
        }
        return navIsOpen;
      };
      
    } else {
      // if window requestAnimationFrame is not supported -> add bg class to fixed header
      var mainNav = document.getElementsByClassName('js-hide-nav--main');
      if(mainNav.length < 1) return;
      if(Util.hasClass(mainNav[0], 'hide-nav--fixed')) Util.addClass(mainNav[0], 'hide-nav--has-bg');
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
// File#: _1_popover
// Usage: codyhouse.co/license
(function() {
    var Popover = function(element) {
      this.element = element;
      this.elementId = this.element.getAttribute('id');
      this.trigger = document.querySelectorAll('[aria-controls="'+this.elementId+'"]');
      this.selectedTrigger = false;
      this.popoverVisibleClass = 'popover--is-visible';
      this.selectedTriggerClass = 'popover-control--active';
      this.popoverIsOpen = false;
      // focusable elements
      this.firstFocusable = false;
      this.lastFocusable = false;
      // position target - position tooltip relative to a specified element
      this.positionTarget = getPositionTarget(this);
      // gap between element and viewport - if there's max-height 
      this.viewportGap = parseInt(getComputedStyle(this.element).getPropertyValue('--popover-viewport-gap')) || 20;
      initPopover(this);
      initPopoverEvents(this);
    };
  
    // public methods
    Popover.prototype.togglePopover = function(bool, moveFocus) {
      togglePopover(this, bool, moveFocus);
    };
  
    Popover.prototype.checkPopoverClick = function(target) {
      checkPopoverClick(this, target);
    };
  
    Popover.prototype.checkPopoverFocus = function() {
      checkPopoverFocus(this);
    };
  
    // private methods
    function getPositionTarget(popover) {
      // position tooltip relative to a specified element - if provided
      var positionTargetSelector = popover.element.getAttribute('data-position-target');
      if(!positionTargetSelector) return false;
      var positionTarget = document.querySelector(positionTargetSelector);
      return positionTarget;
    };
  
    function initPopover(popover) {
      // init aria-labels
      for(var i = 0; i < popover.trigger.length; i++) {
        Util.setAttributes(popover.trigger[i], {'aria-expanded': 'false', 'aria-haspopup': 'true'});
      }
    };
    
    function initPopoverEvents(popover) {
      for(var i = 0; i < popover.trigger.length; i++) {(function(i){
        popover.trigger[i].addEventListener('click', function(event){
          event.preventDefault();
          // if the popover had been previously opened by another trigger element -> close it first and reopen in the right position
          if(Util.hasClass(popover.element, popover.popoverVisibleClass) && popover.selectedTrigger !=  popover.trigger[i]) {
            togglePopover(popover, false, false); // close menu
          }
          // toggle popover
          popover.selectedTrigger = popover.trigger[i];
          togglePopover(popover, !Util.hasClass(popover.element, popover.popoverVisibleClass), true);
        });
      })(i);}
      
      // trap focus
      popover.element.addEventListener('keydown', function(event){
        if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
          //trap focus inside popover
          trapFocus(popover, event);
        }
      });
  
      // custom events -> open/close popover
      popover.element.addEventListener('openPopover', function(event){
        togglePopover(popover, true);
      });
  
      popover.element.addEventListener('closePopover', function(event){
        togglePopover(popover, false, event.detail);
      });
    };
    
    function togglePopover(popover, bool, moveFocus) {
      // toggle popover visibility
      Util.toggleClass(popover.element, popover.popoverVisibleClass, bool);
      popover.popoverIsOpen = bool;
      if(bool) {
        popover.selectedTrigger.setAttribute('aria-expanded', 'true');
        getFocusableElements(popover);
        // move focus
        focusPopover(popover);
        popover.element.addEventListener("transitionend", function(event) {focusPopover(popover);}, {once: true});
        // position the popover element
        positionPopover(popover);
        // add class to popover trigger
        Util.addClass(popover.selectedTrigger, popover.selectedTriggerClass);
      } else if(popover.selectedTrigger) {
        popover.selectedTrigger.setAttribute('aria-expanded', 'false');
        if(moveFocus) Util.moveFocus(popover.selectedTrigger);
        // remove class from menu trigger
        Util.removeClass(popover.selectedTrigger, popover.selectedTriggerClass);
        popover.selectedTrigger = false;
      }
    };
    
    function focusPopover(popover) {
      if(popover.firstFocusable) {
        popover.firstFocusable.focus();
      } else {
        Util.moveFocus(popover.element);
      }
    };
  
    function positionPopover(popover) {
      // reset popover position
      resetPopoverStyle(popover);
      var selectedTriggerPosition = (popover.positionTarget) ? popover.positionTarget.getBoundingClientRect() : popover.selectedTrigger.getBoundingClientRect();
      
      var menuOnTop = (window.innerHeight - selectedTriggerPosition.bottom) < selectedTriggerPosition.top;
        
      var left = selectedTriggerPosition.left,
        right = (window.innerWidth - selectedTriggerPosition.right),
        isRight = (window.innerWidth < selectedTriggerPosition.left + popover.element.offsetWidth);
  
      var horizontal = isRight ? 'right: '+right+'px;' : 'left: '+left+'px;',
        vertical = menuOnTop
          ? 'bottom: '+(window.innerHeight - selectedTriggerPosition.top)+'px;'
          : 'top: '+selectedTriggerPosition.bottom+'px;';
      // check right position is correct -> otherwise set left to 0
      if( isRight && (right + popover.element.offsetWidth) > window.innerWidth) horizontal = 'left: '+ parseInt((window.innerWidth - popover.element.offsetWidth)/2)+'px;';
      // check if popover needs a max-height (user will scroll inside the popover)
      var maxHeight = menuOnTop ? selectedTriggerPosition.top - popover.viewportGap : window.innerHeight - selectedTriggerPosition.bottom - popover.viewportGap;
  
      var initialStyle = popover.element.getAttribute('style');
      if(!initialStyle) initialStyle = '';
      popover.element.setAttribute('style', initialStyle + horizontal + vertical +'max-height:'+Math.floor(maxHeight)+'px;');
    };
    
    function resetPopoverStyle(popover) {
      // remove popover inline style before appling new style
      popover.element.style.maxHeight = '';
      popover.element.style.top = '';
      popover.element.style.bottom = '';
      popover.element.style.left = '';
      popover.element.style.right = '';
    };
  
    function checkPopoverClick(popover, target) {
      // close popover when clicking outside it
      if(!popover.popoverIsOpen) return;
      if(!popover.element.contains(target) && !target.closest('[aria-controls="'+popover.elementId+'"]')) togglePopover(popover, false);
    };
  
    function checkPopoverFocus(popover) {
      // on Esc key -> close popover if open and move focus (if focus was inside popover)
      if(!popover.popoverIsOpen) return;
      var popoverParent = document.activeElement.closest('.js-popover');
      togglePopover(popover, false, popoverParent);
    };
    
    function getFocusableElements(popover) {
      //get all focusable elements inside the popover
      var allFocusable = popover.element.querySelectorAll(focusableElString);
      getFirstVisible(popover, allFocusable);
      getLastVisible(popover, allFocusable);
    };
  
    function getFirstVisible(popover, elements) {
      //get first visible focusable element inside the popover
      for(var i = 0; i < elements.length; i++) {
        if( isVisible(elements[i]) ) {
          popover.firstFocusable = elements[i];
          break;
        }
      }
    };
  
    function getLastVisible(popover, elements) {
      //get last visible focusable element inside the popover
      for(var i = elements.length - 1; i >= 0; i--) {
        if( isVisible(elements[i]) ) {
          popover.lastFocusable = elements[i];
          break;
        }
      }
    };
  
    function trapFocus(popover, event) {
      if( popover.firstFocusable == document.activeElement && event.shiftKey) {
        //on Shift+Tab -> focus last focusable element when focus moves out of popover
        event.preventDefault();
        popover.lastFocusable.focus();
      }
      if( popover.lastFocusable == document.activeElement && !event.shiftKey) {
        //on Tab -> focus first focusable element when focus moves out of popover
        event.preventDefault();
        popover.firstFocusable.focus();
      }
    };
    
    function isVisible(element) {
      // check if element is visible
      return element.offsetWidth || element.offsetHeight || element.getClientRects().length;
    };
  
    window.Popover = Popover;
  
    //initialize the Popover objects
    var popovers = document.getElementsByClassName('js-popover');
    // generic focusable elements string selector
    var focusableElString = '[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable], audio[controls], video[controls], summary';
    
    if( popovers.length > 0 ) {
      var popoversArray = [];
      var scrollingContainers = [];
      for( var i = 0; i < popovers.length; i++) {
        (function(i){
          popoversArray.push(new Popover(popovers[i]));
          var scrollableElement = popovers[i].getAttribute('data-scrollable-element');
          if(scrollableElement && !scrollingContainers.includes(scrollableElement)) scrollingContainers.push(scrollableElement);
        })(i);
      }
  
      // listen for key events
      window.addEventListener('keyup', function(event){
        if( event.keyCode && event.keyCode == 27 || event.key && event.key.toLowerCase() == 'escape' ) {
          // close popover on 'Esc'
          popoversArray.forEach(function(element){
            element.checkPopoverFocus();
          });
        } 
      });
      // close popover when clicking outside it
      window.addEventListener('click', function(event){
        popoversArray.forEach(function(element){
          element.checkPopoverClick(event.target);
        });
      });
      // on resize -> close all popover elements
      window.addEventListener('resize', function(event){
        popoversArray.forEach(function(element){
          element.togglePopover(false, false);
        });
      });
      // on scroll -> close all popover elements
      window.addEventListener('scroll', function(event){
        popoversArray.forEach(function(element){
          if(element.popoverIsOpen) element.togglePopover(false, false);
        });
      });
      // take into account additinal scrollable containers
      for(var j = 0; j < scrollingContainers.length; j++) {
        var scrollingContainer = document.querySelector(scrollingContainers[j]);
        if(scrollingContainer) {
          scrollingContainer.addEventListener('scroll', function(event){
            popoversArray.forEach(function(element){
              if(element.popoverIsOpen) element.togglePopover(false, false);
            });
          });
        }
      }
    }
  }());
// File#: _1_read-more
// Usage: codyhouse.co/license
(function() {
    var ReadMore = function(element) {
      this.element = element;
      this.moreContent = this.element.getElementsByClassName('js-read-more__content');
      this.count = this.element.getAttribute('data-characters') || 200;
      this.counting = 0;
      this.btnClasses = this.element.getAttribute('data-btn-class');
      this.ellipsis = this.element.getAttribute('data-ellipsis') && this.element.getAttribute('data-ellipsis') == 'off' ? false : true;
      this.btnShowLabel = 'Read more';
      this.btnHideLabel = 'Read less';
      this.toggleOff = this.element.getAttribute('data-toggle') && this.element.getAttribute('data-toggle') == 'off' ? false : true;
      if( this.moreContent.length == 0 ) splitReadMore(this);
      setBtnLabels(this);
      initReadMore(this);
    };
  
    function splitReadMore(readMore) { 
      splitChildren(readMore.element, readMore); // iterate through children and hide content
    };
  
    function splitChildren(parent, readMore) {
      if(readMore.counting >= readMore.count) {
        Util.addClass(parent, 'js-read-more__content');
        return parent.outerHTML;
      }
      var children = parent.childNodes;
      var content = '';
      for(var i = 0; i < children.length; i++) {
        if (children[i].nodeType == Node.TEXT_NODE) {
          content = content + wrapText(children[i], readMore);
        } else {
          content = content + splitChildren(children[i], readMore);
        }
      }
      parent.innerHTML = content;
      return parent.outerHTML;
    };
  
    function wrapText(element, readMore) {
      var content = element.textContent;
      if(content.replace(/\s/g,'').length == 0) return '';// check if content is empty
      if(readMore.counting >= readMore.count) {
        return '<span class="js-read-more__content">' + content + '</span>';
      }
      if(readMore.counting + content.length < readMore.count) {
        readMore.counting = readMore.counting + content.length;
        return content;
      }
      var firstContent = content.substr(0, readMore.count - readMore.counting);
      firstContent = firstContent.substr(0, Math.min(firstContent.length, firstContent.lastIndexOf(" ")));
      var secondContent = content.substr(firstContent.length, content.length);
      readMore.counting = readMore.count;
      return firstContent + '<span class="js-read-more__content">' + secondContent + '</span>';
    };
  
    function setBtnLabels(readMore) { // set custom labels for read More/Less btns
      var btnLabels = readMore.element.getAttribute('data-btn-labels');
      if(btnLabels) {
        var labelsArray = btnLabels.split(',');
        readMore.btnShowLabel = labelsArray[0].trim();
        readMore.btnHideLabel = labelsArray[1].trim();
      }
    };
  
    function initReadMore(readMore) { // add read more/read less buttons to the markup
      readMore.moreContent = readMore.element.getElementsByClassName('js-read-more__content');
      if( readMore.moreContent.length == 0 ) {
        Util.addClass(readMore.element, 'read-more--loaded');
        return;
      }
      var btnShow = ' <button class="js-read-more__btn '+readMore.btnClasses+'">'+readMore.btnShowLabel+'</button>';
      var btnHide = ' <button class="js-read-more__btn is-hidden '+readMore.btnClasses+'">'+readMore.btnHideLabel+'</button>';
      if(readMore.ellipsis) {
        btnShow = '<span class="js-read-more__ellipsis" aria-hidden="true">...</span>'+ btnShow;
      }
  
      readMore.moreContent[readMore.moreContent.length - 1].insertAdjacentHTML('afterend', btnHide);
      readMore.moreContent[0].insertAdjacentHTML('afterend', btnShow);
      resetAppearance(readMore);
      initEvents(readMore);
    };
  
    function resetAppearance(readMore) { // hide part of the content
      for(var i = 0; i < readMore.moreContent.length; i++) Util.addClass(readMore.moreContent[i], 'is-hidden');
      Util.addClass(readMore.element, 'read-more--loaded'); // show entire component
    };
  
    function initEvents(readMore) { // listen to the click on the read more/less btn
      readMore.btnToggle = readMore.element.getElementsByClassName('js-read-more__btn');
      readMore.ellipsis = readMore.element.getElementsByClassName('js-read-more__ellipsis');
  
      readMore.btnToggle[0].addEventListener('click', function(event){
        event.preventDefault();
        updateVisibility(readMore, true);
      });
      readMore.btnToggle[1].addEventListener('click', function(event){
        event.preventDefault();
        updateVisibility(readMore, false);
      });
    };
  
    function updateVisibility(readMore, visibile) {
      for(var i = 0; i < readMore.moreContent.length; i++) Util.toggleClass(readMore.moreContent[i], 'is-hidden', !visibile);
      // reset btns appearance
      Util.toggleClass(readMore.btnToggle[0], 'is-hidden', visibile);
      Util.toggleClass(readMore.btnToggle[1], 'is-hidden', !visibile);
      if(readMore.ellipsis.length > 0 ) Util.toggleClass(readMore.ellipsis[0], 'is-hidden', visibile);
      if(!readMore.toggleOff) Util.addClass(readMore.btn, 'is-hidden');
      // move focus
      if(visibile) {
        var targetTabIndex = readMore.moreContent[0].getAttribute('tabindex');
        Util.moveFocus(readMore.moreContent[0]);
        resetFocusTarget(readMore.moreContent[0], targetTabIndex);
      } else {
        Util.moveFocus(readMore.btnToggle[0]);
      }
    };
  
    function resetFocusTarget(target, tabindex) {
      if( parseInt(target.getAttribute('tabindex')) < 0) {
        target.style.outline = 'none';
        !tabindex && target.removeAttribute('tabindex');
      }
    };
  
    //initialize the ReadMore objects
    var readMore = document.getElementsByClassName('js-read-more');
    if( readMore.length > 0 ) {
      for( var i = 0; i < readMore.length; i++) {
        (function(i){new ReadMore(readMore[i]);})(i);
      }
    };
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
// File#: _1_smooth-scrolling
// Usage: codyhouse.co/license
(function() {
    var SmoothScroll = function(element) {
      if(!('CSS' in window) || !CSS.supports('color', 'var(--color-var)')) return;
      this.element = element;
      this.scrollDuration = parseInt(this.element.getAttribute('data-duration')) || 300;
      this.dataElementY = this.element.getAttribute('data-scrollable-element-y') || this.element.getAttribute('data-scrollable-element') || this.element.getAttribute('data-element');
      this.scrollElementY = this.dataElementY ? document.querySelector(this.dataElementY) : window;
      this.dataElementX = this.element.getAttribute('data-scrollable-element-x');
      this.scrollElementX = this.dataElementY ? document.querySelector(this.dataElementX) : window;
      this.initScroll();
    };
  
    SmoothScroll.prototype.initScroll = function() {
      var self = this;
  
      //detect click on link
      this.element.addEventListener('click', function(event){
        event.preventDefault();
        var targetId = event.target.closest('.js-smooth-scroll').getAttribute('href').replace('#', ''),
          target = document.getElementById(targetId),
          targetTabIndex = target.getAttribute('tabindex'),
          windowScrollTop = self.scrollElementY.scrollTop || document.documentElement.scrollTop;
  
        // scroll vertically
        if(!self.dataElementY) windowScrollTop = window.scrollY || document.documentElement.scrollTop;
  
        var scrollElementY = self.dataElementY ? self.scrollElementY : false;
  
        var fixedHeight = self.getFixedElementHeight(); // check if there's a fixed element on the page
        Util.scrollTo(target.getBoundingClientRect().top + windowScrollTop - fixedHeight, self.scrollDuration, function() {
          // scroll horizontally
          self.scrollHorizontally(target, fixedHeight);
          //move the focus to the target element - don't break keyboard navigation
          Util.moveFocus(target);
          history.pushState(false, false, '#'+targetId);
          self.resetTarget(target, targetTabIndex);
        }, scrollElementY);
      });
    };
  
    SmoothScroll.prototype.scrollHorizontally = function(target, delta) {
      var scrollEl = this.dataElementX ? this.scrollElementX : false;
      var windowScrollLeft = this.scrollElementX ? this.scrollElementX.scrollLeft : document.documentElement.scrollLeft;
      var final = target.getBoundingClientRect().left + windowScrollLeft - delta,
        duration = this.scrollDuration;
  
      var element = scrollEl || window;
      var start = element.scrollLeft || document.documentElement.scrollLeft,
        currentTime = null;
  
      if(!scrollEl) start = window.scrollX || document.documentElement.scrollLeft;
      // return if there's no need to scroll
      if(Math.abs(start - final) < 5) return;
          
      var animateScroll = function(timestamp){
        if (!currentTime) currentTime = timestamp;        
        var progress = timestamp - currentTime;
        if(progress > duration) progress = duration;
        var val = Math.easeInOutQuad(progress, start, final-start, duration);
        element.scrollTo({
          left: val,
        });
        if(progress < duration) {
          window.requestAnimationFrame(animateScroll);
        }
      };
  
      window.requestAnimationFrame(animateScroll);
    };
  
    SmoothScroll.prototype.resetTarget = function(target, tabindex) {
      if( parseInt(target.getAttribute('tabindex')) < 0) {
        target.style.outline = 'none';
        !tabindex && target.removeAttribute('tabindex');
      }	
    };
  
    SmoothScroll.prototype.getFixedElementHeight = function() {
      var scrollElementY = this.dataElementY ? this.scrollElementY : document.documentElement;
      var fixedElementDelta = parseInt(getComputedStyle(scrollElementY).getPropertyValue('scroll-padding'));
      if(isNaN(fixedElementDelta) ) { // scroll-padding not supported
        fixedElementDelta = 0;
        var fixedElement = document.querySelector(this.element.getAttribute('data-fixed-element'));
        if(fixedElement) fixedElementDelta = parseInt(fixedElement.getBoundingClientRect().height);
      }
      return fixedElementDelta;
    };
    
    //initialize the Smooth Scroll objects
    var smoothScrollLinks = document.getElementsByClassName('js-smooth-scroll');
    if( smoothScrollLinks.length > 0 && !Util.cssSupports('scroll-behavior', 'smooth') && window.requestAnimationFrame) {
      // you need javascript only if css scroll-behavior is not supported
      for( var i = 0; i < smoothScrollLinks.length; i++) {
        (function(i){new SmoothScroll(smoothScrollLinks[i]);})(i);
      }
    }
  }());
// File#: _1_sub-navigation
// Usage: codyhouse.co/license
(function() {
    var SideNav = function(element) {
      this.element = element;
      this.control = this.element.getElementsByClassName('js-subnav__control');
      this.navList = this.element.getElementsByClassName('js-subnav__wrapper');
      this.closeBtn = this.element.getElementsByClassName('js-subnav__close-btn');
      this.firstFocusable = getFirstFocusable(this);
      this.showClass = 'subnav__wrapper--is-visible';
      this.collapsedLayoutClass = 'subnav--collapsed';
      initSideNav(this);
    };
  
    function getFirstFocusable(sidenav) { // get first focusable element inside the subnav
      if(sidenav.navList.length == 0) return;
      var focusableEle = sidenav.navList[0].querySelectorAll('[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable], audio[controls], video[controls], summary'),
          firstFocusable = false;
      for(var i = 0; i < focusableEle.length; i++) {
        if( focusableEle[i].offsetWidth || focusableEle[i].offsetHeight || focusableEle[i].getClientRects().length ) {
          firstFocusable = focusableEle[i];
          break;
        }
      }
  
      return firstFocusable;
    };
  
    function initSideNav(sidenav) {
      checkSideNavLayout(sidenav); // switch from --compressed to --expanded layout
      initSideNavToggle(sidenav); // mobile behavior + layout update on resize
    };
  
    function initSideNavToggle(sidenav) { 
      // custom event emitted when window is resized
      sidenav.element.addEventListener('update-sidenav', function(event){
        checkSideNavLayout(sidenav);
      });
  
      // mobile only
      if(sidenav.control.length == 0 || sidenav.navList.length == 0) return;
      sidenav.control[0].addEventListener('click', function(event){ // open sidenav
        openSideNav(sidenav, event);
      });
      sidenav.element.addEventListener('click', function(event) { // close sidenav when clicking on close button/bg layer
        if(event.target.closest('.js-subnav__close-btn') || Util.hasClass(event.target, 'js-subnav__wrapper')) {
          closeSideNav(sidenav, event);
        }
      });
    };
  
    function openSideNav(sidenav, event) { // open side nav - mobile only
      event.preventDefault();
      sidenav.selectedTrigger = event.target;
      event.target.setAttribute('aria-expanded', 'true');
      Util.addClass(sidenav.navList[0], sidenav.showClass);
      sidenav.navList[0].addEventListener('transitionend', function cb(event){
        sidenav.navList[0].removeEventListener('transitionend', cb);
        sidenav.firstFocusable.focus();
      });
    };
  
    function closeSideNav(sidenav, event, bool) { // close side sidenav - mobile only
      if( !Util.hasClass(sidenav.navList[0], sidenav.showClass) ) return;
      if(event) event.preventDefault();
      Util.removeClass(sidenav.navList[0], sidenav.showClass);
      if(!sidenav.selectedTrigger) return;
      sidenav.selectedTrigger.setAttribute('aria-expanded', 'false');
      if(!bool) sidenav.selectedTrigger.focus();
      sidenav.selectedTrigger = false; 
    };
  
    function checkSideNavLayout(sidenav) { // switch from --compressed to --expanded layout
      var layout = getComputedStyle(sidenav.element, ':before').getPropertyValue('content').replace(/\'|"/g, '');
      if(layout != 'expanded' && layout != 'collapsed') return;
      Util.toggleClass(sidenav.element, sidenav.collapsedLayoutClass, layout != 'expanded');
    };
    
    var sideNav = document.getElementsByClassName('js-subnav'),
      SideNavArray = [],
      j = 0;
    if( sideNav.length > 0) {
      for(var i = 0; i < sideNav.length; i++) {
        var beforeContent = getComputedStyle(sideNav[i], ':before').getPropertyValue('content');
        if(beforeContent && beforeContent !='' && beforeContent !='none') {
          j = j + 1;
        }
        (function(i){SideNavArray.push(new SideNav(sideNav[i]));})(i);
      }
  
      if(j > 0) { // on resize - update sidenav layout
        var resizingId = false,
          customEvent = new CustomEvent('update-sidenav');
        window.addEventListener('resize', function(event){
          clearTimeout(resizingId);
          resizingId = setTimeout(doneResizing, 300);
        });
  
        function doneResizing() {
          for( var i = 0; i < SideNavArray.length; i++) {
            (function(i){SideNavArray[i].element.dispatchEvent(customEvent)})(i);
          };
        };
  
        (window.requestAnimationFrame) // init table layout
          ? window.requestAnimationFrame(doneResizing)
          : doneResizing();
      }
  
      // listen for key events
      window.addEventListener('keyup', function(event){
        if( (event.keyCode && event.keyCode == 27) || (event.key && event.key.toLowerCase() == 'escape' )) {// listen for esc key - close navigation on mobile if open
          for(var i = 0; i < SideNavArray.length; i++) {
            (function(i){closeSideNav(SideNavArray[i], event);})(i);
          };
        }
        if( (event.keyCode && event.keyCode == 9) || (event.key && event.key.toLowerCase() == 'tab' )) { // listen for tab key - close navigation on mobile if open when nav loses focus
          if( document.activeElement.closest('.js-subnav__wrapper')) return;
          for(var i = 0; i < SideNavArray.length; i++) {
            (function(i){closeSideNav(SideNavArray[i], event, true);})(i);
          };
        }
      });
    }
  }());
// File#: _1_switch-icon
// Usage: codyhouse.co/license
(function() {
    var switchIcons = document.getElementsByClassName('js-switch-icon');
    if( switchIcons.length > 0 ) {
      for(var i = 0; i < switchIcons.length; i++) {(function(i){
        if( !Util.hasClass(switchIcons[i], 'switch-icon--hover') ) initswitchIcons(switchIcons[i]);
      })(i);}
  
      function initswitchIcons(btn) {
        btn.addEventListener('click', function(event){	
          event.preventDefault();
          var status = !Util.hasClass(btn, 'switch-icon--state-b');
          Util.toggleClass(btn, 'switch-icon--state-b', status);
          // emit custom event
          var event = new CustomEvent('switch-icon-clicked', {detail: status});
          btn.dispatchEvent(event);
        });
      };
    }
  }());
// File#: _1_tabs
// Usage: codyhouse.co/license
(function() {
    var Tab = function(element) {
      this.element = element;
      this.tabList = this.element.getElementsByClassName('js-tabs__controls')[0];
      this.listItems = this.tabList.getElementsByTagName('li');
      this.triggers = this.tabList.getElementsByTagName('a');
      this.panelsList = this.element.getElementsByClassName('js-tabs__panels')[0];
      this.panels = Util.getChildrenByClassName(this.panelsList, 'js-tabs__panel');
      this.hideClass = 'is-hidden';
      this.customShowClass = this.element.getAttribute('data-show-panel-class') ? this.element.getAttribute('data-show-panel-class') : false;
      this.layout = this.element.getAttribute('data-tabs-layout') ? this.element.getAttribute('data-tabs-layout') : 'horizontal';
      // deep linking options
      this.deepLinkOn = this.element.getAttribute('data-deep-link') == 'on';
      // init tabs
      this.initTab();
    };
  
    Tab.prototype.initTab = function() {
      //set initial aria attributes
      this.tabList.setAttribute('role', 'tablist');
      for( var i = 0; i < this.triggers.length; i++) {
        var bool = (i == 0),
          panelId = this.panels[i].getAttribute('id');
        this.listItems[i].setAttribute('role', 'presentation');
        Util.setAttributes(this.triggers[i], {'role': 'tab', 'aria-selected': bool, 'aria-controls': panelId, 'id': 'tab-'+panelId});
        Util.addClass(this.triggers[i], 'js-tabs__trigger'); 
        Util.setAttributes(this.panels[i], {'role': 'tabpanel', 'aria-labelledby': 'tab-'+panelId});
        Util.toggleClass(this.panels[i], this.hideClass, !bool);
  
        if(!bool) this.triggers[i].setAttribute('tabindex', '-1'); 
      }
  
      //listen for Tab events
      this.initTabEvents();
  
      // check deep linking option
      this.initDeepLink();
    };
  
    Tab.prototype.initTabEvents = function() {
      var self = this;
      //click on a new tab -> select content
      this.tabList.addEventListener('click', function(event) {
        if( event.target.closest('.js-tabs__trigger') ) self.triggerTab(event.target.closest('.js-tabs__trigger'), event);
      });
      //arrow keys to navigate through tabs 
      this.tabList.addEventListener('keydown', function(event) {
        ;
        if( !event.target.closest('.js-tabs__trigger') ) return;
        if( tabNavigateNext(event, self.layout) ) {
          event.preventDefault();
          self.selectNewTab('next');
        } else if( tabNavigatePrev(event, self.layout) ) {
          event.preventDefault();
          self.selectNewTab('prev');
        }
      });
    };
  
    Tab.prototype.selectNewTab = function(direction) {
      var selectedTab = this.tabList.querySelector('[aria-selected="true"]'),
        index = Util.getIndexInArray(this.triggers, selectedTab);
      index = (direction == 'next') ? index + 1 : index - 1;
      //make sure index is in the correct interval 
      //-> from last element go to first using the right arrow, from first element go to last using the left arrow
      if(index < 0) index = this.listItems.length - 1;
      if(index >= this.listItems.length) index = 0;	
      this.triggerTab(this.triggers[index]);
      this.triggers[index].focus();
    };
  
    Tab.prototype.triggerTab = function(tabTrigger, event) {
      var self = this;
      event && event.preventDefault();	
      var index = Util.getIndexInArray(this.triggers, tabTrigger);
      //no need to do anything if tab was already selected
      if(this.triggers[index].getAttribute('aria-selected') == 'true') return;
      
      for( var i = 0; i < this.triggers.length; i++) {
        var bool = (i == index);
        Util.toggleClass(this.panels[i], this.hideClass, !bool);
        if(this.customShowClass) Util.toggleClass(this.panels[i], this.customShowClass, bool);
        this.triggers[i].setAttribute('aria-selected', bool);
        bool ? this.triggers[i].setAttribute('tabindex', '0') : this.triggers[i].setAttribute('tabindex', '-1');
      }
  
      // update url if deepLink is on
      if(this.deepLinkOn) {
        history.replaceState(null, '', '#'+tabTrigger.getAttribute('aria-controls'));
      }
    };
  
    Tab.prototype.initDeepLink = function() {
      if(!this.deepLinkOn) return;
      var hash = window.location.hash.substr(1);
      var self = this;
      if(!hash || hash == '') return;
      for(var i = 0; i < this.panels.length; i++) {
        if(this.panels[i].getAttribute('id') == hash) {
          this.triggerTab(this.triggers[i], false);
          setTimeout(function(){self.panels[i].scrollIntoView(true);});
          break;
        }
      };
    };
  
    function tabNavigateNext(event, layout) {
      if(layout == 'horizontal' && (event.keyCode && event.keyCode == 39 || event.key && event.key == 'ArrowRight')) {return true;}
      else if(layout == 'vertical' && (event.keyCode && event.keyCode == 40 || event.key && event.key == 'ArrowDown')) {return true;}
      else {return false;}
    };
  
    function tabNavigatePrev(event, layout) {
      if(layout == 'horizontal' && (event.keyCode && event.keyCode == 37 || event.key && event.key == 'ArrowLeft')) {return true;}
      else if(layout == 'vertical' && (event.keyCode && event.keyCode == 38 || event.key && event.key == 'ArrowUp')) {return true;}
      else {return false;}
    };
    
    //initialize the Tab objects
    var tabs = document.getElementsByClassName('js-tabs');
    if( tabs.length > 0 ) {
      for( var i = 0; i < tabs.length; i++) {
        (function(i){new Tab(tabs[i]);})(i);
      }
    }
  }());
// File#: _2_adv-custom-select
// Usage: codyhouse.co/license
(function() {
    var AdvSelect = function(element) {
      this.element = element;
      this.select = this.element.getElementsByTagName('select')[0];
      this.optGroups = this.select.getElementsByTagName('optgroup');
      this.options = this.select.getElementsByTagName('option');
      this.optionData = getOptionsData(this);
      this.selectId = this.select.getAttribute('id');
      this.selectLabel = document.querySelector('[for='+this.selectId+']')
      this.trigger = this.element.getElementsByClassName('js-adv-select__control')[0];
      this.triggerLabel = this.trigger.getElementsByClassName('js-adv-select__value')[0];
      this.dropdown = document.getElementById(this.trigger.getAttribute('aria-controls'));
  
      initAdvSelect(this); // init markup
      initAdvSelectEvents(this); // init event listeners
    };
  
    function getOptionsData(select) {
      var obj = [],
        dataset = select.options[0].dataset;
  
      function camelCaseToDash( myStr ) {
        return myStr.replace( /([a-z])([A-Z])/g, '$1-$2' ).toLowerCase();
      }
      for (var prop in dataset) {
        if (Object.prototype.hasOwnProperty.call(dataset, prop)) {
          // obj[prop] = select.dataset[prop];
          obj.push(camelCaseToDash(prop));
        }
      }
      return obj;
    };
  
    function initAdvSelect(select) {
      // create custom structure
      createAdvStructure(select);
      // update trigger label
      updateTriggerLabel(select);
      // hide native select and show custom structure
      Util.addClass(select.select, 'is-hidden');
      Util.removeClass(select.trigger, 'is-hidden');
      Util.removeClass(select.dropdown, 'is-hidden');
    };
  
    function initAdvSelectEvents(select) {
      if(select.selectLabel) {
        // move focus to custom trigger when clicking on <select> label
        select.selectLabel.addEventListener('click', function(){
          select.trigger.focus();
        });
      }
  
      // option is selected in dropdown
      select.dropdown.addEventListener('click', function(event){
        triggerSelection(select, event.target);
      });
  
      // keyboard navigation
      select.dropdown.addEventListener('keydown', function(event){
        if(event.keyCode && event.keyCode == 38 || event.key && event.key.toLowerCase() == 'arrowup') {
          keyboardCustomSelect(select, 'prev', event);
        } else if(event.keyCode && event.keyCode == 40 || event.key && event.key.toLowerCase() == 'arrowdown') {
          keyboardCustomSelect(select, 'next', event);
        } else if(event.keyCode && event.keyCode == 13 || event.key && event.key.toLowerCase() == 'enter') {
          triggerSelection(select, document.activeElement);
        }
      });
    };
  
    function createAdvStructure(select) {
      // store optgroup and option structure
      var optgroup = select.dropdown.querySelector('[role="group"]'),
        option = select.dropdown.querySelector('[role="option"]'),
        optgroupClone = false,
        optgroupLabel = false,
        optionClone = false;
      if(optgroup) {
        optgroupClone = optgroup.cloneNode();
        optgroupLabel = document.getElementById(optgroupClone.getAttribute('describedby'));
      }
      if(option) optionClone = option.cloneNode(true);
  
      var dropdownCode = '';
  
      if(select.optGroups.length > 0) {
        for(var i = 0; i < select.optGroups.length; i++) {
          dropdownCode = dropdownCode + getOptGroupCode(select, select.optGroups[i], optgroupClone, optionClone, optgroupLabel, i);
        }
      } else {
        for(var i = 0; i < select.options.length; i++) {
          dropdownCode = dropdownCode + getOptionCode(select, select.options[i], optionClone);
        }
      }
  
      select.dropdown.innerHTML = dropdownCode;
    };
  
    function getOptGroupCode(select, optGroup, optGroupClone, optionClone, optgroupLabel, index) {
      if(!optGroupClone || !optionClone) return '';
      var code = '';
      var options = optGroup.getElementsByTagName('option');
      for(var i = 0; i < options.length; i++) {
        code = code + getOptionCode(select, options[i], optionClone);
      }
      if(optgroupLabel) {
        var label = optgroupLabel.cloneNode(true);
        var id = label.getAttribute('id') + '-'+index;
        label.setAttribute('id', id);
        optGroupClone.setAttribute('describedby', id);
        code = label.outerHTML.replace('{optgroup-label}', optGroup.getAttribute('label')) + code;
      } 
      optGroupClone.innerHTML = code;
      return optGroupClone.outerHTML;
    };
  
    function getOptionCode(select, option, optionClone) {
      optionClone.setAttribute('data-value', option.value);
      if(option.selected) {
        optionClone.setAttribute('aria-selected', 'true');
        optionClone.setAttribute('tabindex', '0');
      } else {
        optionClone.removeAttribute('aria-selected');
        optionClone.removeAttribute('tabindex');
      }
      var optionHtml = optionClone.outerHTML;
      optionHtml = optionHtml.replace('{option-label}', option.text);
      for(var i = 0; i < select.optionData.length; i++) {
        optionHtml = optionHtml.replace('{'+select.optionData[i]+'}', option.getAttribute('data-'+select.optionData[i]));
      }
      return optionHtml;
    };
  
    function updateTriggerLabel(select) {
      // select.triggerLabel.textContent = select.options[select.select.selectedIndex].text;
      select.triggerLabel.innerHTML = select.dropdown.querySelector('[aria-selected="true"]').innerHTML;
    };
  
    function triggerSelection(select, target) {
      var option = target.closest('[role="option"]');
      if(!option) return;
      selectOption(select, option);
    };
  
    function selectOption(select, option) {
      if(option.hasAttribute('aria-selected') && option.getAttribute('aria-selected') == 'true') {
        // selecting the same option
      } else { 
        var selectedOption = select.dropdown.querySelector('[aria-selected="true"]');
        if(selectedOption) {
          selectedOption.removeAttribute('aria-selected');
          selectedOption.removeAttribute('tabindex');
        }
        option.setAttribute('aria-selected', 'true');
        option.setAttribute('tabindex', '0');
        // new option has been selected -> update native <select> element and trigger label
        updateNativeSelect(select, option.getAttribute('data-value'));
        updateTriggerLabel(select);
      }
      // move focus back to trigger
      setTimeout(function(){
        select.trigger.click();
      });
    };
  
    function updateNativeSelect(select, selectedValue) {
      var selectedOption = select.select.querySelector('[value="'+selectedValue+'"');
      select.select.selectedIndex = Util.getIndexInArray(select.options, selectedOption);
      select.select.dispatchEvent(new CustomEvent('change', {bubbles: true})); // trigger change event
    };
  
    function keyboardCustomSelect(select, direction) {
      var selectedOption = select.select.querySelector('[value="'+document.activeElement.getAttribute('data-value')+'"]');
      if(!selectedOption) return;
      var index = Util.getIndexInArray(select.options, selectedOption);
      
      index = direction == 'next' ? index + 1 : index - 1;
      if(index < 0) return;
      if(index >= select.options.length) return;
      
      var dropdownOption = select.dropdown.querySelector('[data-value="'+select.options[index].getAttribute('value')+'"]');
      if(dropdownOption) Util.moveFocus(dropdownOption);
    };
  
    //initialize the AdvSelect objects
    var advSelect = document.getElementsByClassName('js-adv-select');
    if( advSelect.length > 0 ) {
      for( var i = 0; i < advSelect.length; i++) {
        (function(i){new AdvSelect(advSelect[i]);})(i);
      }
    }
  }());
// File#: _2_comments
// Usage: codyhouse.co/license
(function() {
    function initVote(element) {
      var voteCounter = element.getElementsByClassName('js-comments__vote-label');
      element.addEventListener('click', function(){
        var pressed = element.getAttribute('aria-pressed') == 'true';
        element.setAttribute('aria-pressed', !pressed);
        Util.toggleClass(element, 'comments__vote-btn--pressed', !pressed);
        resetCounter(voteCounter, pressed);
        emitKeypressEvents(element, voteCounter, pressed);
      });
    };
  
    function resetCounter(voteCounter, pressed) { // update counter value (if present)
      if(voteCounter.length == 0) return;
      var count = parseInt(voteCounter[0].textContent);
      voteCounter[0].textContent = pressed ? count - 1 : count + 1;
    };
  
    function emitKeypressEvents(element, label, pressed) { // emit custom event when vote is updated
      var count = (label.length == 0) ? false : parseInt(label[0].textContent);
      var event = new CustomEvent('newVote', {detail: {count: count, upVote: !pressed}});
      element.dispatchEvent(event);
    };
  
    var voteCounting = document.getElementsByClassName('js-comments__vote-btn');
    if( voteCounting.length > 0 ) {
      for( var i = 0; i < voteCounting.length; i++) {
        (function(i){initVote(voteCounting[i]);})(i);
      }
    }
  }());
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
  
      var xPosition = isRight ? 'right: 0px; left: auto;' : 'left: 0px; right: auto;';
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
// File#: _2_table-of-contents
// Usage: codyhouse.co/license
(function() {
    var Toc = function(element) {
      this.element = element;
      this.list = this.element.getElementsByClassName('js-toc__list')[0];
      this.anchors = this.list.querySelectorAll('a[href^="#"]');
      this.sections = getSections(this);
      this.controller = this.element.getElementsByClassName('js-toc__control');
      this.controllerLabel = this.element.getElementsByClassName('js-toc__control-label');
      this.content = getTocContent(this);
      this.clickScrolling = false;
      this.intervalID = false;
      this.staticLayoutClass = 'toc--static';
      this.contentStaticLayoutClass = 'toc-content--toc-static';
      this.expandedClass = 'toc--expanded';
      this.isStatic = Util.hasClass(this.element, this.staticLayoutClass);
      this.layout = 'static';
      initToc(this);
    };
  
    function getSections(toc) {
      var sections = [];
      // get all content sections
      for(var i = 0; i < toc.anchors.length; i++) {
        var section = document.getElementById(toc.anchors[i].getAttribute('href').replace('#', ''));
        if(section) sections.push(section);
      }
      return sections;
    };
  
    function getTocContent(toc) {
      if(toc.sections.length < 1) return false;
      var content = toc.sections[0].closest('.js-toc-content');
      return content;
    };
  
    function initToc(toc) {
      checkTocLayour(toc); // switch between mobile and desktop layout
      if(toc.sections.length > 0) {
        // listen for click on anchors
        toc.list.addEventListener('click', function(event){
          var anchor = event.target.closest('a[href^="#"]');
          if(!anchor) return;
          // reset link apperance 
          toc.clickScrolling = true;
          resetAnchors(toc, anchor);
          // close toc if expanded on mobile
          toggleToc(toc, true);
        });
  
        // check when a new section enters the viewport
        var intersectionObserverSupported = ('IntersectionObserver' in window && 'IntersectionObserverEntry' in window && 'intersectionRatio' in window.IntersectionObserverEntry.prototype);
        if(intersectionObserverSupported) {
          var observer = new IntersectionObserver(
            function(entries, observer) { 
              entries.forEach(function(entry){
                if(!toc.clickScrolling) { // do not update classes if user clicked on a link
                  getVisibleSection(toc);
                }
              });
            }, 
            {
              threshold: [0, 0.1],
              rootMargin: "0px 0px -70% 0px"
            }
          );
  
          for(var i = 0; i < toc.sections.length; i++) {
            observer.observe(toc.sections[i]);
          }
        }
  
        // detect the end of scrolling -> reactivate IntersectionObserver on scroll
        toc.element.addEventListener('toc-scroll', function(event){
          toc.clickScrolling = false;
        });
      }
  
      // custom event emitted when window is resized
      toc.element.addEventListener('toc-resize', function(event){
        checkTocLayour(toc);
      });
  
      // collapsed version only (mobile)
      initCollapsedVersion(toc);
    };
  
    function resetAnchors(toc, anchor) {
      if(!anchor) return;
      for(var i = 0; i < toc.anchors.length; i++) Util.removeClass(toc.anchors[i], 'toc__link--selected');
      Util.addClass(anchor, 'toc__link--selected');
    };
  
    function getVisibleSection(toc) {
      if(toc.intervalID) {
        clearInterval(toc.intervalID);
      }
      toc.intervalID = setTimeout(function(){
        var halfWindowHeight = window.innerHeight/2,
        index = -1;
        for(var i = 0; i < toc.sections.length; i++) {
          var top = toc.sections[i].getBoundingClientRect().top;
          if(top < halfWindowHeight) index = i;
        }
        if(index > -1) {
          resetAnchors(toc, toc.anchors[index]);
        }
        toc.intervalID = false;
      }, 100);
    };
  
    function checkTocLayour(toc) {
      if(toc.isStatic) return;
      toc.layout = getComputedStyle(toc.element, ':before').getPropertyValue('content').replace(/\'|"/g, '');
      Util.toggleClass(toc.element, toc.staticLayoutClass, toc.layout == 'static');
      if(toc.content) Util.toggleClass(toc.content, toc.contentStaticLayoutClass, toc.layout == 'static');
    };
  
    function initCollapsedVersion(toc) { // collapsed version only (mobile)
      if(toc.controller.length < 1) return;
      
      // toggle nav visibility
      toc.controller[0].addEventListener('click', function(event){
        var isOpen = Util.hasClass(toc.element, toc.expandedClass);
        toggleToc(toc, isOpen);
      });
  
      // close expanded version on esc
      toc.element.addEventListener('keydown', function(event){
        if(toc.layout == 'static') return;
        if( (event.keyCode && event.keyCode == 27) || (event.key && event.key.toLowerCase() == 'escape') ) {
          toggleToc(toc, true);
          toc.controller[0].focus();
        }
      });
    };
  
    function toggleToc(toc, bool) { // collapsed version only (mobile)
      // toggle mobile version
      Util.toggleClass(toc.element, toc.expandedClass, !bool);
      bool ? toc.controller[0].removeAttribute('aria-expanded') : toc.controller[0].setAttribute('aria-expanded', 'true');
      if(!bool && toc.anchors.length > 0) {
        toc.anchors[0].focus();
      }
    };
    
    var tocs = document.getElementsByClassName('js-toc');
  
    var tocsArray = [];
    if( tocs.length > 0) {
      for( var i = 0; i < tocs.length; i++) {
        (function(i){ tocsArray.push(new Toc(tocs[i])); })(i);
      }
  
      // listen to window scroll -> reset clickScrolling property
      var scrollId = false,
        resizeId = false,
        scrollEvent = new CustomEvent('toc-scroll'),
        resizeEvent = new CustomEvent('toc-resize');
        
      window.addEventListener('scroll', function() {
        clearTimeout(scrollId);
        scrollId = setTimeout(doneScrolling, 100);
      });
  
      window.addEventListener('resize', function() {
        clearTimeout(resizeId);
        scrollId = setTimeout(doneResizing, 100);
      });
  
      function doneScrolling() {
        for( var i = 0; i < tocsArray.length; i++) {
          (function(i){tocsArray[i].element.dispatchEvent(scrollEvent)})(i);
        };
      };
  
      function doneResizing() {
        for( var i = 0; i < tocsArray.length; i++) {
          (function(i){tocsArray[i].element.dispatchEvent(resizeEvent)})(i);
        };
      };
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