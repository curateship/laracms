// File#: _1_lazy-load
// Usage: codyhouse.co/license
(function() {
    var LazyLoad = function(elements) {
      this.elements = elements;
      initLazyLoad(this);
    };
  
    function initLazyLoad(asset) {
      if(lazySupported) setAssetsSrc(asset);
      else if(intersectionObsSupported) observeAssets(asset);
      else scrollAsset(asset);
    };
  
    function setAssetsSrc(asset) {
      for(var i = 0; i < asset.elements.length; i++) {
        if(asset.elements[i].getAttribute('data-bg') || asset.elements[i].tagName.toLowerCase() == 'picture') { // this could be an element with a bg image or a <source> element inside a <picture>
          observeSingleAsset(asset.elements[i]);
        } else {
          setSingleAssetSrc(asset.elements[i]);
        } 
      }
    };
  
    function setSingleAssetSrc(img) {
      if(img.tagName.toLowerCase() == 'picture') {
        setPictureSrc(img);
      } else {
        setSrcSrcset(img);
        var bg = img.getAttribute('data-bg');
        if(bg) img.style.backgroundImage = bg;
        if(!lazySupported || bg) img.removeAttribute("loading");
      }
    };
  
    function setPictureSrc(picture) {
      var pictureChildren = picture.children;
      for(var i = 0; i < pictureChildren.length; i++) setSrcSrcset(pictureChildren[i]);
      picture.removeAttribute("loading");
    };
  
    function setSrcSrcset(img) {
      var src = img.getAttribute('data-src');
      if(src) img.src = src;
      var srcset = img.getAttribute('data-srcset');
      if(srcset) img.srcset = srcset;
    };
  
    function observeAssets(asset) {
      for(var i = 0; i < asset.elements.length; i++) {
        observeSingleAsset(asset.elements[i]);
      }
    };
  
    function observeSingleAsset(img) {
      if( !img.getAttribute('data-src') && !img.getAttribute('data-srcset') && !img.getAttribute('data-bg') && img.tagName.toLowerCase() != 'picture') return; // using the native lazyload with no need js lazy-loading
  
      var threshold = img.getAttribute('data-threshold') || '200px';
      var config = {rootMargin: threshold};
      var observer = new IntersectionObserver(observerLoadContent.bind(img), config);
      observer.observe(img);
    };
  
    function observerLoadContent(entries, observer) { 
      if(entries[0].isIntersecting) {
        setSingleAssetSrc(this);
        observer.unobserve(this);
      }
    };
  
    function scrollAsset(asset) {
      asset.elements = Array.prototype.slice.call(asset.elements);
      asset.listening = false;
      asset.scrollListener = eventLazyLoad.bind(asset);
      document.addEventListener("scroll", asset.scrollListener);
      asset.resizeListener = eventLazyLoad.bind(asset);
      document.addEventListener("resize", asset.resizeListener);
      eventLazyLoad.bind(asset)(); // trigger before starting scrolling/resizing
    };
  
    function eventLazyLoad() {
      var self = this;
      if(self.listening) return;
      self.listening = true;
      setTimeout(function() {
        for(var i = 0; i < self.elements.length; i++) {
          if ((self.elements[i].getBoundingClientRect().top <= window.innerHeight && self.elements[i].getBoundingClientRect().bottom >= 0) && getComputedStyle(self.elements[i]).display !== "none") {
            setSingleAssetSrc(self.elements[i]);
  
            self.elements = self.elements.filter(function(image) {
              return image.hasAttribute("loading");
            });
  
            if (self.elements.length === 0) {
              if(self.scrollListener) document.removeEventListener("scroll", self.scrollListener);
              if(self.resizeListener) window.removeEventListener("resize", self.resizeListener);
            }
          }
        }
        self.listening = false;
      }, 200);
    };
  
    window.LazyLoad = LazyLoad;
  
    var lazyLoads = document.querySelectorAll('[loading="lazy"]'),
      lazySupported = 'loading' in HTMLImageElement.prototype,
      intersectionObsSupported = ('IntersectionObserver' in window && 'IntersectionObserverEntry' in window && 'intersectionRatio' in window.IntersectionObserverEntry.prototype);
    
    if( lazyLoads.length > 0 ) {
      new LazyLoad(lazyLoads);
    };
    
  }());