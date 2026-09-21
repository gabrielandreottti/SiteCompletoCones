<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar pedido | MM Doces</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/site.css">
</head>

<body class="admin-page">
    <header class="header"><a class="logo" href="<?= BASE_URL ?>/index.php?acao=inicio"><span>🍦</span>
            <div><strong>MM Doces</strong><small>CONES RECHEADOS</small></div>
        </a></header>
    <main class="edit-container">
        <div class="form-card wide"><span class="eyebrow">✦ PEDIDO #<?= (int) $pedido['id'] ?></span>
            <h1>Editar pedido</h1><?php if (!empty($_GET['erro'])): ?>
                <div class="alert error"><?= htmlspecialchars($_GET['erro']) ?></div><?php endif; ?>
            <form action="<?= BASE_URL ?>/index.php?acao=editar&id=<?= (int) $pedido['id'] ?>" method="post">
                <label for="nome">Nome completo</label>
                <input id="nome" name="nome" value="<?= htmlspecialchars($pedido['nome']) ?>" required maxlength="100">
                <label for="email">E-mail</label>
                <input id="email" name="email" type="email" value="<?= htmlspecialchars($pedido['email']) ?>" required maxlength="150">
                <div class="form-grid">
                    <div>
                        <label for="sabor">Sabor</label>
                        <select id="sabor" name="sabor" required>
                            <?php foreach ($sabores as $sabor): ?>
                                <option value="<?= htmlspecialchars($sabor) ?>" <?= $pedido['sabor'] === $sabor ? 'selected' : '' ?>><?= htmlspecialchars($sabor) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="quantidade">Quantidade (1 a 100)</label>
                        <input id="quantidade" name="quantidade" type="number" min="1" max="100"
                            value="<?= (int)($pedido['quantidade'] ?? 1) ?>" required>
                    </div>
                </div>
                <div class="form-grid">
                    <div>
                        <label for="telefone">Telefone</label>
                        <input id="telefone" name="telefone" type="tel" inputmode="numeric" autocomplete="tel"
                            placeholder="(14) 99999-9999" maxlength="15"
                            value="<?= htmlspecialchars($pedido['telefone']) ?>" required>
                    </div>
                    <div>
                        <label for="pagamento">Forma de pagamento</label>
                        <select id="pagamento" name="forma_de_pagamento" required>
                            <?php foreach ($pagamentos as $pagamento): ?>
                                <option value="<?= htmlspecialchars($pagamento) ?>" <?= $pedido['forma_de_pagamento'] === $pagamento ? 'selected' : '' ?>><?= htmlspecialchars($pagamento) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <button class="submit" type="submit">Salvar alterações</button>
            </form>
            <a class="back-link" href="<?= BASE_URL ?>/index.php?acao=pedidos">← Voltar para pedidos</a>
        </div>
    </main>
    <script src="<?= BASE_URL ?>/assets/site.js"></script>
</body>

</html>
