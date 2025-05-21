<?php
include_once './include/logado.php';
include_once './include/conexao.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

echo "<h2>Relatórios da Empresa</h2>";

echo "<h3>Total de Produtos</h3>";
$sqlProdutos = "SELECT COUNT(*) AS total_produtos FROM produtos";
$resProdutos = mysqli_query($conn, $sqlProdutos);
$rowProdutos = mysqli_fetch_assoc($resProdutos);
echo "Total de produtos cadastrados: " . $rowProdutos['total_produtos'];

echo "<hr>";

echo "<h3>Funcionários por Setor</h3>";
$sqlFuncSetor = "
    SELECT setores.Nome AS setor, COUNT(funcionarios.FuncionarioID) AS total
    FROM funcionarios
    INNER JOIN setores ON funcionarios.Setor = setores.ID
    GROUP BY setores.Nome
";
$resFuncSetor = mysqli_query($conn, $sqlFuncSetor);
while ($row = mysqli_fetch_assoc($resFuncSetor)) {
    echo "Setor: " . $row['setor'] . " - Funcionários: " . $row['total'] . "<br>";
}

echo "<hr>";

echo "<h3>Produção por Mês</h3>";
$sqlProducao = "
    SELECT DATE_FORMAT(data_producao, '%Y-%m') AS mes, COUNT(*) AS total
    FROM producao
    GROUP BY mes
    ORDER BY mes DESC
";
$resProducao = mysqli_query($conn, $sqlProducao);
while ($row = mysqli_fetch_assoc($resProducao)) {
    echo "Mês: " . $row['mes'] . " - Produções: " . $row['total'] . "<br>";
}
?>