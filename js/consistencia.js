function ValidaCampos() {

    if(document.getElementById("nome").value == "" || document.getElementById("nome").value == null || document.getElementById("nome").value.lenght < 3){
        alert("Preencha o Nome!");
        document.getElementById("nome").focus();
        return false;
    }
    if(document.getElementById("descricao").value == "" || document.getElementById("descricao").value == null || document.getElementById("descricao").value.lenght < 3){
        alert("Preencha a Descrição!");
        document.getElementById("descricao").focus();
        return false;
    }
    if(document.getElementById("local").value == "" || document.getElementById("local").value == null || document.getElementById("local").value.lenght < 3){
        alert("Preencha o Local!");
        document.getElementById("local").focus();
        return false;
    }
    if(document.getElementById("participantes").value == "" || document.getElementById("participantes").value == null || document.getElementById("participantes").value.lenght < 3){
        alert("Preencha a Quantidade de Participantes!");
        document.getElementById("participantes").focus();
        return false;
    }

    var data;
    var hora_ini;
    var hora_fim;
    var tipo;

    data = document.getElementById("data").value;
    hora_ini = document.getElementById("hora_ini").value;
    hora_fim = document.getElementById("hora_fim").value;
    tipo = document.cadastro.tipo.value;

    if(parseInt(hora_fim) < parseInt(hora_ini)) {
        alert("Horário final do Evento deve ser maior que o horário inicial!");
        document.getElementById("hora_fim").focus();
        return false;
    }

    if(tipo == "Exclusivo") {
        $.ajax
        ({        
            type: 'POST',
            dataType: 'html',
            url: 'ajax_dashboard.php',
            beforeSend: function () {
                $("#dados").html("Carregando...");
            },
            data: {
                data: data ,
                hora_ini: hora_ini ,
                hora_fim: hora_fim ,
                tipo: tipo
            },
            success: function (msg)
            {
                //console.log(msg);
                if(msg == "OK") {
                    alert ("Já existe um Evento Exclusivo nesta Data/Intervalo de Hora!");
                    return false;
                }else{
                    document.getElementById("cadastro").submit();
                }
            }
        });
    }else{
        document.getElementById("cadastro").submit();
    }
    
}

function ValidaCamposAlterar(id) {

    if(document.getElementById("nome_altera_"+id).value == "" || document.getElementById("nome_altera_"+id).value == null || document.getElementById("nome_altera_"+id).value.lenght < 3){
        alert("Preencha o Nome!");
        document.getElementById("nome_altera_"+id).focus();
        return false;
    }
    if(document.getElementById("descricao_altera_"+id).value == "" || document.getElementById("descricao_altera_"+id).value == null || document.getElementById("descricao_altera_"+id).value.lenght < 3){
        alert("Preencha a Descrição!");
        document.getElementById("descricao_altera_"+id).focus();
        return false;
    }
    if(document.getElementById("local_altera_"+id).value == "" || document.getElementById("local_altera_"+id).value == null || document.getElementById("local_altera_"+id).value.lenght < 3){
        alert("Preencha o Local!");
        document.getElementById("local_altera_"+id).focus();
        return false;
    }
    if(document.getElementById("participantes_altera_"+id).value == "" || document.getElementById("participantes_altera_"+id).value == null || document.getElementById("participantes_altera_"+id).value.lenght < 3){
        alert("Preencha a Quantidade de Participantes!");
        document.getElementById("participantes_altera_"+id).focus();
        return false;
    }

    var data;
    var hora_ini;
    var hora_fim;
    var tipo;

    data = document.getElementById("data_altera_"+id).value;
    hora_ini = document.getElementById("hora_ini_altera_"+id).value;
    hora_fim = document.getElementById("hora_fim_altera_"+id).value;
    tipo = $("input[name='tipo_altera_"+id+"']:checked").val();

    if(parseInt(hora_fim) < parseInt(hora_ini)) {
        alert("Horário final do Evento deve ser maior que o horário inicial!");
        document.getElementById("hora_fim_altera_"+id).focus();
        return false;
    }

    if(tipo == "Exclusivo") {
        $.ajax
        ({        
            type: 'POST',
            dataType: 'html',
            url: 'ajax_dashboard.php',
            beforeSend: function () {
                $("#dados").html("Carregando...");
            },
            data: {
                data: data ,
                hora_ini: hora_ini ,
                hora_fim: hora_fim ,
                tipo: tipo ,
                agenda_id: id ,
                tipo_ajax: "alterar"
            },
            success: function (msg)
            {
                //console.log(msg);
                if(msg == "OK") {
                    alert ("Já existe um Evento Exclusivo nesta Data/Intervalo de Hora!");
                    return false;
                }else{
                    document.getElementById("alterar_"+id).submit();
                }
            }
        });
    }else{
        document.getElementById("alterar_"+id).submit();
    }
    
}