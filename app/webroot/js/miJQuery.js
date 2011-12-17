$j = jQuery.noConflict();


$j(document).ready(function(){
$j("#content form:first div.error:first input:first").focus(); 

    
    $j('.fadeOut').hide(6000);
    
    
    /*$j("#buscarPeliculaSP").click(function(){
        nombreParcial = $j("#textoBuscadorSP").val();
        console.info(nombreParcial);
        $j.ajax({
            data: "nombre=" + nombreParcial,
            type: "POST",
            url:  "/peliculas/peliculas_por_nombre",
            success: function(data){
                
            }
        });
    });*/
    
    
    $j("#consultarPeliculas").click(function(){
       var nombrePeli = $j("#filtroNombre").val();
       $j.ajax({
            data: "miNombre=" + nombrePeli,
            type: "POST",
            url:  "/cake_primero/peliculas/otra_consulta",
            success: function(data){
                $j("#listadoFiltradoPeliculas").html(data);
                //console.info(data);
            }
       });
    });
    
    $j("#activarPeliculasSeleccionadas").click(function(){
        
         var idsJoins = getPeliculasMarcadas();
         var idsJoinsNoMarcadas = getPeliculasNoMarcadas();
         
         $j.ajax({
            data: "idSelec=" + idsJoins + "&idNoSelec=" + idsJoinsNoMarcadas,
            type: "POST",
            url:  "/cake_primero/peliculas/activar_peliculas",
            success: function(data){

                //console.info(data);
            },
            error: function(miError){
               //console.info(miError.statusText);
            }
         });
         
    });
    
    
    function limpiarCheckboxes(){
        $j("input:checkbox").each(function(){
            $j(this).attr("checked", false);
        }); 
    }
    
    function getPeliculasMarcadas(){
        
        var idsArray = new Array();
         
         $j(".peliculaSeleccionada").each(function(){
             
             if(this.checked){
                 idsArray.push($j(this).attr("id"));
             }
         });
         idsJoins = idsArray.join(',');
         alert(idsJoins);
         return idsJoins;
    }
    
    function getPeliculasNoMarcadas(){
        
        var idsArray = new Array();
         
         $j(".peliculaSeleccionada").each(function(){
             
             if(!this.checked){
                 idsArray.push($j(this).attr("id"));
             }
         });
         idsJoins = idsArray.join(',');
         return idsJoins;
    }

    //------------------filtered_payments------------------------
        
        $j("#confirmSearchPayment").click(function(){
            
            if($j("#nameSocioOfPayment").val() != null)  nameSocio = $j("#nameSocioOfPayment").val();
            if($j("#lastNameSocioOfPayment").val() != null ) lastNameSocio = $j("#lastNameSocioOfPayment").val();
            if($j("#ciSocioOfPayment").val() != null)  ciSocio = $j("#ciSocioOfPayment").val();
            if($j("#amountOfPayment").val() != null)  amountPayment = $j("#amountOfPayment").val();
            
            $j.ajax({
                type: "POST",
                data: "nameSocio=" + nameSocio + "&lastNameSocio=" + lastNameSocio + "&ciSocio=" + ciSocio + "&amountPayment=" + amountPayment,
                url:  "/cake_primero/payments/payment_filters",
                success: function(data){
                    $j("#paymentsContainer").html(data);
                }
           });
           
        });
    
    //------------------- /filtered_payments----------------
    
    
    //------------new_payment------------
    
        $j("#openSearchSocio").click(function(){
            $j("#searchSocioContainer").toggle();
        });
    
        $j("#retrieveSocios").click(function(){
           var nombreSocio = $j("#socioNameSearch").val();
           $j.ajax({
                data: "nameSocio=" + nombreSocio,
                type: "POST",
                url:  "/cake_primero/payments/retrieveSociosByName",
                success: function(data){
                    $j("#socioData").html(data);
                }
           });
        });
        /*
        $j(".selectSocio").live('click', function(){  
           var idSocio = $j(this).attr('id');
           console.info(idSocio);
           $j.ajax({
                data: "idSocio=" + idSocio,
                type: "POST",
                datatype: 'json',
                url:  "/cake_primero/payments/retrieveSocioById",
                success: function(data){
                    $j("#socioData").html(data);
                }
           });
        });*/


        $("#closeButton").click(function(){
            var divContenedor = $("#searchSocioContainer");
            divContenedor.hide();
        });
    
    
    //------------/ new_payment---------
    
    //------------- tickets------------------
    
    
         $j("#findSocioByDoc").click(function(){
           var socioDocument = $j("#socioDocument").val();
           $j.ajax({
                data: "socioDoc=" + socioDocument,
                type: "POST",
                url:  "/cake_primero/tickets/retrieve_socio_by_document",
                success: function(data){
                    var sociosName = data.split('--||--')[0];
                    var sociosId = data.split('--||--')[1];
                    
                    $j('#inputReadOnlySocio').val(sociosName);
                    $j('#TicketId').val(sociosId);
                }
           });
        });
    //----------------- /tickets---------------

    
    function getMoviesData(){
        var movie_container = document.createElement('div');
        $j(movie_container).addClass('movieContainer');
        
        var movie_image = document.createElement('img');
        $j(addComment).addClass('movieImg');
        $j(post_container).append(addComment);
    }
    
    //--------------------------------------------------
    
    //------------------pagina Cinemateca---------------------------
    
    
          $j("#showTemplateBut").click(function(){
             
             $j.ajax({
                
                type: "POST",
                url:  "/cake_primero/peliculas/json_peliculas_activas",
                success: function(data){
                    //console.info(data);
                    $j("#aBorrar").html(data);
                    $j("#aBorrar").show();
                }
             });
             
          });
    //--------------------------------------------------------------


    
//----------------------Socios------------------------


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

//   function getPeliculasNoMarcadas(){
//        
//        var idsArray = new Array();
//         
//         $j(".peliculaSeleccionada").each(function(){
//             
//             if(!this.checked){
//                 idsArray.push($j(this).attr("id"));
//             }
//         });
//         idsJoins = idsArray.join(',');
//         return idsJoins;