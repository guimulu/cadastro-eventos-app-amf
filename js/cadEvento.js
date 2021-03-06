var cadastrar = true;
$(document).ready(function(e) { 
    $('#modal-evento').modal();
    $('#modal-tipo-evento').modal();
    table = $('#dt-eventos').DataTable({
        "language": {
            "url": "js/datatable-traducao.json"
        },
        "pageLength": 5,
        "lengthMenu": [5, 10, 25]
    });
    buscarEventos();
    $('#dt-eventos tbody').on('dblclick', 'tr', function () {
        var data = table.row( this ).data();
        carregarDadosEditar(data);
        cadastrar = false;
    } );
    $('#dataInicio').mask('00/00/0000 00:00:00');
    $('#dataFim').mask('00/00/0000 00:00:00');
    $('#curso').formSelect();
    $('#eventoTipo').formSelect();
    $('#recorrencia').formSelect();
    listarCursos();
    listarRecorrencias();
    listarTipoEventos();
});

function novo() {
    $('#modal-evento').modal('open'); 
    limparCamposEvento();
    cadastrar = true;
}

/** 
 * Método de login do usuário.
 * @author Guilherme Müller
 */
function cadastrarEvento(){
    if (!validaData()) {
        mensagemErro("Data inválida!");
    }
    var dados = new Object();
    dados.nome =$('#nome').val();
    dados.descricao =$('#descricao').val();
    dados.localizacao = $('#localizacao').val();
    dados.dataInicio = moment($('#dataInicio').val(), "DD/MM/YYYY hh:mm:ss" ).format('YYYY-MM-DD hh:mm:ss');
    dados.dataFim = moment($('#dataFim').val(), "DD/MM/YYYY hh:mm:ss" ).format('YYYY-MM-DD hh:mm:ss');
    dados.lembrete =$('#lembrete').val();
    dados.ativo = isChecked($('#ativo')) == 0 ? 1 : 0;
    dados.eventoTipo =$('#eventoTipo').val();
    dados.curso =$('#curso').val();
    dados.recorrencia =$('#recorrencia').val();
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'cadastrarEvento';
    console.log(dados);
    $.ajax({
        url: 'php/controller/EventoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (resultado.status) {
            limparCamposEvento();
            buscarEventos();
        } else {
            mensagemErro(resultado.erro);
        } 
    });
}

/** 
 * Método de login do usuário.
 * @author Guilherme Müller
 */
function buscarEventos(){
    var dados = new Object();
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'buscarEventos'; 
    $.ajax({
        url: 'php/controller/EventoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (!resultado.erro) {
            var data = resultado.dados;
            table.clear().draw();
            $.each(data, function(index, data) {     
                $('#dt-eventos').dataTable().fnAddData( [
                    data.ID_EVENTO,
                    data.NOME,
                    data.DESCRICAO,
                    data.LOCALIZACAO,
                    moment(data.DATA_HORA_INICIO).format('DD/MM/YYYY hh:mm:ss'),
                    moment(data.DATA_HORA_TERMINO).format('DD/MM/YYYY hh:mm:ss'),
                    data.LEMBRETE,
                    data.EXCLUIDO == 0 ? '<i class="material-icons">check_box</i>' : '<i class="material-icons">check_box_outline_blank</i>',
                    data.NOMEEVENTOTIPO,
                    data.NOMECURSO,
                    data.NOMERECORRENCIA
                ] );      
            });
        } else {
            mensagemErro(resultado.erro);
        }
    });
}

function carregarDadosEditar(data) {
    $('#evento').val(data[0]);
    $('#nome').val(data[1]);
    $('#descricao').val(data[2]);
    $('#localizacao').val(data[3]);
    $('#dataInicio').val(data[4]);
    $('#dataFim').val(data[5]);
    $('#lembrete').val(data[6]);
    $('#ativo').val(data[7]);
    $('#eventoTipo').val(data[8]);
    $('#curso').val(data[9]);
    $('#recorrencia').val(data[10]);
    $('#eventoOrigem').val(data[11]);
    $('#modal-evento').modal('open');
    M.updateTextFields();
}

function editarEvento() {

    var dados = new Object();
    dados.evento = $('#evento').val();
    dados.nome = $('#nome').val();
    dados.descricao = $('#descricao').val();
    dados.localizacao = $('#localizacao').val();
    dados.dataInicio = moment($('#dataInicio').val(), "DD/MM/YYYY hh:mm:ss" ).format('YYYY-MM-DD hh:mm:ss');
    dados.dataFim = moment($('#dataFim').val(), "DD/MM/YYYY hh:mm:ss" ).format('YYYY-MM-DD hh:mm:ss');
    dados.lembrete = $('#lembrete').val();
    dados.ativo = isChecked($('#ativo')) == 0 ? 1 : 0;
    dados.eventoTipo = $('#eventoTipo').val();
    dados.curso = $('#curso').val();
    dados.recorrencia = $('#recorrencia').val();
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'alterarEvento';
    console.log(dados);
    $.ajax({
        url: 'php/controller/EventoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (resultado.status) {
            limparCamposEvento();
            buscarEventos();
        } else {
            alert('Problemas ao editar registro!');
        } 
    });
}

function limparCamposEvento(){
    $('#nome').val('');
    $('#descricao').val('');
    $('#localizacao').val('');
    $('#dataInicio').val('');
    $('#dataFim').val('');
    $('#lembrete').val('');
    $('#ativo').val('');
    $('#eventoTipo').val('');
    $('#curso').val('');
    $('#recorrencia').val('');
}

function preencherSelects() {
    
}

function salvar() {
    if (cadastrar) {
        cadastrarEvento();
    } else {
        editarEvento();
    }
}

function listarTipoEventos() {
    var dados = new Object();
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'buscarTiposEventos';
    
    $.ajax({
        url: 'php/controller/TipoEventoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (!resultado.erro) {
            inserirOptionSelect($('#eventoTipo'), resultado.dados);        
        } else {
            mensagemErro(resultado.erro);
        } 
    });
}

function listarCursos() {
    var dados = new FormData()
    dados.append("sessao", $.session.get('session_login'));
    dados.append("operacao", "buscarCursos");
    
    $.ajax({
        url: 'php/controller/CursoController.php',
        data: dados,
        contentType: false,
        processData: false,
        cache: false,
        type: "POST",
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (!resultado.erro) {
            inserirOptionSelect($('#curso'), resultado.dados);    
        } else {
            mensagemErro(resultado.erro);
        } 
    });
}

function listarRecorrencias() {
    var dados = new Object();
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'buscarRecorrencias';
    
    $.ajax({
        url: 'php/controller/EventoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (!resultado.erro) {
            inserirOptionSelect($('#recorrencia'), resultado.dados);         
        } else {
            mensagemErro(resultado.erro);
        } 
    });
}


function inserirOptionSelect(elemento, objeto) {
    $.each(objeto, function(index, val) {
        var $newOpt = $("<option>").attr("value",val.ID).text(val.NOME);
        elemento.append($newOpt);
    });
    elemento.formSelect();
}

function novoTipoEvento() {
    $('#modal-tipo-evento').modal('open'); 
}

function validaData() {
    return moment($('#dataInicio').val(),"DD/MM/YYYY HH:mm:ss").isValid() 
    && moment($('#dataFim').val(),"DD/MM/YYYY HH:mm:ss").isValid() 
    && $('#dataInicio').val() < $('#dataFim').val();    
}