window.addEventListener('DOMContentLoaded', () => {

    // Validação registo.html
    const registoForm = document.querySelector('form[action*="registo_utilizador.php"]');
    if (registoForm) {
        registoForm.addEventListener('submit', e => {
            const username = document.getElementById("username");
            const password = document.getElementById("password");
            const confirm = document.getElementById("confirm");

            if (!username.value || !password.value || !confirm.value) {
                alert("Todos os campos são obrigatórios.");
                e.preventDefault();
                return;
            }

            if (password.value !== confirm.value) {
                alert("As palavras-passe não coincidem.");
                confirm.style.border = "2px solid red";
                e.preventDefault();
            }
        });
    }

    // Validação login index.html
    function validarLogin() {
        const user = document.getElementById("username");
        const pass = document.getElementById("password");
        let valido = true;

        if (!user.value.trim()) {
            user.style.border = "2px solid red";
            valido = false;
        } else {
            user.style.border = "";
        }

        if (!pass.value.trim()) {
            pass.style.border = "2px solid red";
            valido = false;
        } else {
            pass.style.border = "";
        }

        if (!valido) {
            alert("⚠️ Preencha todos os campos obrigatórios.");
        }

        return valido;
    }


    // Validação admin.html - configurações
    const configForm = document.querySelector('form[action*="guardar_configuracoes.php"]');
    if (configForm) {
        configForm.addEventListener('submit', e => {
            const siteName = document.getElementById("site-name");
            const email = document.getElementById("contact-email");

            if (!siteName.value || !email.value) {
                alert("Todos os campos são obrigatórios.");
                e.preventDefault();
                return;
            }

            const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!emailPattern.test(email.value)) {
                alert("Email inválido.");
                email.style.border = "2px solid red";
                e.preventDefault();
            }
        });
    }

    // Validação admin.html - impedir submissão sem checkboxes
    const removerForm = document.querySelector('form[action*="gestao_utilizadores.php"]');
    if (removerForm) {
        removerForm.addEventListener('submit', e => {
            const checkboxes = removerForm.querySelectorAll('input[type="checkbox"]:checked');
            if (checkboxes.length === 0) {
                alert("Seleciona pelo menos um utilizador para remover.");
                e.preventDefault();
            }
        });
    }

});
