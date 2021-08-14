function ValidarMeusDados(){
    var nome = document.getElementById("nome").value;
    var email = $("#email").val();

    if (nome.trim() == '') {
        alert("Please, You have to inform the USER NAME");
        $("#nome").focus();
        return false;
    }
    if (email.trim() == '') {
        alert("Please, You have to inform the E-MAIL");
        $("#email").focus();
        return false;
    }
}

function ValidarCategoria(){

    if( $("#nomecategoria").val().trim() == ''){
        alert("Please, You have to inform the CATEGORY NAME");
        $("#nomecategoria").focus();
        return false;
    }
}

function ValidarEmpresa(){

    if( $("#nomeempresa").val().trim() == ''){
        alert("Please, You have to inform the COMPANY NAME");
        $("#nomeempresa").focus();
        return false;
    }
}

function ValidarConta(){

    if( $("#banco").val().trim() == ''){
        alert("Please, You have to inform the BANK NAME");
        $("#banco").focus();
        return false;
    }
    if( $("#bic").val().trim() == ''){
        alert("Please, You have to inform the BIC number");
        $("#bic").focus();
        return false;
    }
    if( $("#conta").val().trim() == ''){
        alert("Please, You have to inform the ACCOUNT NUMBER");
        $("#conta").focus();
        return false;
    }
    if( $("#saldo").val().trim() == ''){
        alert("Please, You have to inform the AVAILABLE FUNDS");
        $("#saldo").focus();
        return false;
    }
}

function ValidarMovimento(){

    if( $("#tipo").val().trim() == ''){
        alert("Preencher o campo TIPO");
        $("#Tipo").focus();
        return false;
    }
    if( $("#categoria").val().trim() == ''){
        alert("Preencher o campo CATEGORIA");
        $("#categoria").focus();
        return false;
    }
    if( $("#data").val().trim() == ''){
        alert("Preencher o campo DATA");
        $("#data").focus();
        return false;
    }
    if( $("#empresa").val().trim() == ''){
        alert("Preencher o campo EMPRESA");
        $("#empresa").focus();
        return false;
    }
    if( $("#valor").val().trim() == ''){
        alert("Preencher o campo VALOR");
        $("#valor").focus();
        return false;
    }
    if( $("#conta").val().trim() == ''){
        alert("Preencher o campo CONTA");
        $("#conta").focus();
        return false;
    }
}

function ValidarConsultarMovimento(){
    if($("#dataInicial").val().trim() == ""){
        alert("REQUIRED: The initial Date is missing");
        $("#dataInicial").focus();
        return false;
    }
    if($("#dataFinal").val().trim() == ""){
        alert("REQUIRED: The final Date is missing");
        $("#dataFinal").focus();
        return false;
    }

}