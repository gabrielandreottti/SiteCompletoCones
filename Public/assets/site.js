function selecionarSabor(sabor) {
    const campo = document.getElementById('sabor');
    if (campo) {
        campo.value = sabor;

        // Destaca visualmente o card selecionado
        document.querySelectorAll('.product-card').forEach(card => {
            card.classList.toggle('selecionado', card.dataset.sabor === sabor);
        });

        // Rola até o formulário e foca no nome
        document.getElementById('cadastro')?.scrollIntoView({ behavior: 'smooth' });
        setTimeout(() => {
            document.getElementById('nome')?.focus();
        }, 400);
    }
}

function formatarTelefone(campo) {
    let numero = campo.value.replace(/\D/g, '').slice(0, 11);
    if (numero.length <= 10) {
        numero = numero.replace(/^(\d{2})(\d)/, '($1) $2');
        numero = numero.replace(/(\d{4})(\d)/, '$1-$2');
    } else {
        numero = numero.replace(/^(\d{2})(\d{5})(\d)/, '($1) $2-$3');
    }
    campo.value = numero;
}

document.addEventListener('DOMContentLoaded', () => {
    const telefone = document.getElementById('telefone');
    if (telefone) {
        telefone.addEventListener('input', () => formatarTelefone(telefone));
        telefone.addEventListener('keydown', (e) => {
            const permitidas = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab', 'Home', 'End'];
            if (!permitidas.includes(e.key) && !/\d/.test(e.key)) e.preventDefault();
        });
    }

    // Clique no card inteiro também seleciona o sabor
    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('click', (e) => {
            // Evita duplo disparo se clicar no botão +
            if (e.target.closest('button')) return;
            const sabor = card.dataset.sabor;
            if (sabor) selecionarSabor(sabor);
        });
        card.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const sabor = card.dataset.sabor;
                if (sabor) selecionarSabor(sabor);
            }
        });
    });
});
