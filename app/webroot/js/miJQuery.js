$j = jQuery.noConflict();


$j(document).ready(function(){

    
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
    
    $j('#searchPaymentId').click(function(){
            $j('.filterPaymentContainer').show();
    });
    
    //------------- tickets------------------
    
    
        
         
         function openPopUp(pagina) {
            var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=508, height=365, top=85, left=140";
            window.open(pagina,"",opciones);
         }
         
         
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
        
        $j("#refreshTicketsButton").click(function(){
        
             var monthFrom = $j("#dateFromMonth").val() - 1;
             var dayFrom = $j("#dateFromDay").val();
             var yearFrom = $j("#dateFromYear").val();
             var myDateFrom = new Date(yearFrom, monthFrom, dayFrom);

             var monthTo = $j("#dateToMonth").val() - 1;
             var dayTo = $j("#dateToDay").val();
             var yearTo = $j("#dateToYear").val();
             var myDateTo = new Date(yearTo, monthTo, dayTo);
             
             if(myDateFrom < myDateTo){
                 $.ajax({
                    data: "dateFrom=" + myDateFrom + "&dateTo=" + myDateTo,
                    type: "POST",
                    url: '/cake_primero/tickets/refresh_tickets',
                    success: function(data){
                       $j('#tableTicketsContainer').html(data);
                    }
                 });

             }
             else{
                 alert('La fecha de inicio debe de ser menor a la de fin.');
             }
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

         $(".sociosSeleccionados").each(function(){

             if(this.checked){
                 idsArray.push($(this).attr("id"));
             }
         });
         idsJoins = idsArray.join(',');
         return idsJoins;
    }
    
    //-----------------------------------
    
    
    
    $j("#globalSalaId").change(function(){
        
        var globSalaId = $j("#globalSalaId").val();
        //console.info(globSalaId);
        $.ajax({
            data: "idSala=" + globSalaId,
            type: "POST",
            url:  "/cake_primero/salas/write_global_sala_id",
            success: function(data){
                //window.location.href=window.location.href;
                console.info(data);
              //  console.info(data);
            },
            error: function(miError){
               //console.info(miError.statusText);
            }
         });
    });
    
    //----------------graficas---------------
    
    
    $("#buttGraficas").click(function(){        
         chartData("/cake_primero/payments/retrievePaymentsDataChart", "Cantidad de pagos");
    });
    
    $("#buttChartAmount").click(function(){
        chartData("/cake_primero/payments/retrievePaymentsAmountDataChart", 'Importe recaudado'); 
    });
    
    $("#buttonPieSocio").click(function(){
        pieData('/cake_primero/socios/retrieveUpToDateSocios', 'Titulein');
    });
    
    $("#buttonPieSocioByAge").click(function(){
       pieData('/cake_primero/socios/retrieveSociosByAgeChart', 'Titulein'); 
    });
    
    
    
    
    function pieData(urlString, title){
        
        $.ajax({
                data: "dateFrom=1",
                type: "POST",
                url: urlString,
                success: function(data){
                    console.info(data);
                    myData = data.split('|||')[0];
                    myData = myData.replace(/["}{\[\]']/g, '');

                    myTitle = data.split('|||')[1];
                    myTitle = myTitle.replace(/["']/g, '');
                    
                    var dataArray = new Array();
                    myData = myData.split(',');
                    for(i = 0; i < myData.length; i++){
                        eachData = myData[i].split(':')[1];
                        eachLegend = myData[i].split(':')[0];
                        dataDummyArray = new Array();
                        dataDummyArray.push(eachLegend);
                        dataDummyArray.push(parseInt(eachData));
                        
                        dataArray.push(dataDummyArray);
                    }
                    pieChart(dataArray, myTitle);
                }
            
        });
    }   
    
    function chartData(urlString, legendTitle){
        
         var monthFrom = $j("#dateFromMonth").val() - 1;
         var dayFrom = $j("#dateFromDay").val();
         var yearFrom = $j("#dateFromYear").val();
         var myDateFrom = new Date(yearFrom, monthFrom, dayFrom);
         
         var monthTo = $j("#dateToMonth").val() - 1;
         var dayTo = $j("#dateToDay").val();
         var yearTo = $j("#dateToYear").val();
         var myDateTo = new Date(yearTo, monthTo, dayTo);
         
         if(myDateFrom < myDateTo){
             $.ajax({
                data: "dateFrom=" + myDateFrom + "&dateTo=" + myDateTo,
                type: "POST",
                url: urlString,
                success: function(data){
                    //console.info(data);
                    stringData = data.split('|||')[0];
                    arrayJson = new Array();
                    arrayData = new Array(); 
                    arrayJson = stringData.split(',');
                    if( arrayJson.length > 0) {
                        for(i = 0; i < arrayJson.length; i++){
                            arrayData.push(parseInt(arrayJson[i].split(':')[1]));
                        }
                    }

                    stringLegend = data.split('|||')[1];
                    arrayLegend = new Array();
                    arrayJsonLegend = $j.parseJSON(stringLegend);
                    if( arrayJsonLegend.length > 0) {
                        for(i = 0; i < arrayJsonLegend.length; i++){
                            arrayLegend.push(arrayJsonLegend[i]);
                        }
                    }

                    graficar(arrayData, arrayLegend, legendTitle);
                },
                error: function(miError){
                   //console.info(miError.statusText);
                }
             });
         }
         else {
             alert("La fecha de inicio debe ser anterior a la de fin");
         }
    }

    function graficar(myData, myLegend, myLegendTitle){
     
        chart1 = new Highcharts.Chart({
         
         chart: {
            renderTo: 'container2',
            type: 'line',    
            width: 800,
            height: 300
         },
         title: {
            text: myLegendTitle
         },
         xAxis: {
            categories: myLegend
         },
         yAxis: {
            title: {
                text: myLegendTitle
            }
         },
         series: [{
            name: myLegendTitle,
            data: myData
         }]
         
      });
    }
    
    function pieChart(myData, myTitle){
        
          var chartPie = new Highcharts.Chart({
          chart: {
             renderTo: 'containerPieTicket',
             plotBackgroundColor: null,
             plotBorderWidth: null,
             plotShadow: false
          },
          title: {
             text: myTitle
          },
          tooltip: {
              
             formatter: function() {
                return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
             }
          },
          plotOptions: {
             pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                   enabled: true,
                   color: '#000000',
                   connectorColor: '#000000',
                   formatter: function() {
                      return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                   }
                }
             }
          },
           series: [{
             type: 'pie',
             name: 'Browser share',
             data: myData
          }]
       });
    }

});
