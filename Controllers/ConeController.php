<?php
declare(strict_types=1);

require_once MODEL_PATH . '/ConeModel.php';

class ConeController
{
    private ConeModel $model;

    private array $sabores = [
        'Cone Brigadeiro',
        'Cone Morango',
        'Cone Maracujá',
        'Cone Limão'
    ];

    private array $pagamentos = [
        'Pix',
        'Cartão de crédito',
        'Cartão de débito',
        'Dinheiro'
    ];

    /** Preço unitário de cada cone em reais */
    public const PRECO_UNITARIO = 8.00;

    public function __construct(mysqli $conexao)
    {
        $this->model = new ConeModel($conexao);
    }

    public function inicio(): void
    {
        $sabores = $this->sabores;
        require VIEW_PATH . '/Cones/site.php';
    }

    public function listar(): void
    {
        $pedidos = $this->model->listar();
        $precoUnitario = self::PRECO_UNITARIO;
        $totalGeral = 0.0;
        foreach ($pedidos as $pedido) {
            $qtd = max(1, (int)($pedido['quantidade'] ?? 1));
            $totalGeral += $qtd * $precoUnitario;
        }
        require VIEW_PATH . '/Cones/pedidos.php';
    }

    public function criar(): void
    {
        $dados = $this->dadosDoPost();
        $erros = $this->validar($dados);

        if ($erros) {
            $mensagem = implode(' ', $erros);
            header('Location: ' . BASE_URL . '/index.php?acao=inicio&erro=' . urlencode($mensagem) . '#cadastro');
            exit;
        }

        $dados['telefone'] = $this->formatarTelefone($dados['telefone']);

        if ($this->model->cadastrar($dados)) {
            header('Location: ' . BASE_URL . '/index.php?acao=pedidos&sucesso=' . urlencode('Pedido cadastrado com sucesso!'));
        } else {
            header('Location: ' . BASE_URL . '/index.php?acao=inicio&erro=' . urlencode('Não foi possível cadastrar o pedido.') . '#cadastro');
        }
        exit;
    }

    public function editar(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: ' . BASE_URL . '/index.php?acao=pedidos&erro=' . urlencode('Pedido inválido.'));
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $this->dadosDoPost();
            $erros = $this->validar($dados);

            if (!$erros) {
                $dados['telefone'] = $this->formatarTelefone($dados['telefone']);
            }

            if (!$erros && $this->model->atualizar($id, $dados)) {
                header('Location: ' . BASE_URL . '/index.php?acao=pedidos&sucesso=' . urlencode('Pedido atualizado com sucesso!'));
                exit;
            }

            $erro = $erros ? implode(' ', $erros) : 'Não foi possível atualizar o pedido.';
            header('Location: ' . BASE_URL . '/index.php?acao=editar&id=' . $id . '&erro=' . urlencode($erro));
            exit;
        }

        $pedido = $this->model->buscar($id);
        if (!$pedido) {
            header('Location: ' . BASE_URL . '/index.php?acao=pedidos&erro=' . urlencode('Pedido não encontrado.'));
            exit;
        }

        $sabores = $this->sabores;
        $pagamentos = $this->pagamentos;
        require VIEW_PATH . '/Cones/editar.php';
    }

    public function excluir(): void
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $this->model->excluir($id);
        }

        header('Location: ' . BASE_URL . '/index.php?acao=pedidos&sucesso=' . urlencode('Pedido excluído.'));
        exit;
    }

    private function dadosDoPost(): array
    {
        $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
        if ($quantidade === false || $quantidade === null) {
            $quantidade = 0;
        }

        return [
            'nome' => trim((string)($_POST['nome'] ?? '')),
            'email' => trim((string)($_POST['email'] ?? '')),
            'sabor' => trim((string)($_POST['sabor'] ?? '')),
            'quantidade' => $quantidade,
            'telefone' => trim((string)($_POST['telefone'] ?? '')),
            'forma_de_pagamento' => trim((string)($_POST['forma_de_pagamento'] ?? '')),
        ];
    }

    private function formatarTelefone(string $telefone): string
    {
        $numero = preg_replace('/\D+/', '', $telefone);
        if (strlen($numero) === 11) {
            return sprintf('(%s) %s-%s', substr($numero, 0, 2), substr($numero, 2, 5), substr($numero, 7, 4));
        }
        return sprintf('(%s) %s-%s', substr($numero, 0, 2), substr($numero, 2, 4), substr($numero, 6, 4));
    }

    private function validar(array $dados): array
    {
        $erros = [];

        if ($dados['nome'] === '' || mb_strlen($dados['nome']) < 3) {
            $erros[] = 'Informe um nome válido.';
        }
        if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            $erros[] = 'Informe um e-mail válido.';
        }
        if (!in_array($dados['sabor'], $this->sabores, true)) {
            $erros[] = 'Escolha um sabor válido.';
        }
        if ($dados['quantidade'] < 1 || $dados['quantidade'] > 100) {
            $erros[] = 'A quantidade deve ser entre 1 e 100 cones.';
        }
        $telefone = preg_replace('/\D+/', '', $dados['telefone']);
        if (!preg_match('/^\d{10,11}$/', $telefone)) {
            $erros[] = 'Informe um telefone válido com DDD, usando 10 ou 11 números.';
        }
        if (!in_array($dados['forma_de_pagamento'], $this->pagamentos, true)) {
            $erros[] = 'Escolha uma forma de pagamento válida.';
        }

        return $erros;
    }
}
