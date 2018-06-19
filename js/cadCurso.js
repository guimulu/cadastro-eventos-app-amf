var cadastrar = true;
$(document).ready(function(e) { 
    $('#modal-cursos').modal();
    table = $('#dt-cursos').DataTable({
        "language": {
            "url": "js/datatable-traducao.json"
        },
        "pageLength": 5,
        "lengthMenu": [5, 10, 25]
    });
    buscarCursos();
    $('#dt-cursos tbody').on('dblclick', 'tr', function () {
        var data = table.row( this ).data();
        carregarDadosEditar(data);
        cadastrar = false;
    } );

});

function novo() {
    $('#modal-cursos').modal('open');
    limparCamposCurso();
    cadastrar = true;
}

function carregarDadosEditar(data) {
    $('#curso').val(data[0]);
    $('#nome').val(data[1]);
    $('#excluido').prop('checked', data[2].indexOf("box_outline") > -1 ? false : true);
    $('#modal-cursos').modal('open');
    M.updateTextFields();
}
/** 
 * Método de login do usuário.
 * @author Guilherme Müller
 */
function cadastrarCurso(){
    var dados = new FormData();
    dados.append("nome", $('#nome').val());
    dados.append("logo", $('#logo')[0].files[0]);
    dados.append("excluido", isChecked($('#excluido')) == 0 ? 1 : 0);
    dados.append("sessao", $.session.get('session_login'));
    dados.append("operacao", "cadastrarCurso"); 
    console.log(dados); 
    $.ajax({
        url: 'php/controller/CursoController.php',
        data: dados,
        contentType: false,
        processData: false,
        cache: false,
        type: "POST",
        //dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (resultado) {
            limparCamposCurso();
            buscarCursos();
        } else {
            mensagemErro(resultado.erro);
        } 
    });
}

/** 
 * Método de login do usuário.
 * @author Guilherme Müller
 */
function editarCurso(){
    var dados = new FormData();
    dados.append("curso", $('#curso').val());
    dados.append("nome", $('#nome').val());
    dados.append("logo", $('#logo')[0].files[0]);
    dados.append("excluido", isChecked($('#excluido')) == 0 ? 1 : 0);
    dados.append("sessao", $.session.get('session_login'));
    dados.append("operacao", "alterarCurso"); 
    console.log(dados); 
    $.ajax({
        url: 'php/controller/CursoController.php',
        data: dados,
        contentType: false,
        processData: false,
        cache: false,
        type: "POST",
        //dataType: 'json',
        async: false
    }).done(function(resultado) {
        if (resultado) {
            limparCamposCurso();
            buscarCursos();
        } else {
            mensagemErro(resultado.erro);
        } 
    });
}

function buscarCursos(){
    var dados = new FormData()
    dados.append("sessao", $.session.get('session_login'));
    dados.append("operacao", "buscarCursos"); 
    console.log(dados); 

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
        if (resultado.dados) {
            console.log(resultado.dados);
            var data = resultado.dados;    
            table.clear().draw();
            $.each(data, function(index, data) {     
                $('#dt-cursos').dataTable().fnAddData( [
                    data.ID,
                    data.NOME,
                    data.EXCLUIDO == 0 ? '<i class="material-icons">check_box</i>' : '<i class="material-icons">check_box_outline_blank</i>'
                ] );      
            });
        } else {
            mensagemInfo(resultado.erro);
        }
    });
}

function limparCamposCurso(){
    $("#nome").val("");
    $("#logo").val("");
    $("#curso").val("");

}

function salvar() {
    if (cadastrar) {
        cadastrarCurso();
    } else {
        editarCurso();
    }
}