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