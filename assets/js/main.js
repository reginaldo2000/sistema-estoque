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

                    eventEdit();
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

const eventEdit = () => {
    const dataEdit = document.querySelectorAll("[ajax-edit]");
    dataEdit.forEach(edit => {
        edit.addEventListener("click", () => {
            const urlRequest = edit.getAttribute("ajax-action");
            fetch(urlRequest)
                .then(response => {
                    return response.json();
                })
                .then(object => {
                    Object.keys(object).forEach(seletor => {
                        let elemento = document.getElementById(seletor);
                        if (elemento != null) {
                            elemento.value = object[seletor];
                        }

                        const modalEdit = document.querySelector("[ajax-edit]").getAttribute("ajax-edit");
                        $(modalEdit).modal("show");
                    });
                });
        });
    });
};

eventEdit();

const ajaxAlerta = (erro, seletor, message) => {
    const alert = document.querySelector(seletor);
    let nomeClass = erro ? "alert-danger" : "alert-success";
    alert.removeAttribute("class");
    alert.classList.add("alert", nomeClass, "alert-dismissible", "fade", "show");
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

const listAlerts = document.querySelectorAll(".alert .btn-close");
listAlerts.forEach(botao => {
    botao.addEventListener("click", () => {
        botao.parentElement.setAttribute("hidden", true);
    });
})

const modalReset = document.querySelectorAll("[data-bs-toggle='modal']");
modalReset.forEach(modal => {
    modal.addEventListener("click", () => {
        const modalId = modal.getAttribute("data-bs-target");
        const formulario = document.querySelector(`${modalId} form`);
        formulario.reset();
    })
});


/*document.querySelectorAll("[ajax-hidden]").forEach(item => {
    const seletor = item.getAttribute("ajax-hidden");
    if (document.querySelector(seletor).value != "") {
        item.setAttribute("hidden", "true");
    } else {
        item.removeAttribute("hidden");
    }
});*/