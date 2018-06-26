var cadastrar = true;
$(document).ready(function(e) { 
    $('#modal-tipo-evento').modal();
    table = $('#dt-tipo-eventos').DataTable({
        "language": {
            "url": "js/datatable-traducao.json"
        },
        "pageLength": 5,
        "lengthMenu": [5, 10, 25]
    });
    buscarTipoEvento();
    $('#dt-tipo-eventos tbody').on('dblclick', 'tr', function () {
        var data = table.row( this ).data();
        carregarDadosEditar(data);
        cadastrar = false;
    } );

});

function novo() {
    $('#modal-tipo-evento').modal('open');
    limparCamposTipoEvento();
    cadastrar = true;
}

function carregarDadosEditar(data) {
    $('#eventoTipo').val(data[0]);
    $('#nome').val(data[1]);
    $('#cor').val(data[2].substring(41,48));
    $('#excluido').prop('checked', data[3].indexOf("box_outline") > -1 ? false : true);
    $('#modal-tipo-evento').modal('open');
    M.updateTextFields();
}
/** 
 * Método de login do usuário.
 * @author Guilherme Müller
 */
function cadastrarTipoEvento(){
    var dados = new Object();
    dados.nome = $('#nome').val();
    dados.cor = hexParaDec($('#cor').val());
    dados.excluido = isChecked($('#excluido')) == 0 ? 1 : 0;
    dados.sessao = $.session.get('session_login');
    dados.operacao = "cadastrarTipoEvento"; 
    
    $.ajax({
        url: 'php/controller/TipoEventoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (!resultado.erro) {
            limparCamposTipoEvento();
            buscarTipoEvento();
        } else {
            mensagemErro(resultado.erro);
        } 
    });
}

/** 
 * Método de login do usuário.
 * @author Guilherme Müller
 */
function editarTipoEvento(){
    var dados = new Object();
    dados.eventoTipo = +$('#eventoTipo').val();
    dados.nome = $('#nome').val();
    dados.cor = hexParaDec($('#cor').val());
    dados.excluido = isChecked($('#excluido')) == 0 ? 1 : 0;
    dados.sessao = $.session.get('session_login');
    dados.operacao = "alterarTipoEvento"; 
    
    $.ajax({
        url: 'php/controller/TipoEventoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (!resultado) {
            limparCamposTipoEvento();
            buscarTipoEvento();
        } else {
            mensagemErro(resultado.erro);
        } 
    });
}

function buscarTipoEvento(){
    var dados = new Object()
    dados.sessao = $.session.get('session_login');
    dados.operacao = "buscarTiposEventos";

    $.ajax({
        url: 'php/controller/TipoEventoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (resultado.dados) {
            var data = resultado.dados;    
            table.clear().draw();
            $.each(data, function(index, data) {     
                $('#dt-tipo-eventos').dataTable().fnAddData( [
                    data.ID,
                    data.NOME,
                    '<div class="cor" style="background-color:'+decParaHex(data.COR)+'"></div>',
                    data.EXCLUIDO == 0 ? '<i class="material-icons">check_box</i>' : '<i class="material-icons">check_box_outline_blank</i>'
                ] );      
            });
        } else {
            mensagemInfo(resultado.erro);
        }
    });
}

function limparCamposTipoEvento(){
    $("#nome").val("");
    $("#cor").val("");
    $("#curso").val("");

}

function salvar() {
    if (cadastrar) {
        cadastrarTipoEvento();
    } else {
        editarTipoEvento();
    }
}

function hexParaDec(rrggbb) {
    rrggbb = rrggbb.substr(1, 6);
    var bbggrr = rrggbb.substr(4, 2) + rrggbb.substr(2, 2) + rrggbb.substr(0, 2);
    return parseInt(bbggrr, 16);
}

function decParaHex(i) {
    var bbggrr =  ("000000" + i.toString(16)).slice(-6);
    var rrggbb = bbggrr.substr(4, 2) + bbggrr.substr(2, 2) + bbggrr.substr(0, 2);
    return '#' + rrggbb;
}