// File#: _2_carousel
// Usage: codyhouse.co/license
(function() {
    var Carousel = function(opts) {
      this.options = Util.extend(Carousel.defaults , opts);
      this.element = this.options.element;
      this.listWrapper = this.element.getElementsByClassName('carousel__wrapper')[0];
      this.list = this.element.getElementsByClassName('carousel__list')[0];
      this.items = this.element.getElementsByClassName('carousel__item');
      this.initItems = []; // store only the original elements - will need this for cloning
      this.itemsNb = this.items.length; //original number of items
      this.visibItemsNb = 1; // tot number of visible items
      this.itemsWidth = 1; // this will be updated with the right width of items
      this.itemOriginalWidth = false; // store the initial width to use it on resize
      this.selectedItem = 0; // index of first visible item
      this.translateContainer = 0; // this will be the amount the container has to be translated each time a new group has to be shown (negative)
      this.containerWidth = 0; // this will be used to store the total width of the carousel (including the overflowing part)
      this.ariaLive = false;
      // navigation
      this.controls = this.element.getElementsByClassName('js-carousel__control');
      this.animating = false;
      // autoplay
      this.autoplayId = false;
      this.autoplayPaused = false;
      //drag
      this.dragStart = false;
      // resize
      this.resizeId = false;
      // used to re-initialize js
      this.cloneList = [];
      // store items min-width
      this.itemAutoSize = false;
      // store translate value (loop = off)
      this.totTranslate = 0;
      // modify loop option if navigation is on
      if(this.options.nav) this.options.loop = false;
      // store counter elements (if present)
      this.counter = this.element.getElementsByClassName('js-carousel__counter');
      this.counterTor = this.element.getElementsByClassName('js-carousel__counter-tot');
      initCarouselLayout(this); // get number visible items + width items
      setItemsWidth(this, true);
      insertBefore(this, this.visibItemsNb); // insert clones before visible elements
      updateCarouselClones(this); // insert clones after visible elements
      resetItemsTabIndex(this); // make sure not visible items are not focusable
      initAriaLive(this); // set aria-live region for SR
      initCarouselEvents(this); // listen to events
      initCarouselCounter(this);
      Util.addClass(this.element, 'carousel--loaded');
    };

    //public carousel functions
    Carousel.prototype.showNext = function() {
      showNextItems(this);
    };

    Carousel.prototype.showPrev = function() {
      showPrevItems(this);
    };

    Carousel.prototype.startAutoplay = function() {
      startAutoplay(this);
    };

    Carousel.prototype.pauseAutoplay = function() {
      pauseAutoplay(this);
    };

    //private carousel functions
    function initCarouselLayout(carousel) {
      // evaluate size of single elements + number of visible elements
      var itemStyle = window.getComputedStyle(carousel.items[0]),
        containerStyle = window.getComputedStyle(carousel.listWrapper),
        itemWidth = parseFloat(itemStyle.getPropertyValue('width')),
        itemMargin = parseFloat(itemStyle.getPropertyValue('margin-right')),
        containerPadding = parseFloat(containerStyle.getPropertyValue('padding-left')),
        containerWidth = parseFloat(containerStyle.getPropertyValue('width'));

      if(!carousel.itemAutoSize) {
        carousel.itemAutoSize = itemWidth;
      }

      // if carousel.listWrapper is hidden -> make sure to retrieve the proper width
      containerWidth = getCarouselWidth(carousel, containerWidth);

      if( !carousel.itemOriginalWidth) { // on resize -> use initial width of items to recalculate
        carousel.itemOriginalWidth = itemWidth;
      } else {
        itemWidth = carousel.itemOriginalWidth;
      }

      if(carousel.itemAutoSize) {
        carousel.itemOriginalWidth = parseInt(carousel.itemAutoSize);
        itemWidth = carousel.itemOriginalWidth;
      }
      // make sure itemWidth is smaller than container width
      if(containerWidth < itemWidth) {
        carousel.itemOriginalWidth = containerWidth
        itemWidth = carousel.itemOriginalWidth;
      }
      // get proper width of elements
      carousel.visibItemsNb = parseInt((containerWidth - 2*containerPadding + itemMargin)/(itemWidth+itemMargin));
      carousel.itemsWidth = parseFloat( (((containerWidth - 2*containerPadding + itemMargin)/carousel.visibItemsNb) - itemMargin).toFixed(1));
      carousel.containerWidth = (carousel.itemsWidth+itemMargin)* carousel.items.length;
      carousel.translateContainer = 0 - ((carousel.itemsWidth+itemMargin)* carousel.visibItemsNb);
      // flexbox fallback
      if(!flexSupported) carousel.list.style.width = (carousel.itemsWidth + itemMargin)*carousel.visibItemsNb*3+'px';

      // this is used when loop == off
      carousel.totTranslate = 0 - carousel.selectedItem*(carousel.itemsWidth+itemMargin);
      if(carousel.items.length <= carousel.visibItemsNb) carousel.totTranslate = 0;

      centerItems(carousel); // center items if carousel.items.length < visibItemsNb
      alignControls(carousel); // check if controls need to be aligned to a different element
    };

    function setItemsWidth(carousel, bool) {
      for(var i = 0; i < carousel.items.length; i++) {
        carousel.items[i].style.width = carousel.itemsWidth+"px";
        if(bool) carousel.initItems.push(carousel.items[i]);
      }
    };

    function updateCarouselClones(carousel) {
      if(!carousel.options.loop) return;
      // take care of clones after visible items (needs to run after the update of clones before visible items)
      if(carousel.items.length < carousel.visibItemsNb*3) {
        insertAfter(carousel, carousel.visibItemsNb*3 - carousel.items.length, carousel.items.length - carousel.visibItemsNb*2);
      } else if(carousel.items.length > carousel.visibItemsNb*3 ) {
        removeClones(carousel, carousel.visibItemsNb*3, carousel.items.length - carousel.visibItemsNb*3);
      }
      // set proper translate value for the container
      setTranslate(carousel, 'translateX('+carousel.translateContainer+'px)');
    };

    function initCarouselEvents(carousel) {
      // listen for click on previous/next arrow
      // dots navigation
      if(carousel.options.nav) {
        carouselCreateNavigation(carousel);
        carouselInitNavigationEvents(carousel);
      }

      if(carousel.controls.length > 0) {
        carousel.controls[0].addEventListener('click', function(event){
          event.preventDefault();
          showPrevItems(carousel);
          updateAriaLive(carousel);
        });
        carousel.controls[1].addEventListener('click', function(event){
          event.preventDefault();
          showNextItems(carousel);
          updateAriaLive(carousel);
        });

        // update arrow visility -> loop == off only
        resetCarouselControls(carousel);
        // emit custom event - items visible
        emitCarouselActiveItemsEvent(carousel)
      }
      // autoplay
      if(carousel.options.autoplay) {
        startAutoplay(carousel);
        // pause autoplay if user is interacting with the carousel
        if(!carousel.options.autoplayOnHover) {
          carousel.element.addEventListener('mouseenter', function(event){
            pauseAutoplay(carousel);
            carousel.autoplayPaused = true;
          });
          carousel.element.addEventListener('mouseleave', function(event){
            carousel.autoplayPaused = false;
            startAutoplay(carousel);
          });
        }
        if(!carousel.options.autoplayOnFocus) {
          carousel.element.addEventListener('focusin', function(event){
            pauseAutoplay(carousel);
            carousel.autoplayPaused = true;
          });

          carousel.element.addEventListener('focusout', function(event){
            carousel.autoplayPaused = false;
            startAutoplay(carousel);
          });
        }
      }
      // drag events
      if(carousel.options.drag && window.requestAnimationFrame) {
        //init dragging
        new SwipeContent(carousel.element);
        carousel.element.addEventListener('dragStart', function(event){
          if(event.detail.origin && event.detail.origin.closest('.js-carousel__control')) return;
          if(event.detail.origin && event.detail.origin.closest('.js-carousel__navigation')) return;
          if(event.detail.origin && !event.detail.origin.closest('.carousel__wrapper')) return;
          Util.addClass(carousel.element, 'carousel--is-dragging');
          pauseAutoplay(carousel);
          carousel.dragStart = event.detail.x;
          animateDragEnd(carousel);
        });
        carousel.element.addEventListener('dragging', function(event){
          if(!carousel.dragStart) return;
          if(carousel.animating || Math.abs(event.detail.x - carousel.dragStart) < 10) return;
          var translate = event.detail.x - carousel.dragStart + carousel.translateContainer;
          if(!carousel.options.loop) {
            translate = event.detail.x - carousel.dragStart + carousel.totTranslate;
          }
          setTranslate(carousel, 'translateX('+translate+'px)');
        });
      }
      // reset on resize
      window.addEventListener('resize', function(event){
        pauseAutoplay(carousel);
        clearTimeout(carousel.resizeId);
        carousel.resizeId = setTimeout(function(){
          resetCarouselResize(carousel);
          // reset dots navigation
          resetDotsNavigation(carousel);
          resetCarouselControls(carousel);
          setCounterItem(carousel);
          startAutoplay(carousel);
          centerItems(carousel); // center items if carousel.items.length < visibItemsNb
          alignControls(carousel);
          // emit custom event - items visible
          emitCarouselActiveItemsEvent(carousel)
        }, 250)
      });
      // keyboard navigation
      carousel.element.addEventListener('keydown', function(event){
        if(event.keyCode && event.keyCode == 39 || event.key && event.key.toLowerCase() == 'arrowright') {
          carousel.showNext();
        } else if(event.keyCode && event.keyCode == 37 || event.key && event.key.toLowerCase() == 'arrowleft') {
          carousel.showPrev();
        }
      });
    };

    function showPrevItems(carousel) {
      if(carousel.animating) return;
      carousel.animating = true;
      carousel.selectedItem = getIndex(carousel, carousel.selectedItem - carousel.visibItemsNb);
      animateList(carousel, '0', 'prev');
    };

    function showNextItems(carousel) {
      if(carousel.animating) return;
      carousel.animating = true;
      carousel.selectedItem = getIndex(carousel, carousel.selectedItem + carousel.visibItemsNb);
      animateList(carousel, carousel.translateContainer*2+'px', 'next');
    };

    function animateDragEnd(carousel) { // end-of-dragging animation
      carousel.element.addEventListener('dragEnd', function cb(event){
        carousel.element.removeEventListener('dragEnd', cb);
        Util.removeClass(carousel.element, 'carousel--is-dragging');
        if(event.detail.x - carousel.dragStart < -40) {
          carousel.animating = false;
          showNextItems(carousel);
        } else if(event.detail.x - carousel.dragStart > 40) {
          carousel.animating = false;
          showPrevItems(carousel);
        } else if(event.detail.x - carousel.dragStart == 0) { // this is just a click -> no dragging
          return;
        } else { // not dragged enought -> do not update carousel, just reset
          carousel.animating = true;
          animateList(carousel, carousel.translateContainer+'px', false);
        }
        carousel.dragStart = false;
      });
    };

    function animateList(carousel, translate, direction) { // takes care of changing visible items
      pauseAutoplay(carousel);
      Util.addClass(carousel.list, 'carousel__list--animating');
      var initTranslate = carousel.totTranslate;
      if(!carousel.options.loop) {
        translate = noLoopTranslateValue(carousel, direction);
      }
      setTimeout(function() {setTranslate(carousel, 'translateX('+translate+')');});
      if(transitionSupported) {
        carousel.list.addEventListener('transitionend', function cb(event){
          if(event.propertyName && event.propertyName != 'transform') return;
          Util.removeClass(carousel.list, 'carousel__list--animating');
          carousel.list.removeEventListener('transitionend', cb);
          animateListCb(carousel, direction);
        });
      } else {
        animateListCb(carousel, direction);
      }
      if(!carousel.options.loop && (initTranslate == carousel.totTranslate)) {
        // translate value was not updated -> trigger transitionend event to restart carousel
        carousel.list.dispatchEvent(new CustomEvent('transitionend'));
      }
      resetCarouselControls(carousel);
      setCounterItem(carousel);
      // emit custom event - items visible
      emitCarouselActiveItemsEvent(carousel)
    };

    function noLoopTranslateValue(carousel, direction) {
      var translate = carousel.totTranslate;
      if(direction == 'next') {
        translate = carousel.totTranslate + carousel.translateContainer;
      } else if(direction == 'prev') {
        translate = carousel.totTranslate - carousel.translateContainer;
      } else if(direction == 'click') {
        translate = carousel.selectedDotIndex*carousel.translateContainer;
      }
      if(translate > 0)  {
        translate = 0;
        carousel.selectedItem = 0;
      }
      if(translate < - carousel.translateContainer - carousel.containerWidth) {
        translate = - carousel.translateContainer - carousel.containerWidth;
        carousel.selectedItem = carousel.items.length - carousel.visibItemsNb;
      }
      if(carousel.visibItemsNb > carousel.items.length) translate = 0;
      carousel.totTranslate = translate;
      return translate + 'px';
    };

    function animateListCb(carousel, direction) { // reset actions after carousel has been updated
      if(direction) updateClones(carousel, direction);
      carousel.animating = false;
      // reset autoplay
      startAutoplay(carousel);
      // reset tab index
      resetItemsTabIndex(carousel);
    };

    function updateClones(carousel, direction) {
      if(!carousel.options.loop) return;
      // at the end of each animation, we need to update the clones before and after the visible items
      var index = (direction == 'next') ? 0 : carousel.items.length - carousel.visibItemsNb;
      // remove clones you do not need anymore
      removeClones(carousel, index, false);
      // add new clones
      (direction == 'next') ? insertAfter(carousel, carousel.visibItemsNb, 0) : insertBefore(carousel, carousel.visibItemsNb);
      //reset transform
      setTranslate(carousel, 'translateX('+carousel.translateContainer+'px)');
    };

    function insertBefore(carousel, nb, delta) {
      if(!carousel.options.loop) return;
      var clones = document.createDocumentFragment();
      var start = 0;
      if(delta) start = delta;
      for(var i = start; i < nb; i++) {
        var index = getIndex(carousel, carousel.selectedItem - i - 1),
          clone = carousel.initItems[index].cloneNode(true);
        Util.addClass(clone, 'js-clone');
        clones.insertBefore(clone, clones.firstChild);
      }
      carousel.list.insertBefore(clones, carousel.list.firstChild);
      emitCarouselUpdateEvent(carousel);
    };

    function insertAfter(carousel, nb, init) {
      if(!carousel.options.loop) return;
      var clones = document.createDocumentFragment();
      for(var i = init; i < nb + init; i++) {
        var index = getIndex(carousel, carousel.selectedItem + carousel.visibItemsNb + i),
          clone = carousel.initItems[index].cloneNode(true);
        Util.addClass(clone, 'js-clone');
        clones.appendChild(clone);
      }
      carousel.list.appendChild(clones);
      emitCarouselUpdateEvent(carousel);
    };

    function removeClones(carousel, index, bool) {
      if(!carousel.options.loop) return;
      if( !bool) {
        bool = carousel.visibItemsNb;
      }
      for(var i = 0; i < bool; i++) {
        if(carousel.items[index]) carousel.list.removeChild(carousel.items[index]);
      }
    };

    function resetCarouselResize(carousel) { // reset carousel on resize
      var visibleItems = carousel.visibItemsNb;
      // get new items min-width value
      resetItemAutoSize(carousel);
      initCarouselLayout(carousel);
      setItemsWidth(carousel, false);
      resetItemsWidth(carousel); // update the array of original items -> array used to create clones
      if(carousel.options.loop) {
        if(visibleItems > carousel.visibItemsNb) {
          removeClones(carousel, 0, visibleItems - carousel.visibItemsNb);
        } else if(visibleItems < carousel.visibItemsNb) {
          insertBefore(carousel, carousel.visibItemsNb, visibleItems);
        }
        updateCarouselClones(carousel); // this will take care of translate + after elements
      } else {
        // reset default translate to a multiple value of (itemWidth + margin)
        var translate = noLoopTranslateValue(carousel);
        setTranslate(carousel, 'translateX('+translate+')');
      }
      resetItemsTabIndex(carousel); // reset focusable elements
    };

    function resetItemAutoSize(carousel) {
      if(!cssPropertiesSupported) return;
      // remove inline style
      carousel.items[0].removeAttribute('style');
      // get original item width
      carousel.itemAutoSize = getComputedStyle(carousel.items[0]).getPropertyValue('width');
    };

    function resetItemsWidth(carousel) {
      for(var i = 0; i < carousel.initItems.length; i++) {
        carousel.initItems[i].style.width = carousel.itemsWidth+"px";
      }
    };

    function resetItemsTabIndex(carousel) {
      var carouselActive = carousel.items.length > carousel.visibItemsNb;
      var j = carousel.items.length;
      for(var i = 0; i < carousel.items.length; i++) {
        if(carousel.options.loop) {
          if(i < carousel.visibItemsNb || i >= 2*carousel.visibItemsNb ) {
            carousel.items[i].setAttribute('tabindex', '-1');
          } else {
            if(i < j) j = i;
            carousel.items[i].removeAttribute('tabindex');
          }
        } else {
          if( (i < carousel.selectedItem || i >= carousel.selectedItem + carousel.visibItemsNb) && carouselActive) {
            carousel.items[i].setAttribute('tabindex', '-1');
          } else {
            if(i < j) j = i;
            carousel.items[i].removeAttribute('tabindex');
          }
        }
      }
      resetVisibilityOverflowItems(carousel, j);
    };

    function startAutoplay(carousel) {
      if(carousel.options.autoplay && !carousel.autoplayId && !carousel.autoplayPaused) {
        carousel.autoplayId = setInterval(function(){
          showNextItems(carousel);
        }, carousel.options.autoplayInterval);
      }
    };

    function pauseAutoplay(carousel) {
      if(carousel.options.autoplay) {
        clearInterval(carousel.autoplayId);
        carousel.autoplayId = false;
      }
    };

    function initAriaLive(carousel) { // create an aria-live region for SR
      if(!carousel.options.ariaLive) return;
      // create an element that will be used to announce the new visible slide to SR
      var srLiveArea = document.createElement('div');
      Util.setAttributes(srLiveArea, {'class': 'sr-only js-carousel__aria-live', 'aria-live': 'polite', 'aria-atomic': 'true'});
      carousel.element.appendChild(srLiveArea);
      carousel.ariaLive = srLiveArea;
    };

    function updateAriaLive(carousel) { // announce to SR which items are now visible
      if(!carousel.options.ariaLive) return;
      carousel.ariaLive.innerHTML = 'Item '+(carousel.selectedItem + 1)+' selected. '+carousel.visibItemsNb+' items of '+carousel.initItems.length+' visible';
    };

    function getIndex(carousel, index) {
      if(index < 0) index = getPositiveValue(index, carousel.itemsNb);
      if(index >= carousel.itemsNb) index = index % carousel.itemsNb;
      return index;
    };

    function getPositiveValue(value, add) {
      value = value + add;
      if(value > 0) return value;
      else return getPositiveValue(value, add);
    };

    function setTranslate(carousel, translate) {
      carousel.list.style.transform = translate;
      carousel.list.style.msTransform = translate;
    };

    function getCarouselWidth(carousel, computedWidth) { // retrieve carousel width if carousel is initially hidden
      var closestHidden = carousel.listWrapper.closest('.sr-only');
      if(closestHidden) { // carousel is inside an .sr-only (visually hidden) element
        Util.removeClass(closestHidden, 'sr-only');
        computedWidth = carousel.listWrapper.offsetWidth;
        Util.addClass(closestHidden, 'sr-only');
      } else if(isNaN(computedWidth)){
        computedWidth = getHiddenParentWidth(carousel.element, carousel);
      }
      return computedWidth;
    };

    function getHiddenParentWidth(element, carousel) {
      var parent = element.parentElement;
      if(parent.tagName.toLowerCase() == 'html') return 0;
      var style = window.getComputedStyle(parent);
      if(style.display == 'none' || style.visibility == 'hidden') {
        parent.setAttribute('style', 'display: block!important; visibility: visible!important;');
        var computedWidth = carousel.listWrapper.offsetWidth;
        parent.style.display = '';
        parent.style.visibility = '';
        return computedWidth;
      } else {
        return getHiddenParentWidth(parent, carousel);
      }
    };

    function resetCarouselControls(carousel) {
      if(carousel.options.loop) return;
      // update arrows status
      if(carousel.controls.length > 0) {
        (carousel.totTranslate == 0)
          ? carousel.controls[0].setAttribute('disabled', true)
          : carousel.controls[0].removeAttribute('disabled');
        (carousel.totTranslate == (- carousel.translateContainer - carousel.containerWidth) || carousel.items.length <= carousel.visibItemsNb)
          ? carousel.controls[1].setAttribute('disabled', true)
          : carousel.controls[1].removeAttribute('disabled');
      }
      // update carousel dots
      if(carousel.options.nav) {
        var selectedDot = carousel.navigation.getElementsByClassName(carousel.options.navigationItemClass+'--selected');
        if(selectedDot.length > 0) Util.removeClass(selectedDot[0], carousel.options.navigationItemClass+'--selected');

        var newSelectedIndex = getSelectedDot(carousel);
        if(carousel.totTranslate == (- carousel.translateContainer - carousel.containerWidth)) {
          newSelectedIndex = carousel.navDots.length - 1;
        }
        Util.addClass(carousel.navDots[newSelectedIndex], carousel.options.navigationItemClass+'--selected');
      }

      (carousel.totTranslate == 0 && (carousel.totTranslate == (- carousel.translateContainer - carousel.containerWidth) || carousel.items.length <= carousel.visibItemsNb))
          ? Util.addClass(carousel.element, 'carousel--hide-controls')
          : Util.removeClass(carousel.element, 'carousel--hide-controls');
    };

    function emitCarouselUpdateEvent(carousel) {
      carousel.cloneList = [];
      var clones = carousel.element.querySelectorAll('.js-clone');
      for(var i = 0; i < clones.length; i++) {
        Util.removeClass(clones[i], 'js-clone');
        carousel.cloneList.push(clones[i]);
      }
      emitCarouselEvents(carousel, 'carousel-updated', carousel.cloneList);
    };

    function carouselCreateNavigation(carousel) {
      if(carousel.element.getElementsByClassName('js-carousel__navigation').length > 0) return;

      var navigation = document.createElement('ol'),
        navChildren = '';

      var navClasses = carousel.options.navigationClass+' js-carousel__navigation';
      if(carousel.items.length <= carousel.visibItemsNb) {
        navClasses = navClasses + ' is-hidden';
      }
      navigation.setAttribute('class', navClasses);

      var dotsNr = Math.ceil(carousel.items.length/carousel.visibItemsNb),
        selectedDot = getSelectedDot(carousel),
        indexClass = carousel.options.navigationPagination ? '' : 'sr-only'
      for(var i = 0; i < dotsNr; i++) {
        var className = (i == selectedDot) ? 'class="'+carousel.options.navigationItemClass+' '+carousel.options.navigationItemClass+'--selected js-carousel__nav-item"' :  'class="'+carousel.options.navigationItemClass+' js-carousel__nav-item"';
        navChildren = navChildren + '<li '+className+'><button class="reset js-tab-focus" style="outline: none;"><span class="'+indexClass+'">'+ (i+1) + '</span></button></li>';
      }
      navigation.innerHTML = navChildren;
      carousel.element.appendChild(navigation);
    };

    function carouselInitNavigationEvents(carousel) {
      carousel.navigation = carousel.element.getElementsByClassName('js-carousel__navigation')[0];
      carousel.navDots = carousel.element.getElementsByClassName('js-carousel__nav-item');
      carousel.navIdEvent = carouselNavigationClick.bind(carousel);
      carousel.navigation.addEventListener('click', carousel.navIdEvent);
    };

    function carouselRemoveNavigation(carousel) {
      if(carousel.navigation) carousel.element.removeChild(carousel.navigation);
      if(carousel.navIdEvent) carousel.navigation.removeEventListener('click', carousel.navIdEvent);
    };

    function resetDotsNavigation(carousel) {
      if(!carousel.options.nav) return;
      carouselRemoveNavigation(carousel);
      carouselCreateNavigation(carousel);
      carouselInitNavigationEvents(carousel);
    };

    function carouselNavigationClick(event) {
      var dot = event.target.closest('.js-carousel__nav-item');
      if(!dot) return;
      if(this.animating) return;
      this.animating = true;
      var index = Util.getIndexInArray(this.navDots, dot);
      this.selectedDotIndex = index;
      this.selectedItem = index*this.visibItemsNb;
      animateList(this, false, 'click');
    };

    function getSelectedDot(carousel) {
      return Math.ceil(carousel.selectedItem/carousel.visibItemsNb);
    };

    function initCarouselCounter(carousel) {
      if(carousel.counterTor.length > 0) carousel.counterTor[0].textContent = carousel.itemsNb;
      setCounterItem(carousel);
    };

    function setCounterItem(carousel) {
      if(carousel.counter.length == 0) return;
      var totalItems = carousel.selectedItem + carousel.visibItemsNb;
      if(totalItems > carousel.items.length) totalItems = carousel.items.length;
      carousel.counter[0].textContent = totalItems;
    };

    function centerItems(carousel) {
      if(!carousel.options.justifyContent) return;
      Util.toggleClass(carousel.list, 'justify-center', carousel.items.length < carousel.visibItemsNb);
    };

    function alignControls(carousel) {
      if(carousel.controls.length < 1 || !carousel.options.alignControls) return;
      if(!carousel.controlsAlignEl) {
        carousel.controlsAlignEl = carousel.element.querySelector(carousel.options.alignControls);
      }
      if(!carousel.controlsAlignEl) return;
      var translate = (carousel.element.offsetHeight - carousel.controlsAlignEl.offsetHeight);
      for(var i = 0; i < carousel.controls.length; i++) {
        carousel.controls[i].style.marginBottom = translate + 'px';
      }
    };

    function emitCarouselActiveItemsEvent(carousel) {
      emitCarouselEvents(carousel, 'carousel-active-items', {firstSelectedItem: carousel.selectedItem, visibleItemsNb: carousel.visibItemsNb});
    };

    function emitCarouselEvents(carousel, eventName, eventDetail) {
      var event = new CustomEvent(eventName, {detail: eventDetail});
      carousel.element.dispatchEvent(event);
    };

    function resetVisibilityOverflowItems(carousel, j) {
      if(!carousel.options.overflowItems) return;
      var itemWidth = carousel.containerWidth/carousel.items.length,
        delta = (window.innerWidth - itemWidth*carousel.visibItemsNb)/2,
        overflowItems = Math.ceil(delta/itemWidth);

      for(var i = 0; i < overflowItems; i++) {
        var indexPrev = j - 1 - i; // prev element
        if(indexPrev >= 0 ) carousel.items[indexPrev].removeAttribute('tabindex');
        var indexNext = j + carousel.visibItemsNb + i; // next element
        if(indexNext < carousel.items.length) carousel.items[indexNext].removeAttribute('tabindex');
      }
    };

    Carousel.defaults = {
      element : '',
      autoplay : false,
      autoplayOnHover: false,
      autoplayOnFocus: false,
      autoplayInterval: 5000,
      loop: true,
      nav: false,
      navigationItemClass: 'carousel__nav-item',
      navigationClass: 'carousel__navigation',
      navigationPagination: false,
      drag: false,
      justifyContent: false,
      alignControls: false,
      overflowItems: false
    };

    window.Carousel = Carousel;

    //initialize the Carousel objects
    var carousels = document.getElementsByClassName('js-carousel'),
      flexSupported = Util.cssSupports('align-items', 'stretch'),
      transitionSupported = Util.cssSupports('transition'),
      cssPropertiesSupported = ('CSS' in window && CSS.supports('color', 'var(--color-var)'));

    if( carousels.length > 0) {
      for( var i = 0; i < carousels.length; i++) {
        (function(i){
          var autoplay = (carousels[i].getAttribute('data-autoplay') && carousels[i].getAttribute('data-autoplay') == 'on') ? true : false,
            autoplayInterval = (carousels[i].getAttribute('data-autoplay-interval')) ? carousels[i].getAttribute('data-autoplay-interval') : 5000,
            autoplayOnHover = (carousels[i].getAttribute('data-autoplay-hover') && carousels[i].getAttribute('data-autoplay-hover') == 'on') ? true : false,
            autoplayOnFocus = (carousels[i].getAttribute('data-autoplay-focus') && carousels[i].getAttribute('data-autoplay-focus') == 'on') ? true : false,
            drag = (carousels[i].getAttribute('data-drag') && carousels[i].getAttribute('data-drag') == 'on') ? true : false,
            loop = (carousels[i].getAttribute('data-loop') && carousels[i].getAttribute('data-loop') == 'off') ? false : true,
            nav = (carousels[i].getAttribute('data-navigation') && carousels[i].getAttribute('data-navigation') == 'on') ? true : false,
            navigationItemClass = carousels[i].getAttribute('data-navigation-item-class') ? carousels[i].getAttribute('data-navigation-item-class') : 'carousel__nav-item',
            navigationClass = carousels[i].getAttribute('data-navigation-class') ? carousels[i].getAttribute('data-navigation-class') : 'carousel__navigation',
            navigationPagination = (carousels[i].getAttribute('data-navigation-pagination') && carousels[i].getAttribute('data-navigation-pagination') == 'on') ? true : false,
            overflowItems = (carousels[i].getAttribute('data-overflow-items') && carousels[i].getAttribute('data-overflow-items') == 'on') ? true : false,
            alignControls = carousels[i].getAttribute('data-align-controls') ? carousels[i].getAttribute('data-align-controls') : false,
            justifyContent = (carousels[i].getAttribute('data-justify-content') && carousels[i].getAttribute('data-justify-content') == 'on') ? true : false;
          new Carousel({element: carousels[i], autoplay : autoplay, autoplayOnHover: autoplayOnHover, autoplayOnFocus: autoplayOnFocus,autoplayInterval : autoplayInterval, drag: drag, ariaLive: true, loop: loop, nav: nav, navigationItemClass: navigationItemClass, navigationPagination: navigationPagination, navigationClass: navigationClass, overflowItems: overflowItems, justifyContent: justifyContent, alignControls: alignControls});
        })(i);
      }
    };
  }());
