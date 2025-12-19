<?php
require_once 'config.php';

$erro = '';
$sucesso = '';

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
        // Inserir no banco
        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, telefone) VALUES (:nome, :email, :telefone)");
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':telefone' => $telefone
            ]);
            
            header('Location: index.php?msg=criado');
            exit;
        } catch (PDOException $e) {
            $erro = 'Erro ao criar usuário: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP - Novo Usuário</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>➕ Novo Usuário</h2>

        <?php if ($erro): ?>
            <div class="message message-error"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome *</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>" placeholder="Digite o nome completo" required>
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" placeholder="Digite o email" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($_POST['telefone'] ?? ''); ?>" placeholder="(00) 00000-0000">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
