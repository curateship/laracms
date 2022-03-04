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