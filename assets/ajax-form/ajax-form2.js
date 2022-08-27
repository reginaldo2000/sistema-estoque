const ajaxActions = document.querySelectorAll("[ajax-action]")
ajaxActions.forEach(action => {
    action.addEventListener("click", event => {

        const actionParts = action.getAttribute("ajax-action").split(":")
        const method = actionParts[0]
        const route = actionParts[1]
        const ajaxTarget = action.getAttribute("ajax-target");
        const urlRequest = MAIN_URL + route
        let stringJson = '';

        const allParams = document.querySelectorAll("[ajax-param]")
        allParams.forEach(param => {
            let key = param.getAttribute("ajax-param")
            if (key.includes(ajaxTarget.concat(":"))) {
                key = key.replace(ajaxTarget.concat(":"), "")
                let value = param.value
                stringJson += `"${key}":"${value}"`
            }
        })

        let jsonObject = JSON.parse('{' + stringJson + '}')
        ajaxRequest(action, method, urlRequest, jsonObject)
    })

})

const htmlMessageAlert = (selector, message, type) => {
    const alert = document.querySelector(selector);
    alert.removeAttribute("class");
    alert.classList.add("alert", type, "alert-dismissible", "fade", "show");
    alert.children[0].innerHTML = message;
    alert.removeAttribute("hidden");
}

const ajaxRequest = (action, method, urlRequest, jsonObject) => {
    console.log(action)
    $.ajax({
        type: method,
        dataType: "JSON",
        url: urlRequest,
        data: jsonObject,
        success: response => {

            console.log(response)

            if (response.error) {
                htmlMessageAlert(action.getAttribute("ajax-alert"), response.message, response.messageType)
                return
            }
            if (response.message != "") {
                const alert = action.getAttribute("ajax-alert")
                htmlMessageAlert(alert, response.message, response.messageType)
            }
            if (response.render != "") {
                const elementRender = action.getAttribute("ajax-render")
                document.querySelector(elementRender).innerHTML = response.render
            }
        },
        error: erro => {
            console.log(erro)
            if (action.getAttribute("ajax-alert") != null) {
                htmlMessageAlert(action.getAttribute("ajax-alert"), erro.responseText, "alert-danger")
            }

        }
    })
}