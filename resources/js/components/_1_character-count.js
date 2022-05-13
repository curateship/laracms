// File#: _1_character-count
// Usage: codyhouse.co/license
(function() {
  var CharacterCount = function(element) {
    this.element = element;
    this.input = this.element.getElementsByClassName('js-character-count__input')[0];
    this.characterLimit = Number(this.input.getAttribute('maxlength')) || 200;
    this.counter = this.element.getElementsByClassName('js-character-count__counter')[0];
    this.initCount();
  };

  CharacterCount.prototype.initCount = function() {
    var self = this;
    this.counter.textContent = this.getCount();//set counter value 
    this.input.addEventListener('input', function(event){ //listen for content changes
      self.counter.textContent = self.getCount();
    });
  };

  CharacterCount.prototype.getCount = function() {
    return this.characterLimit - this.input.value.length;
  };
  
  //initialize the CharacterCount objects
  var characterCounts = document.getElementsByClassName('js-character-count');
  if( characterCounts.length > 0 ) {
    for( var i = 0; i < characterCounts.length; i++) {
      (function(i){new CharacterCount(characterCounts[i]);})(i);
    }
  };
}());