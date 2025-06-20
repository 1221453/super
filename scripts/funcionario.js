window.addEventListener("DOMContentLoaded", function () {
  // Formulário: Adicionar Produto
  const formProduto = document.querySelector('form[action*="adicionar_produto.php"]');
  const nomeProduto = document.getElementById("nome-produto");
  const preco = document.getElementById("preco");
  const marca = document.getElementById("marca");

  formProduto.addEventListener("submit", function (e) {
    let valido = true;

    // Limpar bordas anteriores
    [nomeProduto, preco, marca].forEach(el => el.style.borderColor = "");

    if (nomeProduto.value.trim() === "") {
      nomeProduto.style.borderColor = "red";
      valido = false;
    }

    if (marca.value.trim() === "") {
      marca.style.borderColor = "red";
      valido = false;
    }

    const regexPreco = /^\d+([.,]\d{1,2})?\s*€?$/;
    if (!regexPreco.test(preco.value.trim())) {
      preco.style.borderColor = "red";
      alert("Insira um preço válido (ex: 1.49€ ou 2,50)");
      valido = false;
    }

    if (!valido) e.preventDefault();
  });

  // Formulário: Tarefas Diárias
  const formTarefas = document.querySelector('form[action*="atualizar_tarefas.php"]');
  if (formTarefas) {
    formTarefas.addEventListener("submit", function (e) {
      const checkboxes = formTarefas.querySelectorAll('input[type="checkbox"]');
      const algumaMarcada = Array.from(checkboxes).some(cb => cb.checked);
      if (!algumaMarcada) {
        alert("Por favor, selecione pelo menos uma tarefa.");
        e.preventDefault();
      }
    });
  }

  // Adicionar nova tarefa dinamicamente
  window.adicionarTarefa = function () {
    const ul = document.querySelector('form[action*="atualizar_tarefas.php"] ul');
    const novaTarefa = prompt("Digite a nova tarefa:");
    if (novaTarefa && novaTarefa.trim() !== "") {
      const li = document.createElement("li");
      li.style.marginBottom = "0.8rem";

      const checkbox = document.createElement("input");
      checkbox.type = "checkbox";
      checkbox.name = "tarefas[]";
      checkbox.value = novaTarefa.trim();

      li.appendChild(checkbox);
      li.append(" " + novaTarefa.trim());
      ul.appendChild(li);
    }
  };
});
// Fim do script funcionario.js