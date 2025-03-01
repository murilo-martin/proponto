const modal_add = new bootstrap.Modal("#modal_add");
const modal_del = new bootstrap.Modal("#modal_del");
const modal_edit = new bootstrap.Modal("#modal_edit");

var today = new Date().toISOString().split("T")[0];

document.getElementById("date").setAttribute("min", today);

const toastSuccess = new bootstrap.Toast(
  document.querySelector("#toastSuccess")
);

const toastDanger = new bootstrap.Toast(document.querySelector("#toastDanger"));

const toastCancel = new bootstrap.Toast(document.querySelector("#toastDel"));

const toastEdit = new bootstrap.Toast(document.querySelector("#toastEdit"));

const toastExist = new bootstrap.Toast(document.querySelector("#toastExist"));

const toastHora = new bootstrap.Toast(document.querySelector("#toastHora"));

const forms = document.querySelectorAll(".needs-validation");

document.addEventListener("DOMContentLoaded", showTable("searchbar"));

Array.from(forms).forEach((form) => {
  form.addEventListener(
    "submit",
    (event) => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }

      form.classList.add("was-validated");
    },
    false
  );
});

function clear_form_del() {
  document.getElementById("nome_Cancel").value = "";
  document.getElementById("desc_Cancel").value = "";
  document.getElementById("endereco_Cancel").value = "";
  document.getElementById("linkEnde_Cancel").value = "";
  document.getElementById("date_Cancel").value = "";
  document.getElementById("preco_Cancel").value = "";
  document.getElementById("tipo_Cancel").value = "";
  document.getElementById("horaInicial_Cancel").value = "";
  document.getElementById("form_del").classList.remove("was-validated");
}
function clear_form_edit() {
  document.getElementById("nome_Edit").value = "";
  document.getElementById("desc_Edit").value = "";
  document.getElementById("endereco_Edit").value = "";
  document.getElementById("linkEnde_Edit").value = "";
  document.getElementById("date_Edit").value = "";
  document.getElementById("preco_Edit").value = "";
  document.getElementById("tipo_Edit").value = "";
  document.getElementById("horaInicial_Edit").value = "";
  document.getElementById("form_edit").classList.remove("was-validated");
}

function clear_form() {
    document.getElementById("nome").value = "";
    document.getElementById("desc").value = "";
    document.getElementById("endereco").value = "";
    document.getElementById("linkEnde").value = "";
    document.getElementById("date").value = "";
    document.getElementById("preco").value = "";
    document.getElementById("tipo").value = "";
    document.getElementById("horaInicial").value = "";
    document.getElementById("form").classList.remove("was-validated");
  }

function getStatusFilter(){

    let tipos = document.getElementById('tipos').value;

    if(tipos.length > 0 && tipos != "todos"){
        return ` and tipo_evento = '${tipos}'`;
    
    }

    return "";

}

function getDateFilter(){

    let dataDe = document.getElementById('de').value;
    let dataAte = document.getElementById('ate').value;

    if(dataDe .length > 0 && dataAte.length > 0){
        return ` and dataIni_evento	 >= '${dataDe}' and dataIni_evento	 <= '${dataAte}'`

    }

    return "";

}

function getPriceFilter(){

    let precoDe = document.getElementById('dePreco').value;
    let precoAte = document.getElementById('atePreco').value;

    if(precoDe .length > 0 && precoAte.length > 0){
        return ` and preco_evento >= '${precoDe}' and preco_evento <= '${precoAte}'`

    }

    return "";

}


function showTable(search) {

  let searchBar = document.getElementById(search).value;
  let column = document.getElementById("column").value;

  searchBar = document.getElementById(search).value;

  $.ajax({
    url: "utilities/showTable.php",
    method: "POST",
    data: {
      search: searchBar,
      tipo: getStatusFilter(),
      column: column,
      date: getDateFilter(),
      preco: getPriceFilter()
    },
  }).done(function (data) {
    $("#table").html(data);
  });
}
function showModalDelEdit(id, acao) {
  console.log(acao);

  acao === "Cancel" ? modal_del.show() : modal_edit.show();

  $.ajax({
    // Chama o arquivo que pega as informações
    url: "utilities/puxarInfo_usuario.php",
    // Define o method
    method: "post",
    // Valores de "input"
    data: {
      id: id,
      acao: acao,
    },
  }).done(function (data) {
    $("#modal" + acao + "_body").html(data);
    document.getElementById("date_" + acao).setAttribute("min", today);
  });
}

function validarHora(input) {
  const regex = /^(0[0-9]|1[0-9]|2[0-3]):([0-5][0-9])$/;

  if (!regex.test(input.value)) {
    toastHora.show();
    input.value = "";

  }
}

