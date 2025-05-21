<?php
// include dos arquivos
include_once '../include/logado.php';
include_once '../include/conexao.php';

$acao = $_GET['acao'] ?? '';

switch ($acao) {
    case 'cadastrar':
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        if (empty($nome) || empty($email) || empty($senha)) {
            echo "Preencha todos os campos!";
            exit;
        }

        // isso é pra criptografar a senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sss", $nome, $email, $senhaHash);
            if ($stmt->execute()) {
                echo "Usuário cadastrado com sucesso!";
                echo '<br><br><a href="../index.php" style="
                display: inline-block;
                padding: 10px 20px;
                background-color: #333;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                ">Voltar ao Menu Principal</a>';

            } else {
                echo "Erro ao cadastrar: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Erro na preparação do SQL: " . $conn->error;
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