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