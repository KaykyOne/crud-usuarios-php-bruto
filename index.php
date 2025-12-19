<?php
require_once 'config.php';

// Buscar todos os usuários
$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id DESC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Mensagem de sucesso
$mensagem = '';
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'criado':
            $mensagem = '<div class="message message-success">Usuário criado com sucesso!</div>';
            break;
        case 'atualizado':
            $mensagem = '<div class="message message-success">Usuário atualizado com sucesso!</div>';
            break;
        case 'deletado':
            $mensagem = '<div class="message message-success">Usuário deletado com sucesso!</div>';
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP - Lista de Usuários</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 CRUD PHP</h1>
            <a href="create.php" class="btn btn-success">+ Novo Usuário</a>
        </div>

        <?php echo $mensagem; ?>

        <?php if (count($usuarios) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['telefone'] ?? '-'); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($usuario['criado_em'])); ?></td>
                            <td class="actions">
                                <a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-warning">Editar</a>
                                <a href="delete.php?id=<?php echo $usuario['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar este usuário?')">Deletar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <h3>Nenhum usuário encontrado</h3>
                <p>Clique no botão acima para adicionar o primeiro usuário.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
