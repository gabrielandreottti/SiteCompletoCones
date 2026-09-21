<?php
declare(strict_types=1);

require_once __DIR__ . '/../Config/config.php';
require_once __DIR__ . '/../Config/conexao.php';
require_once CONTROLLER_PATH . '/ConeController.php';

$controller = new ConeController($conexao);
$acao = $_GET['acao'] ?? 'inicio';

switch ($acao) {
    case 'inicio':
        $controller->inicio();
        break;
    case 'criar':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/index.php?acao=inicio');
            exit;
        }
        $controller->criar();
        break;
    case 'pedidos':
        $controller->listar();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'excluir':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/index.php?acao=pedidos');
            exit;
        }
        $controller->excluir();
        break;
    default:
        http_response_code(404);
        echo 'Página não encontrada.';
}
