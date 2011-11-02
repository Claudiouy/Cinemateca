/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    $('.fadeOut').hide(6000);
    
    
    /*$("#buscarPeliculaSP").click(function(){
        nombreParcial = $("#textoBuscadorSP").val();
        console.info(nombreParcial);
        $.ajax({
            data: "nombre=" + nombreParcial,
            type: "POST",
            url:  "/peliculas/peliculas_por_nombre",
            success: function(data){
                
            }
        });
    });*/
    
    
    $("#consultarPeliculas").click(function(){
       var nombrePeli = $("#filtroNombre").val();
       $.ajax({
            data: "miNombre=" + nombrePeli,
            type: "POST",
            url:  "/cake_primero/peliculas/otra_consulta",
            success: function(data){
                $("#listadoFiltradoPeliculas").html(data);
                //console.info(data);
            }
       });
    });
    
    $("#activarPeliculasSeleccionadas").click(function(){
        
         var idsJoins = getPeliculasMarcadas();
         //console.info(idsJoins);
         $.ajax({
            data: "idSelec=" + idsJoins,
            type: "POST",
            url:  "/cake_primero/peliculas/activar_peliculas",
            success: function(data){
                limpiarCheckboxes();
            },
            error: function(miError){
               //console.info(miError.statusText);
            }
         });
         
    });
    
    
    function limpiarCheckboxes(){
        $("input:checkbox").each(function(){
            $(this).attr("checked", false);
        }); 
    }
    
    function getPeliculasMarcadas(){
        
        var idsArray = new Array();
         
         $(".peliculaSeleccionada").each(function(){
             
             if(($(this).attr("checked")) == "checked"){
                 idsArray.push($(this).attr("id"));
             }
         });
         idsJoins = idsArray.join(',');
         return idsJoins;
    }
    
    
    //------------new_payment------------
    
        $("#openSearchSocio").click(function(){
            $("#searchSocioContainer").toggle();
        });
    
        $("#retrieveSocios").click(function(){
           var nombreSocio = $("#socioNameSearch").val();
           $.ajax({
                data: "nameSocio=" + nombreSocio,
                type: "POST",
                url:  "/cake_primero/payments/retrieveSociosByName",
                success: function(data){
                    $("#socioData").html(data);
                }
           });
        });
        /*
        $(".selectSocio").live('click', function(){  
           var idSocio = $(this).attr('id');
           console.info(idSocio);
           $.ajax({
                data: "idSocio=" + idSocio,
                type: "POST",
                datatype: 'json',
                url:  "/cake_primero/payments/retrieveSocioById",
                success: function(data){
                    $("#socioData").html(data);
                }
           });
        });*/
    
    
    //------------/ new_payment---------
    
    //------------- tickets------------------
    
    
         $("#findSocioByDoc").click(function(){
           var socioDocument = $("#socioDocument").val();
           $.ajax({
                data: "socioDoc=" + socioDocument,
                type: "POST",
                url:  "/cake_primero/tickets/retrieve_socio_by_document",
                success: function(data){
                    var sociosName = data.split('--||--')[0];
                    var sociosId = data.split('--||--')[1];
                    
                    $('#inputReadOnlySocio').val(sociosName);
                    $('#TicketId').val(sociosId);
                }
           });
        });
    
    
    
    
    //----------------- /tickets---------------
});


