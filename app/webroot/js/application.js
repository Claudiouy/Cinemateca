$(document).ready(function(){
// Caching the movieName textbox:
var nombrecalle = $('.callejero');
var SocioDocumentoIdentidad = $('#SocioDocumentoIdentidad');
// Defining a placeholder text:
nombrecalle.defaultText('Ingrese la calle...');
SocioDocumentoIdentidad.defaultText('Sin puntos ni guiones');
$(function() {
// Using jQuery UI's autocomplete widget:
nombrecalle.autocomplete({
minLength: 2,
source: '/cake_primero/socios/getcalles',


                search  : function(){$(this).addClass('working');},
                open    : function(){$(this).removeClass('working');}
});    
});
// Usando jQuery UI con RadioButtons

$(function() {
		$("#fec_nac").datepicker({ dateFormat: 'yy-mm-dd',
                                           maxDate: '+0d' ,
                                           minDate:'-100y'
                                          // showOn: 'button',
                                           //onSelect: updateSelected
                                           });

		});


function updateSelected(dateStr) { 
    var date = $('#selectedPicker').datepicker('getDate');
    $('#selectedMonth').val(date ? date.getMonth() + 1 : ''); 
    $('#selectedDay').val(date ? date.getDate() : ''); 
    $('#selectedYear').val(date ? date.getFullYear() : ''); 
} 
$('#selectedMonth,#selectedDay,#selectedYear').change(function() { 
    $('#selectedPicker').datepicker('setDate', new Date( 
        $('#selectedYear').val(), $('#selectedMonth').val() - 1, $('#selectedDay').val())); 
});

$(function() {
		function log( message ) {
			$( "<div/>" ).text( message ).prependTo( "#colectivos_log" );
			$( "#colectivos_log" ).scrollTop( 0 );
		}
		$( "#colectivos" ).autocomplete({
			source: "/cake_primero/socios/colectivos",
			minLength: 2,
			select: function( event, ui ) {
                         $("#SocioSurname").val(ui.item.surname);
                         $("#SocioName").val(ui.item.name);    
                         $("#SocioDocumentoIdentidad").val(ui.item.doc);
				log( ui.item ?
					ui.item.surname +", " + ui.item.name + "( " + ui.item.doc + ")" :
					"Nada seleccionado, ingreso: " + this.value );
                },
                search  : function(){$(this).addClass('working');},
                open    : function(){$(this).removeClass('working');}
		});
	});
        
  
  
  
  $('#SocioPaymentMethodId').bind('click', function()
    {
        $.ajax({
               type: "GET",
               url: "/cake_primero/socios/creditcards",
              onclick: function() {
                     },
               success: function(msg){
                   $('#div_tarjetas_cc').html(msg);
               }
             });
    });

});


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

