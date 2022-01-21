// File#: _3_main-header-v2
// Usage: codyhouse.co/license
(function() {
    var Submenu = function(element) {
        this.element = element;
        this.trigger = this.element.getElementsByClassName('header-v2__nav-link')[0];
        this.dropdown = this.element.getElementsByClassName('header-v2__nav-dropdown')[0];
        this.triggerFocus = false;
        this.dropdownFocus = false;
        this.hideInterval = false;
        this.prevFocus = false; // nested dropdown - store element that was in focus before focus changed

        if (typeof this.trigger !== 'undefined' && typeof this.dropdown !== 'undefined') {
            initSubmenu(this);
            initNestedDropdown(this);
        }
    };

    function initSubmenu(list) {
        // initElementEvents(list, list.trigger);
        initElementEvents(list, list.dropdown);
    };

    function initElementEvents(list, element, bool) {
        element.addEventListener('focus', function(){
            bool = true;
            showDropdown(list);
        });
        element.addEventListener('focusout', function(event){
            bool = false;
            hideDropdown(list, event);
        });
    };

    function showDropdown(list) {
        if(list.hideInterval) clearInterval(list.hideInterval);
        Util.addClass(list.dropdown, 'header-v2__nav-list--is-visible');
        resetDropdownStyle(list.dropdown, true);
    };

    function hideDropdown(list, event) {
        if(list.hideInterval) clearInterval(this.hideInterval);
        list.hideInterval = setTimeout(function(){
            var submenuFocus = document.activeElement.closest('.header-v2__nav-item--main'),
                inFocus = submenuFocus && (submenuFocus == list.element);
            if(!list.triggerFocus && !list.dropdownFocus && !inFocus) { // hide if focus is outside submenu
                Util.removeClass(list.dropdown, 'header-v2__nav-list--is-visible');
                resetDropdownStyle(list.dropdown, false);
                hideSubLevels(list);
                list.prevFocus = false;
            }
        }, 100);
    };

    function initNestedDropdown(list) {
        var dropdownMenu = list.element.getElementsByClassName('header-v2__nav-list');
        for(var i = 0; i < dropdownMenu.length; i++) {
            var listItems = dropdownMenu[i].children;
            // bind hover
            new menuAim({
                menu: dropdownMenu[i],
                activate: function(row) {
                    var subList = row.getElementsByClassName('header-v2__nav-dropdown')[0];
                    if(!subList) return;
                    Util.addClass(row.querySelector('a.header-v2__nav-link'), 'header-v2__nav-link--hover');
                    showLevel(list, subList);
                },
                deactivate: function(row) {
                    var subList = row.getElementsByClassName('header-v2__nav-dropdown')[0];
                    if(!subList) return;
                    Util.removeClass(row.querySelector('a.header-v2__nav-link'), 'header-v2__nav-link--hover');
                    hideLevel(list, subList);
                },
                exitMenu: function() {
                    return true;
                },
                submenuSelector: '.header-v2__nav-item--has-children',
            });
        }
        // store focus element before change in focus
        list.element.addEventListener('keydown', function(event) {
            if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
                list.prevFocus = document.activeElement;
            }
        });
        // make sure that sublevel are visible when their items are in focus
        list.element.addEventListener('keyup', function(event) {
            if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
                // focus has been moved -> make sure the proper classes are added to subnavigation
                var focusElement = document.activeElement,
                    focusElementParent = focusElement.closest('.header-v2__nav-dropdown'),
                    focusElementSibling = focusElement.nextElementSibling;

                // if item in focus is inside submenu -> make sure it is visible
                if(focusElementParent && !Util.hasClass(focusElementParent, 'header-v2__nav-list--is-visible')) {
                    showLevel(list, focusElementParent);
                }
                // if item in focus triggers a submenu -> make sure it is visible
                if(focusElementSibling && !Util.hasClass(focusElementSibling, 'header-v2__nav-list--is-visible')) {
                    showLevel(list, focusElementSibling);
                }

                // check previous element in focus -> hide sublevel if required
                if( !list.prevFocus) return;
                var prevFocusElementParent = list.prevFocus.closest('.header-v2__nav-dropdown'),
                    prevFocusElementSibling = list.prevFocus.nextElementSibling;

                if( !prevFocusElementParent ) return;

                // element in focus and element prev in focus are siblings
                if( focusElementParent && focusElementParent == prevFocusElementParent) {
                    if(prevFocusElementSibling) hideLevel(list, prevFocusElementSibling);
                    return;
                }

                // element in focus is inside submenu triggered by element prev in focus
                if( prevFocusElementSibling && focusElementParent && focusElementParent == prevFocusElementSibling) return;

                // shift tab -> element in focus triggers the submenu of the element prev in focus
                if( focusElementSibling && prevFocusElementParent && focusElementSibling == prevFocusElementParent) return;

                var focusElementParentParent = focusElementParent.parentNode.closest('.header-v2__nav-dropdown');

                // shift tab -> element in focus is inside the dropdown triggered by a siblings of the element prev in focus
                if(focusElementParentParent && focusElementParentParent == prevFocusElementParent) {
                    if(prevFocusElementSibling) hideLevel(list, prevFocusElementSibling);
                    return;
                }

                if(prevFocusElementParent && Util.hasClass(prevFocusElementParent, 'header-v2__nav-list--is-visible')) {
                    hideLevel(list, prevFocusElementParent);
                }
            }
        });
    };

    function hideSubLevels(list) {
        var visibleSubLevels = list.dropdown.getElementsByClassName('header-v2__nav-list--is-visible');
        if(visibleSubLevels.length == 0) return;
        while (visibleSubLevels[0]) {
            hideLevel(list, visibleSubLevels[0]);
        }
        var hoveredItems = list.dropdown.getElementsByClassName('header-v2__nav-link--hover');
        while (hoveredItems[0]) {
            Util.removeClass(hoveredItems[0], 'header-v2__nav-link--hover');
        }
    };

    function showLevel(list, level, bool) {
        if(bool == undefined) {
            //check if the sublevel needs to be open to the left
            Util.removeClass(level, 'header-v2__nav-dropdown--nested-left');
            var boundingRect = level.getBoundingClientRect();
            if(window.innerWidth - boundingRect.right < 5 && boundingRect.left + window.scrollX > 2*boundingRect.width) Util.addClass(level, 'header-v2__nav-dropdown--nested-left');
        }
        Util.addClass(level, 'header-v2__nav-list--is-visible');
    };

    function hideLevel(list, level) {
        if(!Util.hasClass(level, 'header-v2__nav-list--is-visible')) return;
        Util.removeClass(level, 'header-v2__nav-list--is-visible');

        level.addEventListener('transition', function cb(){
            level.removeEventListener('transition', cb);
            Util.removeClass(level, 'header-v2__nav-dropdown--nested-left');
        });
    };

    var mainHeader = document.getElementsByClassName('js-header-v2');
    if(mainHeader.length > 0) {
        var menuTrigger = mainHeader[0].getElementsByClassName('js-anim-menu-btn');

        // we'll use these to store the node that needs to receive focus when the mobile menu is closed
        var focusMenu = false;

        // Version 2: To support multiple sub menus
        for (var i=0; i < menuTrigger.length; i++) {
            menuTrigger[i].addEventListener('anim-menu-btn-clicked', function(event){ // toggle menu visibility an small devices
                // Get destination menu
                var targetMenu = document.getElementById(this.getAttribute('menu-target'));

                // Check if current target is opened
                var isExpanded = Util.hasClass(targetMenu, 'header-v2__nav--is-visible');

                // Check if other menu is already opened
                var isExpandedOther = document.getElementsByClassName('header-v2__nav--is-visible').length > 0 ? true : false;

                // Hide all other menus
                var subMenus = mainHeader[0].getElementsByClassName('header-v2__nav--is-visible');
                for (var j=0; j < subMenus.length; j++) {
                    Util.removeClass(subMenus[j], 'header-v2__nav--is-visible');
                }

                // Reset all menu trigger button switch
                var triggers = mainHeader[0].getElementsByClassName('js-anim-menu-btn');
                for (var j=0; j < triggers.length; j++) {
                    if (triggers[j] !== this) {
                        triggers[j].setAttribute('aria-expanded', false);
                    }
                }
                var openedTriggers1 = mainHeader[0].getElementsByClassName('anim-menu-btn--state-b');
                for (var j=0; j < openedTriggers1.length; j++) {
                    if (openedTriggers1[j] !== this) {
                        Util.removeClass(openedTriggers1[j], 'anim-menu-btn--state-b');
                    }
                }
                var openedTriggers2 = mainHeader[0].getElementsByClassName('switch-icon--state-b');
                for (var j=0; j < openedTriggers2.length; j++) {
                    if (openedTriggers2[j] !== this) {
                        Util.removeClass(openedTriggers2[j], 'switch-icon--state-b');
                    }
                }

                // Show/Hide for Chosen Submenu
                if (!isExpanded) {
                    Util.addClass(targetMenu, 'header-v2__nav--is-visible', event.detail);
                }

                if (isExpanded || !isExpandedOther)
                    Util.toggleClass(mainHeader[0], 'header-v2--expanded', event.detail);

                firstFocusableElement = getMenuFirstFocusable(targetMenu);

                this.setAttribute('aria-expanded', event.detail);
                if(event.detail) firstFocusableElement.focus(); // move focus to first focusable element
                else if(focusMenu) {
                    focusMenu.focus();
                    focusMenu = false;
                }
            });
        }

        // take care of submenu
        var mainList = mainHeader[0].getElementsByClassName('header-v2__nav-list--main');
        if(mainList.length > 0) {
            for( var i = 0; i < mainList.length; i++) {
                (function(i){
                    new menuAim({ // use diagonal movement detection for main submenu
                        menu: mainList[i],
                        activate: function(row) {
                            var submenu = row.getElementsByClassName('header-v2__nav-dropdown');
                            if(submenu.length == 0 ) return;
                            Util.addClass(submenu[0], 'header-v2__nav-list--is-visible');
                            resetDropdownStyle(submenu[0], true);
                        },
                        deactivate: function(row) {
                            var submenu = row.getElementsByClassName('header-v2__nav-dropdown');
                            if(submenu.length == 0 ) return;
                            Util.removeClass(submenu[0], 'header-v2__nav-list--is-visible');
                            resetDropdownStyle(submenu[0], false);
                        },
                        exitMenu: function() {
                            return true;
                        },
                        submenuSelector: '.header-v2__nav-item--has-children',
                        submenuDirection: 'below'
                    });

                    // take care of focus event for main submenu
                    var subMenu = mainList[i].getElementsByClassName('header-v2__nav-item--main');
                    for(var j = 0; j < subMenu.length; j++) {(function(j){if(Util.hasClass(subMenu[j], 'header-v2__nav-item--has-children')) new Submenu(subMenu[j]);})(j);};
                })(i);
            }
        }

        // if data-animation-offset is set -> check scrolling
        var animateHeader = mainHeader[0].getAttribute('data-animation');
        if(animateHeader && animateHeader == 'on') {
            var scrolling = false,
                scrollOffset = (mainHeader[0].getAttribute('data-animation-offset')) ? parseInt(mainHeader[0].getAttribute('data-animation-offset')) : 400,
                mainHeaderHeight = mainHeader[0].offsetHeight,
                mainHeaderWrapper = mainHeader[0].getElementsByClassName('header-v2__wrapper')[0];

            window.addEventListener("scroll", function(event) {
                if( !scrolling ) {
                    scrolling = true;
                    (!window.requestAnimationFrame) ? setTimeout(function(){checkMainHeader();}, 250) : window.requestAnimationFrame(checkMainHeader);
                }
            });

            function checkMainHeader() {
                var windowTop = window.scrollY || document.documentElement.scrollTop;
                Util.toggleClass(mainHeaderWrapper, 'header-v2__wrapper--is-fixed', windowTop >= mainHeaderHeight);
                Util.toggleClass(mainHeaderWrapper, 'header-v2__wrapper--slides-down', windowTop >= scrollOffset);
                scrolling = false;
            };
        }

        // listen for key events
        window.addEventListener('keyup', function(event){
            for (var i=0; i < menuTrigger.length; i++) {
                // listen for esc key
                if( (event.keyCode && event.keyCode == 27) || (event.key && event.key.toLowerCase() == 'escape' )) {
                    // close navigation on mobile if open
                    if(menuTrigger[i].getAttribute('aria-expanded') == 'true' && isVisible(menuTrigger[i])) {
                        focusMenu = menuTrigger[i]; // move focus to menu trigger when menu is close
                        menuTrigger[i].click();
                    }
                }
                // listen for tab key
                if( (event.keyCode && event.keyCode == 9) || (event.key && event.key.toLowerCase() == 'tab' )) {
                    // close navigation on mobile if open when nav loses focus
                    if(menuTrigger[i].getAttribute('aria-expanded') == 'true' && isVisible(menuTrigger[i]) && !document.activeElement.closest('.js-header-v2')) menuTrigger[i].click();
                }
            }
        });

        window.addEventListener('click', function(event){
            for (var i=0; i < menuTrigger.length; i++) {
                // listen for esc key
                if(!event.target.closest('.js-header-v2')) {
                    // close navigation on mobile if open
                    if(menuTrigger[i].getAttribute('aria-expanded') == 'true' && isVisible(menuTrigger[i])) {
                        focusMenu = menuTrigger[i]; // move focus to menu trigger when menu is close
                        menuTrigger[i].click();
                    }
                }
            }
        });

        function getMenuFirstFocusable(targetMenu) {
            var focusableEle = targetMenu.querySelectorAll('[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable], audio[controls], video[controls], summary'),
                firstFocusable = false;
            for(var i = 0; i < focusableEle.length; i++) {
                if( focusableEle[i].offsetWidth || focusableEle[i].offsetHeight || focusableEle[i].getClientRects().length ) {
                    firstFocusable = focusableEle[i];
                    break;
                }
            }

            return firstFocusable;
        };
    }

    function resetDropdownStyle(dropdown, bool) {
        if(!bool) {
            dropdown.addEventListener('transitionend', function cb(){
                dropdown.removeAttribute('style');
                dropdown.removeEventListener('transitionend', cb);
            });
        } else {
            var boundingRect = dropdown.getBoundingClientRect();
            if(window.innerWidth - boundingRect.right < 5 && boundingRect.left + window.scrollX > 2*boundingRect.width) {
                var left = parseFloat(window.getComputedStyle(dropdown).getPropertyValue('left'));
                dropdown.style.left = (left + window.innerWidth - boundingRect.right - 5) + 'px';
            }
        }
    };

    function isVisible(element) {
        return (element.offsetWidth || element.offsetHeight || element.getClientRects().length);
    };
}());