document.getElementById("form_del").addEventListener("submit", (event) => {
  event.preventDefault();

  let id = document.getElementById("id_usuarioCancel").value;

  console.log(id);

  $.ajax({
    url: "utilities/deletarUsuario.php",
    method: "post",
    data: {
      id: id,
    },
  }).done(function () {
    showTable("searchbar");
    clear_form_del();
    modal_del.hide();
    toastCancel.show();
  });
});

function clear_form_add(clear_permissions) {
  clear_permissions.name = clear_permissions.name || clear_permissions.all;
  clear_permissions.desc = clear_permissions.desc || clear_permissions.all;
  clear_permissions.end = clear_permissions.end || clear_permissions.all;
  clear_permissions.link = clear_permissions.link || clear_permissions.all;

  clear_permissions.tipo = clear_permissions.tipo || clear_permissions.all;
  clear_permissions.date = clear_permissions.date || clear_permissions.all;
  clear_permissions.horaInicial =
    clear_permissions.horaInicial || clear_permissions.all;
  clear_permissions.preco = clear_permissions.preco || clear_permissions.all;
  clear_permissions.validated =
    clear_permissions.validated || clear_permissions.all;

  clear_permissions.name ? (document.getElementById("nome").value = "") : "";
  clear_permissions.desc ? (document.getElementById("desc").value = "") : "";
  clear_permissions.end ? (document.getElementById("endereco").value = "") : "";
  clear_permissions.link ? (document.getElementById("linkEnde").value = ""): "";
  clear_permissions.date ? (document.getElementById("date").value = "") : "";
  clear_permissions.preco ? (document.getElementById("preco").value = "") : "";
  clear_permissions.tipo ? (document.getElementById("tipo").value = "") : "";
  clear_permissions.horaInicial ? (document.getElementById("horaInicial").value = "") : "";
  clear_permissions.validated ? document.getElementById("form_add").classList.remove("was-validated") : "";
}

document.getElementById("form_edit").addEventListener("submit", (event) => {
  event.preventDefault();

  let tipo = document.getElementById("tipo_Edit").value;
  let nome = document.getElementById("nome_Edit").value;
  let desc = document.getElementById("desc_Edit").value;
  let endereco = document.getElementById("endereco_Edit").value;
  let link = document.getElementById("linkEnde_Edit").value;
  let data = document.getElementById("date_Edit").value;

  let hora = document.getElementById("horaInicial_Edit").value;
  let preco = document.getElementById("preco_Edit").value;
  let id = document.getElementById("id_usuarioEdit").value;

  if (
    nome.length > 0 &&
    tipo.length > 0 &&
    desc.length > 0 &&
    endereco.length > 0 &&
    link.length > 0 &&
    data.length > 0 &&
    hora.length > 0 &&
    preco.length > 0
  ) {
    $.ajax({
      url: "utilities/editarUsuario.php",
      method: "post",
      data: {
        id: id,
        tipo: tipo,
        nome: nome,
        descricao: desc,
        endereco: endereco,
        link: link,
        data: data,
        hora: hora,
        preco: preco,
      },
    }).done(function (data) {
      console.log(data);
      showTable("searchbar");
      clear_form_edit();
      modal_edit.hide();
      toastEdit.show();
    });
  }
});

document.getElementById("form_add").addEventListener("submit", (event) => {
  event.preventDefault();

  let tipo = document.getElementById("tipo").value;
  let nome = document.getElementById("nome").value;
  let desc = document.getElementById("desc").value;
  let endereco = document.getElementById("endereco").value;
  let link = document.getElementById("linkEnde").value;
  let data = document.getElementById("date").value;

  let hora = document.getElementById("horaInicial").value;
  let preco = document.getElementById("preco").value;

  if (
    nome.length > 0 &&
    tipo.length > 0 &&
    desc.length > 0 &&
    endereco.length > 0 &&
    link.length > 0 &&
    data.length > 0 &&
    hora.length > 0 &&
    preco.length > 0
  ) {
    $.ajax({
      url: "utilities/novo_usuario.php",
      method: "post",
      data: {
        tipo: tipo,
        nome: nome,
        descricao: desc,
        endereco: endereco,
        link: link,
        data: data,
        hora: hora,
        preco: preco,
      },
    }).done(function (data) {
      console.log(data);
      if (!data.includes("success")) {
        clear_form_add({
          name: data.includes("nome cadastrado"),
          desc: data.includes("descricao cadastrado"),
          end: data.includes("endereco cadastrado"),
          link: data.includes("link cadastrado"),
        });
        toastExist.show();
      } else {
        showTable("searchbar");
        clear_form_add({
          all: true,
        });
        modal_add.hide();
        toastSuccess.show();
      }
    });
  } else {
    toastDanger.show();
  }
});
