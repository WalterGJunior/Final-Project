function ValidarMeusDados(){
    var nome = document.getElementById("nome").value;
    var email = $("#email").val();

    if (nome.trim() == '') {
        alert("Preencher o campo NOME");
        $("#nome").focus();
        return false;
    }
    if (email.trim() == '') {
        alert("Preencher o campo E-MAIL");
        $("#email").focus();
        return false;
    }
}

function ValidarCategoria(){

    if( $("#nomecategoria").val().trim() == ''){
        alert("Preencher o campo NOME DA CATEGORIA");
        $("#nomecategoria").focus();
        return false;
    }
}

function ValidarEmpresa(){

    if( $("#nomeempresa").val().trim() == ''){
        alert("Preencher o campo EMPRESA");
        $("#nomeempresa").focus();
        return false;
    }
}

function ValidarConta(){

    if( $("#banco").val().trim() == ''){
        alert("Preencher o campo BANCO");
        $("#banco").focus();
        return false;
    }
    if( $("#bic").val().trim() == ''){
        alert("Preencher o campo BIC");
        $("#bic").focus();
        return false;
    }
    if( $("#conta").val().trim() == ''){
        alert("Preencher o campo CONTA");
        $("#conta").focus();
        return false;
    }
    if( $("#saldo").val().trim() == ''){
        alert("Preencher o campo SALDO");
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
        alert("Preencher o campo DATA INICIAL");
        $("#dataInicial").focus();
        return false;
    }
    if($("#dataFinal").val().trim() == ""){
        alert("Preencher o campo DATA FINAL");
        $("#dataFinal").focus();
        return false;
    }

}