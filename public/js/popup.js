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

function popupusuario(name, email, endereco, bairro, cidade, uf, cep, fone, celular, centrodistribuicao) {
    $("#Titulomodal").html(name);
    $("#Corpomodal").html("<div class='panel panel-primary'><div class='panel-heading'><strong>Localização</strong></div><div class='panel-body'>Endereço: " + endereco + "<br>Bairro: " + bairro + "<br>Cidade: " + cidade + "<br>UF: " + uf + "<br>CEP: " + cep + "</div></div><div class='panel panel-primary'><div class='panel-heading'><strong>Contatos</strong></div><div class='panel-body'>Fone: " + fone + "<br>Celular: " + celular + "<br>E-mail: " + email + "</div></div><div class='panel panel-default'><div class='panel-heading'><strong>Centro de Distribuição</strong></div><div class='panel-body'>" + centrodistribuicao + "</div></div>");
    $("#salvemsg").modal();
}