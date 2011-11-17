////file:app/webroot/js/application.js
$(document).ready(function(){
// Caching the movieName textbox:
var nombrecalle = $('#calle_princ');
// Defining a placeholder text:
nombrecalle.defaultText('Ingrese la calle');

// Using jQuery UI's autocomplete widget:
nombrecalle.autocomplete({
minLength: 2,
maxRows: 12,
style:'full',
source: '/cake_primero/socios/getcalles'
});

// Usando jQuery UI con RadioButtons

}

);

// A custom jQuery method for placeholder text:

$.fn.defaultText = function(value){

var element = this.eq(0);
element.data('defaultText',value);

element.focus(function(){
if(element.val() == value){
element.val('').removeClass('defaultText');
}
}).blur(function(){
if(element.val() == '' || element.val() == value){
element.addClass('defaultText').val(value);
}
});

return element.blur();
}

