const modal_add = new bootstrap.Modal("#modal_add")
const modal_del = new bootstrap.Modal("#modal_del")
const modal_edit = new bootstrap.Modal("#modal_edit")
const forms = document.querySelectorAll('.needs-validation');

document.addEventListener("DOMContentLoaded", showTable(""))

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

    $.ajax({

        url: "utilities/showTable.php",
        method: "POST",
        data: {search: search},
        
    })
    .done(function (data){

        $("#table").html(data);
        
    })

}
function showModalDelEdit(id, acao){

    console.log(acao)

    if(acao === 'Cancel'){
        modal_del.show()
    }else{
        modal_edit.show()
    }

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

    let id = document.getElementById('id_usuario').value;

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
        })

});
document.getElementById('form_edit').addEventListener('submit', event => {
   
    event.preventDefault();

    let nome = document.getElementById('nome_Edit').value;
    let email = document.getElementById('email_Edit').value;
    let tel = document.getElementById('tel_Edit').value;
    let id = document.getElementById('id_usuario').value;

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
        .done(function(){
            showTable('searchbar');
            clear_form_add();
            modal_add.hide();
        })
    }
});

