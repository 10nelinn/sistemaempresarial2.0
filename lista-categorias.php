<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

//comando sql para executar
$sql = "SELECT * FROM categorias";

//execurtar e retornar os dados
$resultado = mysqli_query($conn,$sql);
?>
  <main>

    <div class="container">
        <h1>Lista de Categorias</h1>
        <a href="./salvar-categorias.php" class="btn btn-add">Incluir</a>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Ações</th>
            </tr>
          </thead>

          <?php
          while ($dado = mysqli_fetch_assoc($resultado)) {
        ?>

          <tbody>
            <tr>
              <td><?php echo $dado['CategoriaID']?></td>
              <td><?php echo $dado['Nome']?></td>

              <td>
                <a href="#" class="btn btn-edit">Editar</a>
                <a href="#" class="btn btn-delete">Excluir</a>
              </td>
            </tr>
            
          </tbody>

          <?php
        }
        ?>

        </table>
      </div>


   
  </main>

  <?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>