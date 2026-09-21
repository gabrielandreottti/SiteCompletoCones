<?php
$sucesso = $_GET['sucesso'] ?? '';
$erro = $_GET['erro'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MM Doces | Cones Recheados</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/site.css">
</head>
<body>
<header class="header">
    <a class="logo" href="#inicio"><span>🍦</span><div><strong>MM Doces</strong><small>CONES RECHEADOS</small></div></a>
    <nav>
        <a href="#inicio">Início</a>
        <a href="#sabores">Sabores</a>
        <a href="#cadastro">Cadastro</a>
        <a href="#localizacao">Localização</a>
        <a href="<?= BASE_URL ?>/index.php?acao=pedidos">Pedidos</a>
    </nav>
    <a class="header-button" href="#cadastro">Pedir agora</a>
</header>

<?php if ($sucesso): ?><div class="alert success"><?= htmlspecialchars($sucesso) ?></div><?php endif; ?>
<?php if ($erro): ?><div class="alert error"><?= htmlspecialchars($erro) ?></div><?php endif; ?>

<main>
<section class="hero" id="inicio">
    <div class="hero-content">
        <span class="eyebrow">✦ CONES ARTESANAIS ✦</span>
        <h1>O cone perfeito para o seu <strong>momento.</strong></h1>
        <p>Cones crocantes, recheados e preparados com carinho para deixar seu dia mais doce.</p>
        <div class="actions"><a class="btn primary" href="#sabores">Ver sabores</a><a class="btn outline" href="#cadastro">Fazer pedido</a></div>
    </div>
    <div class="hero-art" aria-hidden="true"><div class="blob"></div><div class="cone">🍦</div><span class="sparkle s1">✦</span><span class="sparkle s2">✧</span></div>
</section>

<section>
    <article>
        <div>
            <h1  style="text-align: center;">PROMOÇÃO DO DIA!!!</h1>
            <h2  style="text-align: center;">NA COMPRA DE TRÊS DOS NOSSOS CONES O VALOR SAI POR APENAS  R$15,00!!!</h2>
        </div>
    </article>
</section>

<section class="section" id="sabores">
    <div class="products">

        <?php 
        $produtos = [
            ['Cone Brigadeiro', 'CHOCOLATE', 'Cone crocante com recheio cremoso de brigadeiro.', '🍫'],
            ['Cone Morango', 'MORANGO', 'Recheio de morango.', '🍓'],
            ['Cone Maracujá', 'MARACUJÁ', 'Creme de maracujá.', '🍊'],
            ['Cone Limão', 'LIMÃO', 'Creme de limão.', '🍋'],
            ['Cone Uva', 'Uva', 'Creme de uva.', '🍇'],
            ['Cone Beijinho', 'Beijinho', 'Creme de beijinho.', '🥥'],
            ['Cone Chocolate Branco', 'Chocolate Branco', 'Creme de chocolate branco.', '⚪'],
            ['Cone Ninho', 'NINHO', 'Creme de ninho.', '🥛'],
        ];

        foreach ($produtos as $produto): 
        ?>
            
            <article class="product-card" data-sabor="<?= htmlspecialchars($produto[0], ENT_QUOTES) ?>" role="button" tabindex="0" aria-label="Selecionar <?= htmlspecialchars($produto[0]) ?>">
                
                <!-- Imagem ou ícone do banco de dados com a ação de clique -->
                <div class="product-image" onclick="selecionarSabor('<?= htmlspecialchars($produto[0], ENT_QUOTES) ?>')">
                    <?= $produto[3] ?>
                </div>
                
                <div class="product-body">
                    <!-- Categoria (ex: MORANGO, CHOCOLATE) -->
                    <span><?= htmlspecialchars($produto[1]) ?></span>
                    
                    <!-- Nome do Cone -->
                    <h3><?= htmlspecialchars($produto[0]) ?></h3>
                    
                    <!-- Descrição do recheio -->
                    <p><?= htmlspecialchars($produto[2]) ?></p>
                    
                    <div class="price">
                        <strong>R$ 7,00</strong>
                        <button type="button" onclick="selecionarSabor('<?= htmlspecialchars($produto[0], ENT_QUOTES) ?>')" title="Selecionar este sabor">+</button>
                    </div>
                </div>

            </article>

        <?php endforeach; ?>

    </div>
</section>

<section class="register" id="cadastro">
    <div class="register-text">
        <span class="eyebrow">✦ FAÇA SEU PEDIDO ✦</span>
        <h2>Reserve seu <strong>cone recheado.</strong></h2>
        <p>Preencha seus dados, escolha o sabor, a quantidade, telefone e forma de pagamento. Depois é só retirar na loja.</p>
        <div class="store-card"><span>📍</span><div><strong>Retirada presencial</strong><p>Rua Joaquim Rondina, 293<br>Centro — Agudos/SP</p></div></div>
    </div>
    <div class="form-card">
        <h3>Cadastro do cliente</h3>
        <form action="<?= BASE_URL ?>/index.php?acao=criar" method="post" autocomplete="off">
            <label for="nome">Nome completo</label>
            <input id="nome" name="nome" type="text" placeholder="Digite seu nome" required maxlength="100">
            <label for="email">E-mail</label>
            <input id="email" name="email" type="email" placeholder="seuemail@email.com" required maxlength="150">
            <label for="sabor">Sabor</label>
            <select id="sabor" name="sabor" required>
                <option value="">Selecione um sabor</option>
                <?php foreach ($sabores as $sabor): ?>
                    <option value="<?= htmlspecialchars($sabor) ?>"><?= htmlspecialchars($sabor) ?></option>
                <?php endforeach; ?>
            </select>
            <label for="quantidade">Quantidade de cones (1 a 100)</label>
            <input id="quantidade" name="quantidade" type="number" min="1" max="100" value="1" required>
            <div class="form-grid">
                <div>
                    <label for="telefone">Telefone</label>
                    <input id="telefone" name="telefone" type="tel" inputmode="numeric" autocomplete="tel" placeholder="(14) 99999-9999" maxlength="15" required>
                </div>
                <div>
                    <label for="pagamento">Pagamento</label>
                    <select id="pagamento" name="forma_de_pagamento" required>
                        <option value="">Selecione</option>
                        <?php foreach (['Pix','Cartão de crédito','Cartão de débito','Dinheiro'] as $pagamento): ?>
                            <option value="<?= htmlspecialchars($pagamento) ?>"><?= htmlspecialchars($pagamento) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button class="submit" type="submit">Confirmar pedido →</button>
        </form>
        <small>🔒 Seus dados serão usados apenas para o atendimento.</small>
    </div>
</section>

<section class="location" id="localizacao">
    <div><span class="eyebrow">✦ VISITE NOSSA LOJA</span><h2>Venha buscar seu <strong>cone favorito.</strong></h2><p>Faça seu pedido pelo site e retire presencialmente em nossa loja.</p></div>
    <div class="address"><span>📍</span><div><strong>MM Doces</strong><p>Rua Joaquim Rondina, 293<br>Centro — Agudos/SP</p></div></div>
</section>
</main>
<footer><strong>MM Doces</strong> · Cones recheados feitos com carinho.</footer>
<script src="<?= BASE_URL ?>/assets/site.js"></script>
</body>
</html>
