window.onload = function () {
    document.body.classList.add('loaded_hiding');
    window.setTimeout(function () {
      document.body.classList.add('loaded');
      document.body.classList.remove('loaded_hiding');
    }, 500);
  }
/*


let icons_is_not_disabled=true;


function save_icons_view(){
  window.localStorage.setItem('icons_is_not_disabled', icons_is_not_disabled)
}
function read_icons_view(){
  //console.log(window.localStorage.getItem('theme'))
  return JSON.parse(window.localStorage.getItem('icons_is_not_disabled'));
  
}

document.addEventListener('DOMContentLoaded', function () {
  var checkbox = document.querySelector('input[type="checkbox"]');

  checkbox.addEventListener('change', function () {
    if (checkbox.checked) {
      icons_is_not_disabled=false;
      save_icons_view();
    } else {
      icons_is_not_disabled=true;
      save_icons_view();
    }
  });
});

$(document).ready(function(){
  icons_is_not_disabled=read_icons_view();
  if(!icons_is_not_disabled) {
  stylesheet = document.styleSheets[0]
  stylesheet.insertRule("ion-icon{display:none;}", 0);
  }
  

})
    */



