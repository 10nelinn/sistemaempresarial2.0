<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

//comando sql para executar
$sql = "SELECT pc.ProducaoID, pd.Nome AS PDNome, pc.DataProducao AS DataProduc, pc.ClienteID, c.Nome AS CNome, f.Nome AS FNome, pc.DataEntrega AS DataEntre FROM producao AS pc
INNER JOIN produtos AS pd ON pc.ProdutoID = pd.ProdutoID
INNER JOIN clientes AS c ON pc.ClienteID = c.ClienteID
INNER JOIN funcionarios AS f ON pc.FuncionarioID = f.FuncionarioID";

//execurtar e retornar os dados
$resultado = mysqli_query($conn,$sql);
?>
  <main>

    <div class="container">
        <h1>Lista de Produções</h1>
        <a href="./salvar-producao.php" class="btn btn-add">Incluir</a> 
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Produto</th>
              <th>Funcionario</th>
              <th>Cliente</th>
              <th>Data de Produção</th>
              <th>Data de Entrega</th>
              <th>Ações</th>
            </tr>
          </thead>

          <?php
          while ($dado = mysqli_fetch_assoc($resultado)) {
        ?>
          <tbody>
            <tr>
              <td><?php echo $dado['ProducaoID']?></td>
              <td><?php echo $dado['PDNome']?></td>
              <td><?php echo $dado['FNome']?></td>
              <td><?php echo $dado['CNome']?></td>
              <td><?php echo $dado['DataProduc']?></td>
              <td><?php echo $dado['DataEntre']?></td>
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