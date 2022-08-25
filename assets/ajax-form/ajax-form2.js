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
                stringJson += `"${key}":"${value}"`;
            }
        })

        let jsonObject = JSON.parse('{' + stringJson + '}')
        $.ajax({
            type: method,
            dataType: "JSON",
            url: urlRequest,
            data: jsonObject,
            success: function (response) {
                if (response.error) {
                    console.log(response)
                    return
                }
                if (response.message != "") {
                    const alert = action.getAttribute("ajax-alert")
                    htmlMessageAlert(alert, response.message, response.messageType)
                }
                console.log(response)

            }
        })
    })

})

const htmlMessageAlert = (alert, message, type) => {
    const element = document.querySelector(alert)
    element.classList.add(type)
    element.removeAttribute("hidden")
    document.querySelector(alert+" .message").innerHTML = message;
}