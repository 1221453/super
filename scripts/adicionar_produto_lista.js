window.addEventListener('DOMContentLoaded', () => {
    const listaCompras = document.getElementById('lista-compras');
    const inputNomeLista = document.getElementById('nome-lista');
    const botaoCriar = document.getElementById('guardar-lista');
    const botaoVerListas = document.getElementById('ver-listas');
    const blocoListas = document.getElementById('bloco-listas');
    const ulEntradas = document.getElementById('lista-entradas');

    if (listaCompras) {
        listaCompras.value = localStorage.getItem('lista') || '';

        listaCompras.addEventListener('input', () => {
            localStorage.setItem('lista', listaCompras.value);
        });
    }

    if (botaoCriar && listaCompras && inputNomeLista) {
        botaoCriar.addEventListener('click', () => {
            const texto = listaCompras.value.trim();
            const nome = inputNomeLista.value.trim() || "Lista sem nome";

            if (texto === "") {
                alert("A lista está vazia. Não foi guardada.");
                return;
            }

            const listasGuardadas = JSON.parse(localStorage.getItem('listasGuardadas') || '[]');
            const novaEntrada = {
                nome: nome,
                data: new Date().toLocaleString(),
                conteudo: texto
            };

            listasGuardadas.push(novaEntrada);
            localStorage.setItem('listasGuardadas', JSON.stringify(listasGuardadas));

            alert(`Lista "${nome}" guardada com sucesso!`);
            inputNomeLista.value = "";
        });
    }

    if (botaoVerListas && blocoListas && ulEntradas) {
        botaoVerListas.addEventListener('click', () => {
            const listasGuardadas = JSON.parse(localStorage.getItem('listasGuardadas') || '[]');
            ulEntradas.innerHTML = "";

            if (listasGuardadas.length === 0) {
                ulEntradas.innerHTML = "<li>Não existem listas guardadas.</li>";
            } else {
                listasGuardadas.forEach((entrada) => {
                    const li = document.createElement('li');
                    li.innerHTML = `<strong>${entrada.nome}</strong> <em>(${entrada.data})</em><br><pre>${entrada.conteudo}</pre>`;
                    ulEntradas.appendChild(li);
                });
            }

            blocoListas.style.display = 'block';
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
  const listaCompras = document.getElementById('lista-compras');
  if (listaCompras) {
    listaCompras.value = localStorage.getItem('lista') || '';

    listaCompras.addEventListener('input', () => {
      localStorage.setItem('lista', listaCompras.value);
    });
  }
});

const despensa = document.getElementById('despensa');
if (despensa) {
  despensa.value = localStorage.getItem('despensa') || '';

  despensa.addEventListener('input', () => {
    localStorage.setItem('despensa', despensa.value);
  });
}