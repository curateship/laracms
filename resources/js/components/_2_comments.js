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