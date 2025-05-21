<?php
// include dos arquivos
include_once '../include/logado.php';
include_once '../include/conexao.php';

// captura a acao dos dados
$acao = $_GET['acao'] ?? '';

switch ($acao) {
    case 'cadastrar':
        // Captura os dados do formulário via POST
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        // Validação simples
        if (empty($nome) || empty($email) || empty($senha)) {
            echo "Todos os campos são obrigatórios!";
            exit;
        }

        // Criptografar a senha (usando password_hash)
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Inserir no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sss", $nome, $email, $senhaHash);
            if ($stmt->execute()) {
                echo "Usuário cadastrado com sucesso!";
            } else {
                echo "Erro ao cadastrar: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Erro na preparação da consulta: " . $conn->error;
        }

        break;

    default:
        ?>
        <h2>Cadastro de Usuário</h2>
        <form method="POST" action="?acao=cadastrar">
            <label>Nome:</label><br>
            <input type="text" name="nome" required><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" required><br><br>

            <label>Senha:</label><br>
            <input type="password" name="senha" required><br><br>

            <button type="submit">Cadastrar</button>
        </form>
        <?php
        break;
}
?>