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