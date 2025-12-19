<?php
require_once 'config.php';

// Verificar se o ID foi passado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];

try {
    // Verificar se o usuário existe
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE id = :id");
    $stmt->execute([':id' => $id]);
    
    if ($stmt->fetch()) {
        // Deletar o usuário
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->execute([':id' => $id]);
        
        header('Location: index.php?msg=deletado');
        exit;
    }
} catch (PDOException $e) {
    // Em caso de erro, redirecionar para a página principal
    header('Location: index.php');
    exit;
}

header('Location: index.php');
exit;
?>
