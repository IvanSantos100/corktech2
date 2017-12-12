$(document).ready(function() {
    $tipo = $(tipo).val();

    if ($tipo == 1) {
        $(documento).inputmask("999.999.999-99"); //static mask
    }
    if ($tipo == 2) {
        $(documento).inputmask("99.999.999/9999-99"); //static mask
    }
    $(cep).inputmask("99.999-999"); //static mask
    $(fone).inputmask("(99) 9999[9]-9999"); //specifying options
    $(celular).inputmask("(99) 9999[9]-9999"); //specifying options
});