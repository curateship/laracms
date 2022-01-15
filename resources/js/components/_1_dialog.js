// File#: _1_dialog
// Usage: codyhouse.co/license
(function() {
    var Dialog = function(element) {
      this.element = element;
      this.triggers = document.querySelectorAll('[aria-controls="'+this.element.getAttribute('id')+'"]');
      this.firstFocusable = null;
      this.lastFocusable = null;
      this.selectedTrigger = null;
      this.showClass = "dialog--is-visible";
      initDialog(this);
    };
  
    function initDialog(dialog) {
      if ( dialog.triggers ) {
        for(var i = 0; i < dialog.triggers.length; i++) {
          dialog.triggers[i].addEventListener('click', function(event) {
            event.preventDefault();
            dialog.selectedTrigger = event.target;
            showDialog(dialog);
            initDialogEvents(dialog);
          });
        }
      }
      
      // listen to the openDialog event -> open dialog without a trigger button
      dialog.element.addEventListener('openDialog', function(event){
        if(event.detail) self.selectedTrigger = event.detail;
        showDialog(dialog);
        initDialogEvents(dialog);
      });
    };
  
    function showDialog(dialog) {
      Util.addClass(dialog.element, dialog.showClass);
      getFocusableElements(dialog);
      dialog.firstFocusable.focus();
      // wait for the end of transitions before moving focus
      dialog.element.addEventListener("transitionend", function cb(event) {
        dialog.firstFocusable.focus();
        dialog.element.removeEventListener("transitionend", cb);
      });
      emitDialogEvents(dialog, 'dialogIsOpen');
    };
  
    function closeDialog(dialog) {
      Util.removeClass(dialog.element, dialog.showClass);
      dialog.firstFocusable = null;
      dialog.lastFocusable = null;
      if(dialog.selectedTrigger) dialog.selectedTrigger.focus();
      //remove listeners
      cancelDialogEvents(dialog);
      emitDialogEvents(dialog, 'dialogIsClose');
    };
    
    function initDialogEvents(dialog) {
      //add event listeners
      dialog.element.addEventListener('keydown', handleEvent.bind(dialog));
      dialog.element.addEventListener('click', handleEvent.bind(dialog));
    };
  
    function cancelDialogEvents(dialog) {
      //remove event listeners
      dialog.element.removeEventListener('keydown', handleEvent.bind(dialog));
      dialog.element.removeEventListener('click', handleEvent.bind(dialog));
    };
    
    function handleEvent(event) {
      // handle events
      switch(event.type) {
        case 'click': {
          initClick(this, event);
        }
        case 'keydown': {
          initKeyDown(this, event);
        }
      }
    };
    
    function initKeyDown(dialog, event) {
      if( event.keyCode && event.keyCode == 27 || event.key && event.key == 'Escape' ) {
        //close dialog on esc
        closeDialog(dialog);
      } else if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
        //trap focus inside dialog
        trapFocus(dialog, event);
      }
    };
  
    function initClick(dialog, event) {
      //close dialog when clicking on close button
      if( !event.target.closest('.js-dialog__close') ) return;
      event.preventDefault();
      closeDialog(dialog);
    };
  
    function trapFocus(dialog, event) {
      if( dialog.firstFocusable == document.activeElement && event.shiftKey) {
        //on Shift+Tab -> focus last focusable element when focus moves out of dialog
        event.preventDefault();
        dialog.lastFocusable.focus();
      }
      if( dialog.lastFocusable == document.activeElement && !event.shiftKey) {
        //on Tab -> focus first focusable element when focus moves out of dialog
        event.preventDefault();
        dialog.firstFocusable.focus();
      }
    };
  
    function getFocusableElements(dialog) {
      //get all focusable elements inside the dialog
      var allFocusable = dialog.element.querySelectorAll('[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable], audio[controls], video[controls], summary');
      getFirstVisible(dialog, allFocusable);
      getLastVisible(dialog, allFocusable);
    };
  
    function getFirstVisible(dialog, elements) {
      //get first visible focusable element inside the dialog
      for(var i = 0; i < elements.length; i++) {
        if( elements[i].offsetWidth || elements[i].offsetHeight || elements[i].getClientRects().length ) {
          dialog.firstFocusable = elements[i];
          return true;
        }
      }
    };
  
    function getLastVisible(dialog, elements) {
      //get last visible focusable element inside the dialog
      for(var i = elements.length - 1; i >= 0; i--) {
        if( elements[i].offsetWidth || elements[i].offsetHeight || elements[i].getClientRects().length ) {
          dialog.lastFocusable = elements[i];
          return true;
        }
      }
    };
  
    function emitDialogEvents(dialog, eventName) {
      var event = new CustomEvent(eventName, {detail: dialog.selectedTrigger});
      dialog.element.dispatchEvent(event);
    };
  
    //initialize the Dialog objects
    var dialogs = document.getElementsByClassName('js-dialog');
    if( dialogs.length > 0 ) {
      for( var i = 0; i < dialogs.length; i++) {
        (function(i){new Dialog(dialogs[i]);})(i);
      }
    }
  }());