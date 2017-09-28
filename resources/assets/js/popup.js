function popupcliente(Nome, Tipo, Contato) {
    var tipopessoa;
    if (Tipo == 1) {
        tipopessoa = "Fisico";
    } else {
        tipopessoa = "Jurídica";
    }
    $("#Titulomodal").html(Nome);
    $("#Corpomodal").html("Tipo: " + tipopessoa + "<br>Contato: " + Contato);
    $("#salvemsg").modal();
}