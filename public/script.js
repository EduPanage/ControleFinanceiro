document.addEventListener('DOMContentLoaded', function() {
    const elems = document.querySelectorAll('select');
    M.FormSelect.init(elems);
});

document.getElementById("formCadastro")?.addEventListener("submit", function(event) {
    const senha = document.getElementById("senha").value;
    const confirm_senha = document.getElementById("confirm_senha").value;
    
    if (senha !== confirm_senha) {
        event.preventDefault();
        alert("As senhas não coincidem. Tente novamente.");
    }
});

document.getElementById("formTransacao")?.addEventListener("submit", function(event) {
    event.preventDefault();
    
    const valor = document.getElementById('valor').value;
    const tipo = document.getElementById('tipo_transacao').value;
    const historico = document.getElementById('historico');
    
    const item = document.createElement('li');
    item.className = 'collection-item';
    item.innerHTML = `<strong>Tipo:</strong> ${tipo} - <strong>Valor:</strong> R$ ${parseFloat(valor).toFixed(2)}`;
    
    historico.appendChild(item);

    document.getElementById('formTransacao').reset();
    M.FormSelect.init(document.querySelectorAll('select'));
});
