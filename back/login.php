<?php
// Inicia a exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';  // Certifique-se de que o caminho para o arquivo está correto

// Variável para armazenar mensagens de erro ou sucesso
$mensagem = '';

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se a conexão com o banco foi feita corretamente
    if (isset($pdo)) { // Verifica se a variável $pdo existe
        // Prepara a consulta para buscar o usuário no banco de dados
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql); // Prepara a consulta
        $stmt->bindParam(':email', $email); // Liga a variável ao parâmetro

        // Executa a consulta
        $stmt->execute();

        // Verifica se o usuário foi encontrado
        if ($stmt->rowCount() > 0) {
            // O usuário foi encontrado, agora verificamos a senha
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica se a senha fornecida corresponde à senha criptografada no banco
            if (password_verify($senha, $usuario['senha'])) {
                // Login bem-sucedido
                session_start();  // Inicia a sessão
                $_SESSION['usuario_id'] = $usuario['id'];  // Armazena o ID do usuário na sessão
                $_SESSION['usuario_nome'] = $usuario['nome'];  // Armazena o nome do usuário na sessão

                // Mensagem de sucesso (opcional)
                $mensagem = "Login bem-sucedido!";
                
                // Redireciona para a página principal ou painel
                header('Location: /recynic/tccrecynic/recynichome.html');  // Redireciona para a página do painel de controle
                exit();  // Interrompe a execução do código após o redirecionamento
            } else {
                // A senha está incorreta
                $mensagem = "Senha incorreta!";
            }
        } else {
            // Usuário não encontrado
            $mensagem = "Usuário não encontrado!";
        }
    } else {
        // Erro na conexão com o banco de dados
        $mensagem = "Erro ao conectar com o banco de dados.";
    }
}
?>

<!-- Exibe a mensagem de erro ou sucesso -->
<?php if ($mensagem): ?>
    <div class="alert"><?php echo $mensagem; ?></div>
<?php endif; ?>
