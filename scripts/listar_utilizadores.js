document.addEventListener('DOMContentLoaded', () => {
    fetch('scripts/lista_utilizadores.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#listar_utilizadores tbody');
            tbody.innerHTML = '';

            data.forEach(utilizador => {
                const row = document.createElement('tr');
                row.innerHTML = `
          <td><input type="checkbox" name="remover[]" value="${utilizador.id}"></td>
          <td>${utilizador.id}</td>
          <td>${utilizador.nome}</td>
          <td>${utilizador.email}</td>
          <td>${utilizador.tipo}</td>
          <td><a href="#" class="btn">Editar</a></td>
        `;
                tbody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Erro ao carregar utilizadores:', error);
        });
});
