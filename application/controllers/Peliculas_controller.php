<?php
//JOSE ALFREDO DE LA CRUZ, 2015-3009
defined('BASEPATH') OR exit('No direct script access allowed');

class Peliculas_controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

  }

  function index($codigo=0)
  {

      if ($_POST) {
          $id=$_POST['id'];
          $pelicula['titulo']=$_POST['titulo'];
          $pelicula['resumen']=$_POST['resumen'];
          $pelicula['año']=$_POST['año'];
          $pelicula['pais']=$_POST['pais'];
          $pelicula['protagonista']=$_POST['protagonistas'];
          $pelicula['foto']=$_FILES['foto']['name'];
          if($id>0){
            $this->db->where('id',$id);
            $this->db->update('pelicula', $pelicula);
            echo "
            <script>
              alert('Pelicula Actualizada  Correctamente');
            </script>

            ";

          }else {
              $this->db->insert('pelicula', $pelicula);
              echo "
              <script>
                alert('Pelicula Agregada  Correctamente');
              </script>

              ";
          }
            $name=$pelicula['foto'];
          if ($_FILES['foto']['error']==0) {
            move_uploaded_file($_FILES['foto']['tmp_name'],"imagenes/{$name}");

          }


      }


    $this->load->view('Plantillas/Header.php');
    $this->load->view('Peliculas.php', array('codigo'=>$codigo));
    $this->load->view('Plantillas/Pie.php');

  }

  function eliminar($codigo){
    $this->db->where('id',$codigo);
    $this->db->delete('pelicula');
    $link=base_url('Peliculas_controller');
    echo "
      <script>

        alert('Pelicula Eliminada Correctamente');
        window.location='{$link}';

      </script>

    ";
  }
}
