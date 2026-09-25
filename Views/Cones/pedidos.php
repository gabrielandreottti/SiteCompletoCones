<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos | MM Doces</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/site.css">
</head>

<body class="admin-page">
     <a class="logo" href="<?= BASE_URL ?>/index.php?acao=inicio">

    <span class="logo-img">
        <img
            src="<?= BASE_URL ?>/assets/img/doces.png"
            alt="MM Doces"
        >
    </span>

    <div class="logo-text">
        <strong>MM Doces</strong>
        <small>CONES RECHEADOS</small>
    </div>

</a>
    <main class="admin-container">
        
        <?php

$precoUnitario = 7.00;

$totalGeral = 0.00;
$totalCones = 0;

if (is_array($pedidos)) {

    foreach ($pedidos as $pedido) {

        $qtd = max(
            1,
            (int)($pedido['quantidade'] ?? 1)
        );

        $totalCones += $qtd;

        $totalGeral +=
            $qtd * $precoUnitario;
    }
}

?>
        <div class="admin-heading">
    <div>
        <span class="eyebrow">✦ ADMINISTRAÇÃO</span>
        <h1>Pedidos cadastrados</h1>
        <p>Visualize, edite ou exclua os pedidos registrados no banco.</p>
    </div>
    <div class="admin-actions">
        <div class="totais-abas">
            <div class="aba-total">
                <span>Pedidos</span>
                <strong><?= count($pedidos) ?></strong>
            </div>
            <div class="aba-total">
                <span>Cones</span>
                <strong><?= $totalCones ?></strong>
            </div>
            <div class="aba-total destaque">
                <span>Total</span>
                <strong>R$ <?= number_format($totalGeral, 2, ',', '.') ?></strong>
            </div>
        </div>
        <a class="btn primary" href="<?= BASE_URL ?>/index.php?acao=inicio#cadastro">+ Novo pedido</a>
    </div>
</div>

        <div class="table-card">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Sabor</th>
                            <th>Qtd</th>
                            <th>Total</th>
                            <th>Pagamento</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$pedidos): ?>
                            <tr>
                            <td colspan="10" class="empty">Nenhum pedido cadastrado ainda. </td>
                            </tr><?php endif; ?>
                        <?php foreach ($pedidos as $pedido):
                            $qtd = max(1, (int)($pedido['quantidade'] ?? 1));
                            $totalPedido = $qtd * 7.00;
                        ?>
                            <tr>
                                <td><?= (int) $pedido['id'] ?></td>
                                <td><?= htmlspecialchars($pedido['nome']) ?></td>
                                <td><?= htmlspecialchars($pedido['email']) ?></td>
                                <td><?= htmlspecialchars($pedido['telefone']) ?></td>
                                <td><?= htmlspecialchars($pedido['sabor']) ?></td>
                                <td><?= $qtd ?></td>
                                <td><strong>R$ <?= number_format($totalPedido, 2, ',', '.') ?></strong></td>
                                <td><?= htmlspecialchars($pedido['forma_de_pagamento']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($pedido['criado_em'])) ?></td>
                                <td class="actions-cell"><a
                                        href="<?= BASE_URL ?>/index.php?acao=editar&id=<?= (int) $pedido['id'] ?>">Editar</a>
                                    <form action="<?= BASE_URL ?>/index.php?acao=excluir" method="post"
                                        onsubmit="return confirm('Excluir este pedido?');"><input type="hidden" name="id"
                                            value="<?= (int) $pedido['id'] ?>"><button type="submit">Excluir</button></form>
                                </td>
                            </tr><?php endforeach; ?>
                    </tbody>
                    <?php if ($pedidos): ?>
                    
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </main>
</body>

</html>
