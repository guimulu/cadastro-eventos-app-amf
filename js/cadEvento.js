var cadastrar = true;
$(document).ready(function(e) { 
    $('#modal-evento').modal();
    table = $('#dt-eventos').DataTable({
        "language": {
            "url": "js/datatable-traducao.json"
        },
        "pageLength": 5,
        "lengthMenu": [5, 10, 25]
    });
   // buscarEventos();
    $('#dt-eventos tbody').on('dblclick', 'tr', function () {
        var data = table.row( this ).data();
        carregarDadosEditar(data);
        cadastrar = false;
    } );
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
    var dados = new Object();
    dados.nome =$('#nome').val();
    dados.descricao =$('#descricao').val();
    dados.localizacao =$('#localizacao').val();
    dados.dataInicio =$('#dataInicio').val();
    dados.dataFim =$('#dataFim').val();
    dados.lembrete =$('#lembrete').val();
    dados.ativo = isChecked($('#ativo')) == 0 ? 1 : 0;
    dados.eventoTipo =$('#eventoTipo').val();
    dados.curso =$('#curso').val();
    dados.recorrencia =$('#recorrencia').val();
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'cadastrarEvento';  
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
            alert('Falha ao inserir registro!');
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
    console.log('dados');
    $.ajax({
        url: 'php/controller/EventoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        var data = resultado.dados;
        console.log(data);
        table.clear().draw();
        $.each(data, function(index, data) {     
            //!!!--Here is the main catch------>fnAddData
            $('#dt-eventos').dataTable().fnAddData( [
                data.ID_USUARIO,
                data.NOME,
                data.DESCRICAO,
                data.LOCALIZACAO,
                data.DATA_HORA_INICIO,
                data.DATA_HORA_TERMINO,
                data.LEMBRETE,
                data.EXCLUIDO == 0 ? '<i class="material-icons">check_box</i>' : '<i class="material-icons">check_box_outline_blank</i>',
                data.ID_TIPO_EVENTO,
                data.ID_CURSO,
                data.ID_RECORRENCIA
            ] );      
        });
    });
    $("#dt-eventos_filter > label > input").attr("placeholder", "Pesquisar");    
}

function carregarDadosEditar(data) {
    $('#nome').val(data[0]);
    $('#descricao').val(data[1]);
    $('#localizacao').val(data[2]);
    $('#dataInicio').val(data[3]);
    $('#dataFim').val(data[4]);
    $('#lembrete').val(data[5]);
    $('#ativo').val(data[6]);
    $('#eventoTipo').val(data[7]);
    $('#curso').val(data[8]);
    $('#recorrencia').val(data[9]);
    $('#eventoOrigem').val(data[10]);
    $('#modal-usuario').modal('open');
    M.updateTextFields();
}

function editarEvento() {
    var dados = new Object();
    dados.nome = $('#nome').val();
    dados.email = $('#email').val();
    dados.senha = $('#senha').val();
    dados.usuario = $('#usuario').val();
    dados.excluido = isChecked($('#excluido')) == 0 ? 1 : 0;
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'alterarUsuario';
    console.log(dados);
    $.ajax({
        url: 'php/controller/UsuarioController.php',
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
    console.log(dados);
    $.ajax({
        url: 'php/controller/TipoEventoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        console.log("caacacacacaca");
        if (resultado) {
            $('#tipoEvento').formSelect('dropdownOptions', resultado);          
        } else {
            alert('Problemas ao buscar tipos de evento!');
        } 
    });
}

function listarCursos() {
    var dados = new Object();
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'buscarCursos';
    console.log(dados);
    $.ajax({
        url: 'php/controller/CursoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        console.log("sdasdasdasd");
        if (resultado) {
            $('#curso').formSelect('dropdownOptions', resultado);          
        } else {
            alert('Problemas ao buscar cursos!');
        } 
    });
}

function listarRecorrencias() {
    var dados = new Object();
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'buscarRecorrencias';
    console.log(dados);
    $.ajax({
        url: 'php/controller/EventoController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        console.log("cococococo");
        if (resultado) {
            $('#recorrencia').formSelect('dropdownOptions', resultado);          
        } else {
            alert('Problemas ao buscar recorrências!');
        } 
    });
}
