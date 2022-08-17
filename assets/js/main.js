(() => {
    'use strict'
    const forms = document.querySelectorAll('.form-ajax');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            event.stopPropagation();
            event.preventDefault();
            form.classList.add('was-validated');

            if (form.checkValidity()) {

                ajaxAbrirModalLoading();

                const URL_REQUEST = form.getAttribute("action");

                const formData = new URLSearchParams(new FormData(form));

                fetch(URL_REQUEST, {
                    body: formData,
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    }
                }).then(response => {
                    return response.json();
                }).then(dados => {

                    const ajaxRender = form.getAttribute("ajax-render");
                    const ajaxCloseModal = form.getAttribute("ajax-close-modal");
                    const ajaxResetForm = form.getAttribute("ajax-reset-form");
                    const ajaxAlert = form.getAttribute("ajax-alert");

                    if (ajaxCloseModal) {
                        $("#modalSalvarUsuario").modal("hide");
                    }

                    if (ajaxResetForm) {
                        form.reset();
                        form.classList.remove("was-validated");
                    }

                    if (dados.render != "") {
                        document.querySelector(ajaxRender).innerHTML = dados.render;
                    }

                    if (dados.message != "") {
                        ajaxAlerta(dados.erro, ajaxAlert, dados.message);
                    }

                    ajaxFecharModalLoading(600);
                    console.log(dados);
                }).catch(erro => {
                    ajaxFecharModalLoading(3000);
                    console.log("erro");
                    console.log(erro);
                });
            }
        }, false)
    })
})()

const ajaxAlerta = (erro, seletor, message) => {
    const alert = document.querySelector(seletor);
    let nomeClass = erro ? "alert-danger" : "alert-success";
    alert.removeAttribute("class");
    alert.classList.add(nomeClass, "alert", "fade", "show");
    alert.children[0].innerHTML = message;
    alert.removeAttribute("hidden");
};

const ajaxAbrirModalLoading = () => {
    document.getElementById("ajaxFormLoading").removeAttribute("hidden");
};

const ajaxFecharModalLoading = timeSleep => {
    setTimeout(() => {
        document.getElementById("ajaxFormLoading").setAttribute("hidden", true);
    }, timeSleep);
};

document.querySelector(".alert button").addEventListener("click", () => {
    $(this).parent().addClass("hidden");
});