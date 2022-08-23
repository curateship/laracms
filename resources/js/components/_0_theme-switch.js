(function() {
  var themeSwitch = document.getElementById('theme-switch');
  if(themeSwitch) {
    var htmlElement = document.getElementsByTagName("html")[0];
    initTheme();
    
    themeSwitch.addEventListener('change', function(event){
      resetTheme(event.target);
    });

    function initTheme() {
      if(htmlElement.getAttribute('data-theme') == 'dark') {
        themeSwitch.querySelector('input[value="dark"]').checked = true;
      }
    };

    function resetTheme(target) {
      if(target.value == 'dark') {
        htmlElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('themeSwitch', 'dark');
      } else {
        htmlElement.removeAttribute('data-theme');
        localStorage.removeItem('themeSwitch');
      }
    };
  }
}());