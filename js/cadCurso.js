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
    $('#dt-usuarios tbody').on('dblclick', 'tr', function () {
        var data = table.row( this ).data();
        //carregarDadosEditar(data);
        cadastrar = false;
    } );

});

function carregarDadosEditar(data) {
    $('#usuario').val(data[0]);
    $('#nome').val(data[1]);
    $('#email').val(data[2]);
    $('#excluido').prop('checked', data[2].indexOf("box_outline") > -1 ? true : false);
    $('#modal-usuario').modal('open');
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
        console.log(resultado);
        if (resultado.status) {
            limparCamposCurso();
        } else {
            console.log('deu pau');
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
        //dataType: 'json',
        async: false
    }).done(function(resultado){
        console.log(resultado);
        if (resultado.status) {
            console.log(resultado);
            var data = resultado.dados;    
            table.clear().draw();
            $.each(data, function(index, data) {     
                $('#dt-cursos').dataTable().fnAddData( [
                    data.ID_CURSO,
                    data.NOME,
                    data.EMAIL,
                    data.EXCLUIDO == 0 ? '<i class="material-icons">check_box</i>' : '<i class="material-icons">check_box_outline_blank</i>'
                ] );      
            });
        } else {
            mensagemInfo("Nenhum registro encontrado");
        }
    });
}

function limparCamposCurso(){
    $("#nome").val("");
    $("#logo").val("");
}