import "./bootstrap";

import Inputmask from "inputmask";

import "../scss/app.scss";

import * as bootstrap from "bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    var phoneInput = document.getElementById("phone");

    console.log(phoneInput);

    if (phoneInput != null) {
        Inputmask("(99) 99999-9999").mask(phoneInput);
    }

    var cpfInput = document.getElementById("cpf");
    if (cpfInput != null) {
        Inputmask("999.999.999-99").mask(cpfInput);
    }

    var cepInput = document.getElementById("cep");
    if (cepInput != null) {
        Inputmask("99999-999").mask(cepInput);
    }
});
