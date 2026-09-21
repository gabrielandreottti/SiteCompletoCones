<?php
declare(strict_types=1);

class ConeModel
{
    public function __construct(private mysqli $conexao) {}

    public function listar(): array
    {
        $sql = 'SELECT * FROM pedidos_cones ORDER BY id DESC';
        $resultado = $this->conexao->query($sql);
        return $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function buscar(int $id): ?array
    {
        $stmt = $this->conexao->prepare('SELECT * FROM pedidos_cones WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $pedido = $resultado->fetch_assoc() ?: null;
        $stmt->close();
        return $pedido;
    }

    public function cadastrar(array $dados): bool
    {
        $sql = 'INSERT INTO pedidos_cones (nome, email, sabor, quantidade, telefone, forma_de_pagamento)
                VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param(
            'sssiss',
            $dados['nome'],
            $dados['email'],
            $dados['sabor'],
            $dados['quantidade'],
            $dados['telefone'],
            $dados['forma_de_pagamento']
        );
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function atualizar(int $id, array $dados): bool
    {
        $sql = 'UPDATE pedidos_cones
                SET nome = ?, email = ?, sabor = ?, quantidade = ?, telefone = ?, forma_de_pagamento = ?
                WHERE id = ?';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param(
            'sssissi',
            $dados['nome'],
            $dados['email'],
            $dados['sabor'],
            $dados['quantidade'],
            $dados['telefone'],
            $dados['forma_de_pagamento'],
            $id
        );
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->conexao->prepare('DELETE FROM pedidos_cones WHERE id = ?');
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}
