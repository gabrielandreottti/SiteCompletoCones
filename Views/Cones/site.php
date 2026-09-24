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

    <style>
        /* =========================
           LOGO DO CABEÇALHO
        ========================== */

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo > span {
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
            border-radius: 50%;
        }

        .logo > span img {
            width: 55px !important;
            height: 55px !important;
            max-width: 55px !important;
            max-height: 55px !important;
            object-fit: contain;
            border-radius: 50%;
            display: block;
            background: #754a2c;
        }


        /* =========================
           IMAGENS DOS PRODUTOS
        ========================== */

        .product-image {
            width: 100%;
            height: 230px;
            background: #f5e6d8;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 22px 22px 0 0;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        .product-card {
            overflow: hidden;
        }

        .product-body {
            background: #fff;
            padding: 20px;
        }


            /* =========================
                 IMAGEM PRINCIPAL
            ========================= */

.hero-art .cone {
    position: relative;

    width: 330px;
    height: 330px;

    border-radius: 50%;

    overflow: hidden;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #754a2c;

    z-index: 2;
}

.hero-art .cone img {
    width: 100% !important;
    height: 100% !important;

    max-width: 100% !important;
    max-height: 100% !important;

    object-fit: contain;

    border-radius: 50%;

    display: block;
}


        /* =========================
           PROMOÇÃO
        ========================== */

        .promotion {
            padding: 35px 5%;
            text-align: center;
            background: #fff;
            border-block: 1px solid #e6d3c3;
        }

        .promotion h1 {
            margin: 0 0 10px;
            color: #4a2818;
        }

        .promotion h2 {
            margin: 0;
            color: #6b3e26;
            font-size: 1.3rem;
        }
    </style>
</head>

<body>

<header class="header">

    <a class="logo" href="#inicio">
        <span>
            <img src="<?= BASE_URL ?>/assets/img/doces.png" alt="MMDOCES">
        </span>

        <div>
            <strong>MM Doces</strong>
            <small>CONES RECHEADOS</small>
        </div>
    </a>

    <nav>
        <a href="#inicio">Início</a>
        <a href="#sabores">Sabores</a>
        <a href="#cadastro">Cadastro</a>
        <a href="#localizacao">Localização</a>
        <a href="<?= BASE_URL ?>/index.php?acao=pedidos">
            Pedidos
        </a>
    </nav>

    <a class="header-button" href="#cadastro">
        Pedir agora
    </a>

</header>

<?php if ($sucesso): ?>
    <div class="alert success">
        <?= htmlspecialchars($sucesso) ?>
    </div>
<?php endif; ?>

<?php if ($erro): ?>
    <div class="alert error">
        <?= htmlspecialchars($erro) ?>
    </div>
<?php endif; ?>


