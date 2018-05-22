$(document).ready(function(e) { 
    var cadastrar = true;
    $('#modal-usuario').modal();
    table = $('#dt-usuarios').DataTable({
        "language": {
            "url": "js/datatable-traducao.json"
        },
        "pageLength": 5,
        "lengthMenu": [5, 10, 25]
    });
    buscarUsuarios();
    $('#dt-usuarios tbody').on('dblclick', 'tr', function () {
        var data = table.row( this ).data();
        carregarDadosEditar(data);
        cadastrar = false;
        console.log(cadastrar);
    } );
    
});

function novo() {
    $('#modal-usuario').modal('open'); 
    limparCamposUsuario();
    cadastrar = true;
}

/** 
 * Método de login do usuário.
 * @author Guilherme Müller
 */
function cadastrarUsuario(){
    var dados = new Object();
    dados.nome = $('#nome').val();
    dados.email = $('#email').val();
    dados.senha = $('#senha').val();
    dados.excluido = isChecked($('#excluido')) == 0 ? 1 : 0;
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'cadastrarUsuario';  
    $.ajax({
        url: 'php/controller/usuarioController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        console.log(resultado);
        if (resultado.status) {
            limparCamposUsuario();
            buscarUsuarios();
        } else {
            console.log('deu pau');
        } 
    });
}

/** 
 * Método de login do usuário.
 * @author Guilherme Müller
 */
function buscarUsuarios(){
    var dados = new Object();
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'buscarUsuarios';  
    $.ajax({
        url: 'php/controller/usuarioController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        var data = resultado.dados;    
        console.log(data);
        table.clear().draw();
        $.each(data, function(index, data) {     
            //!!!--Here is the main catch------>fnAddData
            $('#dt-usuarios').dataTable().fnAddData( [
                data.ID_USUARIO,
                data.NOME,
                data.EMAIL,
                data.EXCLUIDO == 0 ? '<i class="material-icons">check_box</i>' : '<i class="material-icons">check_box_outline_blank</i>'
            ] );      
        });
    });
    $("#dt-usuarios_filter > label > input").attr("placeholder", "Pesquisar");    
}

function carregarDadosEditar(data) {
    console.log(data);
    $('#nome').val(data[1]);
    $('#email').val(data[2]);
    $('#senha').val(data[2]);
    $('#excluido').prop('checked', data[3].indexOf("box_outline") > -1 ? true : false);
    $('#modal-usuario').modal('open');
    M.updateTextFields();
}

function editarUsuario() {
    var dados = new Object();
    dados.nome = $('#nome').val();
    dados.email = $('#email').val();
    dados.senha = $('#senha').val();
    dados.excluido = isChecked($('#excluido')) == 0 ? 1 : 0;
    dados.sessao = $.session.get('session_login');
    dados.operacao = 'alterarUsuario';  
    $.ajax({
        url: 'php/controller/usuarioController.php',
        data: dados,
        dataType: 'json',
        async: false
    }).done(function(resultado) {
        console.log(resultado);
        if (resultado.status) {
            limparCamposUsuario();
            buscarUsuarios();
        } else {
            console.log('deu pau');
        } 
    });
}

function limparCamposUsuario(){
    $('#nome').val('');
    $('#email').val('');
    $('#senha').val('');
}

function salvar() {
    if (validEmail($('#email').val())) {
        if (cadastrar) {
            console.log("cadastrar " + cadastrar);
            cadastrarUsuario();
        } else {
            editarUsuario();
            console.log("cadastrar" + cadastrar);
        }
    } else {
        alert('E-mail Inválido!');
    }
}

function validEmail(email){
    return /^[\w+.]+@\w+\.\w{2,}(?:\.\w{2})?$/.test(email)
}