<?php
// Conectar ao banco de dados com PDO (conforme o código anterior)
include 'conexao.php';  // Inclui a configuração de conexão com o banco de dados

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Criptografa a senha antes de armazená-la
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    // Prepara a consulta para inserir os dados no banco de dados usando PDO
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";

    // Prepara a consulta no PDO
    $stmt = $pdo->prepare($sql);

    // Vincula os parâmetros
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha_criptografada);

    // Executa a consulta e verifica se foi bem-sucedida
    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro: " . $stmt->errorInfo()[2];  // Exibe o erro detalhado, se houver
    }
}
?>


