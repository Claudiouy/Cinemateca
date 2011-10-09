/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    $('.fadeOut').hide(4000);
    
    
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
        
         idsJoins = getPeliculasMarcadas();
         
         $.ajax({
            data: "idSel=" + idsJoins,
            type: "POST ",
            url:  "/cake_primero/peliculas/activar_peliculas",
            success: function(data){
                //console.info(data);
                limpiarCheckboxes();
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
});


