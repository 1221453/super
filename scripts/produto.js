function toggleSecao(id) {
  const secao = document.getElementById(id);
  if (secao) {
    secao.style.display = (secao.style.display === "none") ? "block" : "none";
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const produto = {
    nome: "Arroz Integral",
    quantidade: "4 kg",
    preco: "1,49€/kg"
  };

  const btnLista = document.querySelector('button[value="lista"]');
  if (btnLista) {
    btnLista.type = "button";
    btnLista.addEventListener("click", () => {
      const nome = produto.nome;
      let lista = localStorage.getItem("lista") || "";

      const linhas = lista.split("\n").map(l => l.trim()).filter(l => l);
      if (linhas.includes(nome)) {
        alert(`"${nome}" já está na Lista de Compras.`);
        return;
      }

      lista += `${nome}\n`;
      localStorage.setItem("lista", lista);
      alert(`"${nome}" foi adicionado à Lista de Compras.`);
    });
  }


  const btnDespensa = document.querySelector('button[value="despensa"]');
  if (btnDespensa) {
    btnDespensa.type = "button";
    btnDespensa.addEventListener("click", () => {
      const nome = produto.nome;
      let despensa = localStorage.getItem("despensa") || "";

      const linhas = despensa.split("\n").map(l => l.trim()).filter(l => l);
      if (linhas.includes(nome)) {
        alert(`"${nome}" já está na Despensa.`);
        return;
      }

      despensa += `${nome}\n`;
      localStorage.setItem("despensa", despensa);
      alert(`"${nome}" foi adicionado à Despensa.`);
    });
  }

  const btnCarrinho = document.querySelector('button[value="carrinho"]');
  if (btnCarrinho) {
    btnCarrinho.type = "button";
    btnCarrinho.addEventListener("click", () => {
      alert("Funcionalidade de carrinho ainda não implementada.");
    });
  }
});