$(document).ready(function(){
    
    $('.fadeOut').hide(6000);
    
    
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
         var idsJoinsNoMarcadas = getPeliculasNoMarcadas();
         
         $.ajax({
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
        $("input:checkbox").each(function(){
            $(this).attr("checked", false);
        }); 
    }
    
    function getPeliculasMarcadas(){
        
        var idsArray = new Array();
         
         $(".peliculaSeleccionada").each(function(){
             
             if(this.checked){
                 idsArray.push($(this).attr("id"));
             }
         });
         idsJoins = idsArray.join(',');
         return idsJoins;
    }
    
    function getPeliculasNoMarcadas(){
        
        var idsArray = new Array();
         
         $(".peliculaSeleccionada").each(function(){
             
             if(!this.checked){
                 idsArray.push($(this).attr("id"));
             }
         });
         idsJoins = idsArray.join(',');
         return idsJoins;
    }

    //------------------filtered_payments------------------------
        
        $("#confirmSearchPayment").click(function(){
            
            if($("#nameSocioOfPayment").val() != null)  nameSocio = $("#nameSocioOfPayment").val();
            if($("#lastNameSocioOfPayment").val() != null ) lastNameSocio = $("#lastNameSocioOfPayment").val();
            if($("#ciSocioOfPayment").val() != null)  ciSocio = $("#ciSocioOfPayment").val();
            if($("#amountOfPayment").val() != null)  amountPayment = $("#amountOfPayment").val();
            
            $.ajax({
                type: "POST",
                data: "nameSocio=" + nameSocio + "&lastNameSocio=" + lastNameSocio + "&ciSocio=" + ciSocio + "&amountPayment=" + amountPayment,
                url:  "/cake_primero/payments/payment_filters",
                success: function(data){
                    console.info(data);
                    $("#paymentsContainer").html(data);
                }
           });
           
        });
    
    //------------------- /filtered_payments----------------
    
    
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

        $("#closeButton").click(function(){
            var divContenedor = $("#searchSocioContainer");
            divContenedor.hide();
        });
    
    
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

    
    function getMoviesData(){
        var movie_container = document.createElement('div');
        $(movie_container).addClass('movieContainer');
        
        var movie_image = document.createElement('img');
        $(addComment).addClass('movieImg');
        $(post_container).append(addComment);
    }
    
    
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
         
         $(".sociosSeleccionados").each(function(){
             
             if(this.checked){
                 idsArray.push($(this).attr("id"));
             }
         });
         idsJoins = idsArray.join(',');
         return idsJoins;
    }
  
    

}


);


