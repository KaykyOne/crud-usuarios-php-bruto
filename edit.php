<?php
require_once 'config.php';

$erro = '';
$usuario = null;

// Verificar se o ID foi passado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];

// Buscar usuário
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header('Location: index.php');
    exit;
}

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');

    // Validação
    if (empty($nome)) {
        $erro = 'O nome é obrigatório.';
    } elseif (empty($email)) {
        $erro = 'O email é obrigatório.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Por favor, insira um email válido.';
    } else {
        // Atualizar no banco
        try {
            $stmt = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id");
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':telefone' => $telefone,
                ':id' => $id
            ]);
            
            header('Location: index.php?msg=atualizado');
            exit;
        } catch (PDOException $e) {
            $erro = 'Erro ao atualizar usuário: ' . $e->getMessage();
        }
    }
    
    // Manter os valores do formulário em caso de erro
    $usuario['nome'] = $nome;
    $usuario['email'] = $email;
    $usuario['telefone'] = $telefone;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP - Editar Usuário</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>✏️ Editar Usuário</h2>

        <?php if ($erro): ?>
            <div class="message message-error"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome *</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" placeholder="Digite o nome completo" required>
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" placeholder="Digite o email" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone'] ?? ''); ?>" placeholder="(00) 00000-0000">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Atualizar</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