<main>

    <!-- =========================
         HERO
    ========================== -->

    <section class="hero" id="inicio">

        <div class="hero-content">

            <span class="eyebrow">
                ✦ CONES ARTESANAIS ✦
            </span>

            <h1>
                O cone perfeito para o seu
                <strong>momento.</strong>
            </h1>

            <p>
                Cones crocantes, recheados e preparados com carinho
                para deixar seu dia mais doce.
            </p>

            <div class="actions">

                <a class="btn primary" href="#sabores">
                    Ver sabores
                </a>

                <a class="btn outline" href="#cadastro">
                    Fazer pedido
                </a>

            </div>

        </div>


        <div class="hero-art" aria-hidden="true">

            <div class="blob"></div>

            <div class="cone">
                <img
                    src="<?= BASE_URL ?>/assets/img/doces.png"
                    alt="Cone recheado"
                >
            </div>

            <span class="sparkle s1">
                ✦
            </span>

            <span class="sparkle s2">
                ✧
            </span>

        </div>

    </section>


    <!-- =========================
         PROMOÇÃO
    ========================== -->

    <section class="promotion">

        <article>

            <h1>
                PROMOÇÃO DO DIA!!!
            </h1>

            <h2>
                NA COMPRA DE TRÊS DOS NOSSOS CONES
                O VALOR SAI POR APENAS R$15,00!!!
            </h2>

        </article>

    </section>


    <!-- =========================
         SABORES
    ========================== -->

    <section class="section" id="sabores">

        <div class="section-heading">

            <span class="eyebrow">
                ✦ NOSSOS SABORES ✦
            </span>

            <h2>
                Escolha seu
                <strong>cone favorito.</strong>
            </h2>

            <p>
                Temos vários sabores preparados especialmente
                para você.
            </p>

        </div>


        <div class="products">

            <?php
            $produtos = [
                [
                    'Cone Brigadeiro',
                    'CHOCOLATE',
                    'Cone crocante com recheio cremoso de brigadeiro.',
                    'assets/img/cone.png'
                ],
                [
                    'Cone Morango',
                    'MORANGO',
                    'Recheio cremoso de morango.',
                    'assets/img/cone.png'
                ],
                [
                    'Cone Maracujá',
                    'MARACUJÁ',
                    'Creme delicioso de maracujá.',
                    'assets/img/cone.png'
                ],
                [
                    'Cone Limão',
                    'LIMÃO',
                    'Creme refrescante de limão.',
                    'assets/img/cone.png'
                ],
                [
                    'Cone Uva',
                    'UVA',
                    'Creme especial de uva.',
                    'assets/img/cone.png'
                ],
                [
                    'Cone Beijinho',
                    'BEIJINHO',
                    'Creme de beijinho com sabor especial.',
                    'assets/img/cone.png'
                ],
                [
                    'Cone Chocolate Branco',
                    'CHOCOLATE BRANCO',
                    'Creme de chocolate branco.',
                    'assets/img/cone.png'
                ],
                [
                    'Cone Ninho',
                    'NINHO',
                    'Creme de ninho.',
                    'assets/img/cone.png'
                ]
            ];

            foreach ($produtos as $produto):
            ?>

                <article
                    class="product-card"
                    data-sabor="<?= htmlspecialchars($produto[0], ENT_QUOTES) ?>"
                    role="button"
                    tabindex="0"
                    aria-label="Selecionar <?= htmlspecialchars($produto[0]) ?>"
                >

                    <div
                        class="product-image"
                        onclick="selecionarSabor('<?= htmlspecialchars($produto[0], ENT_QUOTES) ?>')"
                    >

                        <img
                            src="<?= BASE_URL ?>/<?= htmlspecialchars($produto[3]) ?>"
                            alt="<?= htmlspecialchars($produto[0]) ?>"
                        >

                    </div>


                    <div class="product-body">

                        <span>
                            <?= htmlspecialchars($produto[1]) ?>
                        </span>

                        <h3>
                            <?= htmlspecialchars($produto[0]) ?>
                        </h3>

                        <p>
                            <?= htmlspecialchars($produto[2]) ?>
                        </p>


                        <div class="price">

                            <strong>
                                R$ 7,00
                            </strong>

                            <button
                                type="button"
                                onclick="selecionarSabor('<?= htmlspecialchars($produto[0], ENT_QUOTES) ?>')"
                                title="Selecionar este sabor"
                            >
                                +
                            </button>

                        </div>

                    </div>

                </article>

            <?php endforeach; ?>

        </div>

    </section>


    <!-- =========================
         CADASTRO / PEDIDO
    ========================== -->

    <section class="register" id="cadastro">

        <div class="register-text">

            <span class="eyebrow">
                ✦ FAÇA SEU PEDIDO ✦
            </span>

            <h2>
                Reserve seu
                <strong>cone recheado.</strong>
            </h2>

            <p>
                Preencha seus dados, escolha o sabor, a quantidade,
                telefone e forma de pagamento. Depois é só retirar na loja.
            </p>


            <div class="store-card">

                <span>
                    📍
                </span>

                <div>

                    <strong>
                        Retirada presencial
                    </strong>

                    <p>
                        Rua Joaquim Rondina, 293
                        <br>
                        Centro — Agudos/SP
                    </p>

                </div>

            </div>

        </div>


        <div class="form-card">

            <h3>
                Cadastro do cliente
            </h3>


            <form
                action="<?= BASE_URL ?>/index.php?acao=criar"
                method="post"
                autocomplete="off"
            >

                <label for="nome">
                    Nome completo
                </label>

                <input
                    id="nome"
                    name="nome"
                    type="text"
                    placeholder="Digite seu nome"
                    required
                    maxlength="100"
                >


                <label for="email">
                    E-mail
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="seuemail@email.com"
                    required
                    maxlength="150"
                >


                <label for="sabor">
                    Sabor
                </label>

                <select
                    id="sabor"
                    name="sabor"
                    required
                >

                    <option value="">
                        Selecione um sabor
                    </option>

                    <?php foreach ($sabores as $sabor): ?>

                        <option
                            value="<?= htmlspecialchars($sabor) ?>"
                        >
                            <?= htmlspecialchars($sabor) ?>
                        </option>

                    <?php endforeach; ?>

                </select>


                <label for="quantidade">
                    Quantidade de cones (1 a 100)
                </label>

                <input
                    id="quantidade"
                    name="quantidade"
                    type="number"
                    min="1"
                    max="100"
                    value="1"
                    required
                >


                <div class="form-grid">

                    <div>

                        <label for="telefone">
                            Telefone
                        </label>

                        <input
                            id="telefone"
                            name="telefone"
                            type="tel"
                            inputmode="numeric"
                            autocomplete="tel"
                            placeholder="(14) 99999-9999"
                            maxlength="15"
                            required
                        >

                    </div>


                    <div>

                        <label for="pagamento">
                            Pagamento
                        </label>

                        <select
                            id="pagamento"
                            name="forma_de_pagamento"
                            required
                        >

                            <option value="">
                                Selecione
                            </option>

                            <?php foreach (
                                [
                                    'Pix',
                                    'Cartão de crédito',
                                    'Cartão de débito',
                                    'Dinheiro'
                                ] as $pagamento
                            ): ?>

                                <option
                                    value="<?= htmlspecialchars($pagamento) ?>"
                                >
                                    <?= htmlspecialchars($pagamento) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                </div>


                <button
                    class="submit"
                    type="submit"
                >
                    Confirmar pedido →
                </button>

            </form>


            <small>
                Seus dados serão usados apenas para o atendimento.
            </small>

        </div>

    </section>


    <!-- =========================
         LOCALIZAÇÃO
    ========================== -->

    <section
        class="location"
        id="localizacao"
    >

        <div>

            <span class="eyebrow">
                ✦ VISITE NOSSA LOJA
            </span>

            <h2>
                Venha buscar seu
                <strong>cone favorito.</strong>
            </h2>

            <p>
                Faça seu pedido pelo site e retire presencialmente
                em nossa loja.
            </p>

        </div>


        <div class="address">

            <span>
                📍
            </span>

            <div>

                <strong>
                    MM Doces
                </strong>

                <p>
                    Rua Joaquim Rondina, 293
                    <br>
                    Centro — Agudos/SP
                </p>

            </div>

        </div>

    </section>

</main>


<!-- =========================
     RODAPÉ
========================== -->

<footer>

    <strong>
        MM Doces
    </strong>

    · Cones recheados feitos com carinho.

</footer>


<script src="<?= BASE_URL ?>/assets/site.js"></script>

</body>
</html>