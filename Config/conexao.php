<?php
declare(strict_types=1);

$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'conephp';

$conexao = new mysqli($host, $usuario, $senha);

if ($conexao->connect_errno) {
    die('Erro ao conectar ao MySQL: ' . htmlspecialchars($conexao->connect_error));
}

$conexao->query("CREATE DATABASE IF NOT EXISTS `$banco` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$conexao->select_db($banco);

$conexao->query("CREATE TABLE IF NOT EXISTS pedidos_cones (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    sabor VARCHAR(60) NOT NULL,
    quantidade INT UNSIGNED NOT NULL DEFAULT 1,
    telefone VARCHAR(15) NOT NULL,
    forma_de_pagamento ENUM('Pix', 'Cartão de crédito', 'Cartão de débito', 'Dinheiro') NOT NULL,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id), INDEX idx_email (email), INDEX idx_criado_em (criado_em)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

// Compatibilidade: adiciona telefone se não existir (tabelas antigas)
$coluna = $conexao->query("SHOW COLUMNS FROM pedidos_cones LIKE 'telefone'");
if ($coluna && $coluna->num_rows === 0) {
    $conexao->query("ALTER TABLE pedidos_cones ADD COLUMN telefone VARCHAR(15) NULL AFTER sabor");
    $conexao->query("UPDATE pedidos_cones SET telefone = '(00) 0000-0000' WHERE telefone IS NULL OR telefone = ''");
    $conexao->query("ALTER TABLE pedidos_cones MODIFY telefone VARCHAR(15) NOT NULL");
}

// Compatibilidade: adiciona quantidade se não existir
$colunaQtd = $conexao->query("SHOW COLUMNS FROM pedidos_cones LIKE 'quantidade'");
if ($colunaQtd && $colunaQtd->num_rows === 0) {
    $conexao->query("ALTER TABLE pedidos_cones ADD COLUMN quantidade INT UNSIGNED NOT NULL DEFAULT 1 AFTER sabor");
}

$conexao->set_charset('utf8mb4');
