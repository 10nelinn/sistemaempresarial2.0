<?php
// include dos arquivos
include_once   '../include/logado.php';
include_once   '../include/conexao.php';

// captura a acao dos dados
$acao = $_GET['acao'];

// validacao
switch ($acao) {
    case 'salvar':
        $nome = $_POST['nome'];
        $andar = $_POST['andar'];
        $cor = $_POST['cor'];
        
        $sql_include = "INSERT INTO setor (Nome, Andar, Cor) VALUES ('$nome', '$andar', '$cor')";
        
        // executar a sql_include

        // redirecionar para pagina lista de setores


        break;
    
    default:
        # code...
        break;
}
?>