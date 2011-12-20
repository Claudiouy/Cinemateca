<div>
    <h2 style="margin-left:40%">Graficas de pagos</h2>
    <div style="float:left;width:28%">
            <div style="width:100%;" >
                <input type="button" value="Graficar" id="buttGraficas" />
                <input type="button" value="Graficar por importe del pago" id="buttChartAmount" />
            </div>
          <?php  echo $this->Form->input('from', array('label' => 'Desde' , 'type' => 'date', 'id' => 'dateFrom')); ?>
            <br /><br /><br /><br />
          <?php  echo $this->Form->input('to', array('label' => 'Hasta' , 'type' => 'date', 'id' => 'dateTo')); ?>
    </div>
    
<div id="container2" style="float:left;width: auto;height: auto;margin: 50px 0 0 10%; "></div>

</div>