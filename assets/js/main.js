const listaFormularios = document.querySelectorAll(".form-ajax");

listaFormularios.forEach(formulario => {
    formulario.addEventListener("submit", event => {
        event.preventDefault();
        event.stopPropagation();

        const formData = new FormData(formulario);

        if (formulario.checkValidity()) {
            ajaxAbrirModalLoading();
            const URL_REQUEST = formulario.getAttribute("action");
            fetch(URL_REQUEST, {
                body: formData,
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            }).then(response => {
                return response.json();
            }).then(dados => {
                ajaxFecharModalLoading(600);
                console.log(dados);
            }).catch(erro => {
                ajaxFecharModalLoading(1800);
                console.log(erro.message);
            });
        }
    }, false);
});

const ajaxAbrirModalLoading = () => {
    const body = document.querySelector("body");
    body.innerHTML += MODAL_LOADING;
};

const ajaxFecharModalLoading = timeSleep => {
    setTimeout(() => {
        const elemento = document.querySelector("#ajaxFormLoading");
        elemento.remove();
    }, timeSleep);
};

(() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()

const MODAL_LOADING = `
<div id="ajaxFormLoading">
    <div class="ajax-form-fundo-loading"></div>
    <div class="ajax-form-fundo-modal">
        <div class="ajax-form-loading"></div>
    </div>
</div>
`;
