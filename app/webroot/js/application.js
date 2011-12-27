$(document).ready(function(){
// Caching the movieName textbox:
var nombrecalle = $('.callejero');
var SocioDocumentoIdentidad = $('#SocioDocumentoIdentidad');
// Defining a placeholder text:
//nombrecalle.defaultText('Ingrese la calle...');
SocioDocumentoIdentidad.defaultText('Sin puntos ni guiones');
 

 // fadeout mensajes flash al clickear
    $('.cancel').click(function(){  
        $(this).parent().fadeOut();  
    return false;  
    });  
  
    // fade out good flash messages after 5 seconds  
    $('.flash_good').animate({opacity: 1.0}, 4000).fadeOut();
    $('.flash_bad').animate({opacity: 1.0}, 4000).fadeOut();
    $('.flash_warning').animate({opacity: 1.0}, 4000).fadeOut();
    $('.flash_info').animate({opacity: 1.0}, 4000).fadeOut();

	$(function() {
		// there's the gallery and the agrupado
		var $gallery = $( "#gallery" ),
			$agrupado = $( "#agrupado" );

		// let the gallery items be draggable
		$( "li", $gallery ).draggable({
			cancel: "a.ui-icon", // clicking an icon won't initiate dragging
			revert: "invalid", // when not dropped, the item will revert back to its initial position
			containment: $( "#demo-frame" ).length ? "#demo-frame" : "document", // stick to demo-frame if present
			helper: "clone",
			cursor: "move"
		});

		// let the agrupado be droppable, accepting the gallery items
		$agrupado.droppable({
			accept: "#gallery > li",
			activeClass: "ui-state-highlight",
			drop: function( event, ui ) {
				deleteImage( ui.draggable );
			}
		});

		// let the gallery be droppable as well, accepting items from the agrupado
		$gallery.droppable({
			accept: "#agrupado li",
			activeClass: "custom-state-active",
			drop: function( event, ui ) {
				recycleImage( ui.draggable );
			}
		});

		// image deletion function
		var recycle_icon = "<a href='link/to/recycle/script/when/we/have/js/off' title='Desagrupar' class='ui-icon ui-icon-refresh'>Recycle image</a>";
		function deleteImage( $item ) {
			$item.fadeOut(function() {
				var $list = $( "ul", $agrupado ).length ?
					$( "ul", $agrupado ) :
					$( "<ul class='gallery ui-helper-reset'/>" ).appendTo( $agrupado );

				$item.find( "a.ui-icon-agrupado" ).remove();
				$item.append( recycle_icon ).appendTo( $list ).fadeIn(function() {
					$item
						.animate({width: "48px"})
						.find( "img" )
						.animate({height: "36px"});
				});
			});
		}

		// image recycle function
		//var agrupado_icon = "<a href='link/to/agrupado/script/when/we/have/js/off' title='Delete this image' class='ui-icon ui-icon-agrupado'>Delete image</a>";
		function recycleImage( $item ) {
			$item.fadeOut(function() {
				$item
					.find( "a.ui-icon-refresh" )
						.remove()
					.end()
					.css( "width", "96px")
					//.append( agrupado_icon )
					.find( "img" )
						.css( "height", "72px" )
					.end()
					.appendTo( $gallery )
					.fadeIn();
			});
		}



		// resolve the icons behavior with event delegation
		$( "ul.gallery > li" ).click(function( event ) {
			var $item = $( this ),
				$target = $( event.target );

			if ( $target.is( "a.ui-icon-agrupado" ) ) {
				deleteImage( $item );
			} else if ( $target.is( "a.ui-icon-zoomin" ) ) {
				viewLargerImage( $target );
			} else if ( $target.is( "a.ui-icon-refresh" ) ) {
				recycleImage( $item );
			}

			return false;
		});
	});


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
		$("#fec_nac").datepicker({dateFormat: 'yy-mm-dd',
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
        
  
  
  
  
$('#SocioPaymentMethodId').click('change', function() {
    if($(this).val()== 2) {
          $('#list-creditcards').show();
                
      } else {
         $('#list-creditcards').hide();
         
      }
    });
    
    $("#asociarSociosColectivos").live('click', function(){
        
         var idsJoins = getSociosColectivos();
         
         $.ajax({
            data: "idSelec=" + idsJoins,
            type: "POST",
            url:  "/cake_primero/socios/asoc_colectivos",
            success: function(data){
               window.location.href=window.location.href;
              //  console.info(data);
            },
            error: function(miError){
               //console.info(miError.statusText);
            }
         });
         
    });

  
    function getSociosColectivos(){
  var idsArray = new Array();
// Obtenemos el elemento con el id "agrupado"
var agrupados = document.getElementById("agrupado");
// todos los elementos con tag img que hay
// dentro del elemento 'agrupado'
socios = agrupados.getElementsByTagName('img');
 for (var i=0; i<socios.length; i++) {
   idsArray.push(socios[i].id);
}
idJoins = idsArray.join(',');
  
       return idJoins;

}
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

