<?php
//JOSE ALFREDO DE LA CRUZ ASENCIO, 20153009
  $CI=& get_instance();
  $filas=$CI->db->get('pelicula')->result_array();

  $CI->db->where('id',$codigo);
  $f=$CI->db->get('pelicula')->result_array();
  if (count($f)>0) {
    $fi=$f[0];
  }else {
    $fi=array(
      'id'=>'',
      'titulo'=>'',
      'resumen'=>'',
      'año'=>'',
      'pais'=>'',
      'protagonista'=>'',
      'foto'=>''
    );


  }






?>


<form method="post" action="<?php echo base_url('Peliculas_controller')?>" enctype="multipart/form-data">
    <div class="row">
      <h2 class="text-center"><span class="label label-success">Agregar Pelicula</span></h2>

      <div class="col col-md-6">


        <input type="hidden" name="id"  value="<?php echo $fi['id']?>">
          <div class="form-group input-group">
            <span class="input-group-addon">Titulo</span>
            <input type="text" class="form-control" placeholder="Ingrese el Titulo" required  name="titulo" value="<?php echo $fi['titulo']?>">
          </div>
          <div class="form-group input-group">
            <span class="input-group-addon">Resumen</span>
            <textarea name="resumen" required  placeholder="Ingrese los Resumen" class="form-control"><?php echo $fi['resumen']?></textarea>
          </div>
          <div class="form-group input-group">
            <span class="input-group-addon">Año</span>
            <input type="text" placeholder="Ingrese el Año"  required class="form-control" name="año" value="<?php echo $fi['año']?>">
          </div>
      </div>

      <div class="col col-md-6">
        <div class="form-group input-group">
          <span class="input-group-addon">Pais</span>
          <input type="text"  required  placeholder="Ingrese el Pais" class="form-control" name="pais" value="<?php echo $fi['pais']?>">
        </div>
        <div class="form-group input-group">
          <span class="input-group-addon">Protagonistas</span>
          <textarea name="protagonistas" required  placeholder="Ingrese los Protagonistas" class="form-control"><?php echo $fi['protagonista']?></textarea>
        </div>
        <div class="form-group input-group">
          <span class="input-group-addon">Imagen</span>
          <input type="file" required  class="form-control" name="foto" value="">
        </div>
      </div>
        <div class="text-center">
          <?php
          if($codigo==0){
            echo "
              <button class='btn btn-primary' type='submit'>Agregar Pelicula</button>
            ";
          }else {
            echo "
              <button class='btn btn-primary' type='submit'>Actualizar Pelicula</button>
            ";
          }



          ?>

              <a class="btn btn-info" href="<?php echo base_url('Peliculas_controller')?>">Nuevo</a>
        </div>




    </div>
</form>
<h2 class="text-center"><span class="label label-success">Peliculas Agregadas</span></h2>

  <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th class="bg-primary">Id</th>
                <th class="bg-primary">Imagen</th>
                <th class="bg-primary">Titulo</th>
                <th class="bg-primary">Resumen</th>
                <th class="bg-primary">Año</th>
                <th class="bg-primary">Pais</th>
                <th class="bg-primary"> Protagonistas</th>
                <th class="bg-primary">Opciones</th>
            </tr>
        </thead>

        <tbody>
              <?php
              foreach ($filas as $fila) {
                $linkmodificar=base_url('Peliculas_controller/index/'.$fila['id']);
                $linkeliminar=base_url('Peliculas_controller/eliminar/'.$fila['id']);
                $linkimagen=base_url('imagenes');
                echo "
                    <tr>
                      <td> {$fila['id']}</td>
                      <td> <a href='{$linkimagen}/{$fila['foto']}'><img src='{$linkimagen}/{$fila['foto']}' width='50px' heigth='90px'></a></td>
                      <td> {$fila['titulo']}</td>
                      <td> {$fila['resumen']}</td>
                      <td> {$fila['año']}</td>
                      <td> {$fila['pais']}</td>
                      <td> {$fila['protagonista']}</td>
                      <td>
                        <a href='$linkmodificar' class='btn btn-warning btn-sm'>Modificar  </a>
                        <a href='$linkeliminar' class='btn btn-danger btn-sm' onclick='return confirm(\"Seguro que Desea eliminar esta pelicula?\");' >Eliminar </a>

                      </td>


                    </tr>

                ";


              }


              ?>
        </tbody>
  </table>
