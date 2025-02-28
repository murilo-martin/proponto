const modal_add = new bootstrap.Modal("#modal_add")
const modal_del = new bootstrap.Modal("#modal_del")
const modal_edit = new bootstrap.Modal("#modal_edit")

const toastSuccess = new bootstrap.Toast(document.querySelector('#toastSuccess'));

const toastDanger = new bootstrap.Toast(document.querySelector('#toastDanger'));

const toastCancel = new bootstrap.Toast(document.querySelector('#toastDel'));

const toastEdit = new bootstrap.Toast(document.querySelector('#toastEdit'));

const toastExist = new bootstrap.Toast(document.querySelector('#toastExist'));


const forms = document.querySelectorAll('.needs-validation');

document.addEventListener("DOMContentLoaded", showTable("searchbar"))

Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
    }

    form.classList.add('was-validated')
}, false)});

function clear_form_add(){

    document.getElementById("nome").value = "";
    document.getElementById("email").value = "";
    document.getElementById("tel").value = "";
    document.getElementById('form_add').classList.remove('was-validated');

}

function clear_form_del(){

    document.getElementById("nome").value = "";
    document.getElementById("email").value = "";
    document.getElementById("tel").value = "";

}
function clear_form_edit(){

    document.getElementById("nome").value = "";
    document.getElementById("email").value = "";
    document.getElementById("tel").value = "";

}

function showTable(search){

    let filterColumn = document.getElementById('column').value;
    let searchBar = document.getElementById(search).value;

    if(filterColumn == "telefone"){

        document.getElementById(search).value = searchBar.replace(/\D/g,"");

    }else if(filterColumn == "name"){
        
        document.getElementById(search).value = searchBar.replace(/\d/g,"");

    }
    
    searchBar = document.getElementById(search).value;
    
    $.ajax({

        url: "utilities/showTable.php",
        method: "POST",
        data: {
            search: searchBar,
            column: filterColumn
        },
        
    })
    .done(function (data){

        $("#table").html(data);
        
    })

}
function showModalDelEdit(id, acao){

    console.log(acao)

    acao === "Cancel" ? modal_del.show(): modal_edit.show();

    $.ajax({

        // Chama o arquivo que pega as informações
        url: "utilities/puxarInfo_usuario.php",
        // Define o method
        method: "post",
        // Valores de "input"
        data:{

            id: id,
            acao: acao

        },

    })
    .done(function (data){

        $("#modal"+ acao +"_body").html(data);

    })


}

document.getElementById('form_del').addEventListener('submit', event => {
   
    event.preventDefault();

    let id = document.getElementById('id_usuarioCancel').value;

    console.log(id);

        $.ajax({
            url: "utilities/deletarUsuario.php",
            method: "post",
            data: {
                id: id
            }  
        })
        .done(function(){
            showTable('searchbar');
            clear_form_del();
            modal_del.hide();
            toastCancel.show();
        })

});

function clear_form_add(clear_permissions){

    clear_permissions.name = clear_permissions.name || clear_permissions.all
    clear_permissions.email = clear_permissions.email || clear_permissions.all
    clear_permissions.tel = clear_permissions.tel || clear_permissions.all
    clear_permissions.validated = clear_permissions.validated || clear_permissions.all

    clear_permissions.name ? document.getElementById("nome").value = "" : "";
    clear_permissions.email ? document.getElementById("email").value = "" : "";
    clear_permissions.tel ? document.getElementById("tel").value = "" : "";
    clear_permissions.validated ? document.getElementById('form_add').classList.remove('was-validated') : "";

}


document.getElementById('form_edit').addEventListener('submit', event => {
   
    event.preventDefault();

    let nome = document.getElementById('nome_Edit').value;
    let email = document.getElementById('email_Edit').value;
    let tel = document.getElementById('tel_Edit').value;
    let id = document.getElementById('id_usuarioEdit').value;

    if(nome.length > 0 && email.length > 0 && tel.length > 0){

        $.ajax({
            url: "utilities/editarUsuario.php",
            method: "post",
            data: {
                nome: nome,
                email: email,
                telefone: tel,
                id: id
            }  
        })
        .done(function(){
            showTable('searchbar');
            clear_form_edit();
            modal_edit.hide();
            toastEdit.show();
        
        })
    }

});

document.getElementById('form_add').addEventListener('submit', event => {
   
    event.preventDefault();

    let nome = document.getElementById('nome').value;
    let email = document.getElementById('email').value;
    let tel = document.getElementById('tel').value;

    if(nome.length > 0 && email.length > 0 && tel.length > 0){
        
        $.ajax({
            url: "utilities/novo_usuario.php",
            method: "post",
            data: {
                nome: nome,
                email: email,
                telefone: tel
            }  
        })
        .done(function(data){

            if(!data.includes("success")){
                
                console.log(data)
                clear_form_add({
                    name: data.includes("nome cadastrado"),
                    email: data.includes("email cadastrado"),
                    tel: data.includes("telefone cadastrado"),
                })
                toastExist.show();
            
            }else if(data.includes("success")){
                showTable('searchbar');
                clear_form_add(
                    {all: true}
                );
                modal_add.hide();
                toastSuccess.show();
            }
        })

    }else{

        toastDanger.show();

    }
});

