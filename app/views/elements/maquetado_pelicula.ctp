<?php if(!empty($activePeliculas)){ 
            echo '<h2>En cartel:</h2>';
     foreach ($activePeliculas as $pelicula) {

?>
    
<div class="pelicula"> 
    
  <a href="" >
        <?php echo $this->Html->image('imgPelis/'.$pelicula['Pelicula']['image_path'], array('style' => 'width:200px;height:200px;')); ?>
  </a>
        <h4>
          <a href="" class="Estilo18">
            <?php echo $pelicula['Pelicula']['name'];  ?>
          </a>
        </h4>
        <p>&nbsp; </p>
      <p align="justify">
        <strong>Desde el martes 15 al lunes 21  de noviembre.</strong>
      </p>
      <p align="justify"><br>
          <?php if(!empty($pelicula['Pelicula']['descripcion'])) echo $pelicula['Pelicula']['descripcion'];  ?>
          
          <br>
        <a href="">
          <span class="Estilo3">
            <span class="Estilo17">Leer más &gt;&gt;</span>
          </span>
        </a>
      </p>
        <p align="justify">&nbsp;</p>
        <p align="justify">&nbsp;</p>
        <p align="justify">&nbsp; </p>
  </div>

<?php 

     }
} ?>