const MAIN_URL = "http://localhost/sistema-estoque";

const formataMoeda = element => {
    let valor = element.value.replaceAll(".", "");
    valor = valor.replace(",", "");

    let arrayValores = parseFloat(valor / 100).toFixed(2).toString().split(".");
    if (arrayValores[0].length > 6) {
        element.value = "0,00";
    } else if (arrayValores[0].length > 3) {
        element.value = (arrayValores[0] / 1000).toFixed(3) + "," + arrayValores[1];
    } else {
        element.value = arrayValores[0] + "," + arrayValores[1];
    }
}

const htmlMessageAlert = (selector, message, type) => {
    const alert = document.querySelector(selector);
    alert.removeAttribute("class");
    alert.classList.add("alert", type, "alert-dismissible", "fade", "show");
    alert.children[0].innerHTML = message;
    alert.removeAttribute("hidden");
}