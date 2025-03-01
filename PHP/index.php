<!DOCTYPE html>
<html lang="pt-br" class="h-100" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../CSS/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>Listagem</title>
</head>

<body>
  <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
      <a href="#"><img src="../images/logoProponto.jpg" class="rounded-circle"></a>
    </div>
  </nav>

  <div class=" w-100 d-flex justify-content-around align-center bg-light">

    <!-- filters -->
    <div class="input-group w-25 p-3 bg-light">
      <select class="form-select fw-bold" id='tipos' aria-label="Default select example"
        oninput="showTable('searchbar')">
        <option selected value="todos">Todos</option>
        <option value="Social">Social</option>
        <option value="Cultural">Cultural</option>
        <option value="Esportivo">Esportivo</option>
        <option value="Corporativo">Corporativo</option>
        <option value="Religioso">Religioso</option>
        <option value="Entreterimento">Entreterimento</option>
        <option value="Outro">Outro</option>
      </select>
    </div>

    <!-- Data -->
    <div class="input-container">
      <label for="de" class="text-black fw-bold">De:</label>
      <input type="date" id="de" onchange="showTable('searchbar')">
      <label for="ate" class="text-black fw-bold">Até:</label>
      <input type="date" id="ate" onchange="showTable('searchbar')">
    </div>

    <!-- Search -->
    <div class="input-group w-25 p-3 fw-bold ">
      <select class="form-select fw-bold " id='column' aria-label="Default select example"
        oninput="showTable('searchbar')">
        <option value="nome_evento">Nome</option>
        <option value="endereco_evento">Endereço</option>
      </select>
      <input class="form-control w-50" type="text" placeholder="Pesquisar..." id='searchbar'
        aria-label="default input example" oninput="showTable('searchbar')" value="">
      <span class="input-group-text" id="inputGroup-sizing-default">
        <i class="bi bi-search"></i>
      </span>
    </div>

    <!-- Preco -->
    <div class="input-container w-25 p-3">
      <div class="input-group flex-nowrap ">
        <span class="input-group-text">R$</span>
          <input type="number" class="form-control" id="dePreco" placeholder="De:" oninput="showTable('searchbar')"> 
      </div>
      <div class="input-group flex-nowrap">
      <span class="input-group-text">R$</span>
          <input type="number" class="form-control" id="atePreco" placeholder="Até:" oninput="showTable('searchbar')">
          
        </div>
    </div>

    <!-- Cadastrar -->
    <button id="adicionar" class="btn btn-warning fw-bold m-2" data-bs-toggle="modal" data-bs-target="#modal_add">
      Cadastrar
      <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#000">
        <path
          d="M448.67-280h66.66v-164H680v-66.67H515.33V-680h-66.66v169.33H280V-444h168.67v164Zm31.51 200q-82.83 0-155.67-31.5-72.84-31.5-127.18-85.83Q143-251.67 111.5-324.56T80-480.33q0-82.88 31.5-155.78Q143-709 197.33-763q54.34-54 127.23-85.5T480.33-880q82.88 0 155.78 31.5Q709-817 763-763t85.5 127Q880-563 880-480.18q0 82.83-31.5 155.67Q817-251.67 763-197.46q-54 54.21-127 85.84Q563-80 480.18-80Zm.15-66.67q139 0 236-97.33t97-236.33q0-139-96.87-236-96.88-97-236.46-97-138.67 0-236 96.87-97.33 96.88-97.33 236.46 0 138.67 97.33 236 97.33 97.33 236.33 97.33ZM480-480Z" />
      </svg>
    </button>

  </div>

  <!-- Modal de Cadastrar -->
  <div class="modal fade modal-xl" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Evento</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            onclick="clear_form()"></button>
        </div>
        <form id="form_add" class="needs-validation" novalidate>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <small class="form-text align-start mb-1">
                  Tipo do evento:
                </small>
              </div>
              <div class="col">
                <small class="form-text align-start mb-1">
                  Nome do evento:
                </small>
              </div>
              <div class="col">
                <small class="form-text align-start mb-1">
                  Descrição do evento:
                </small>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <select class="form-select" id='tipo' aria-label="Default select example" required>
                  <option selected disabled hidden value="">Choose...</option>
                  <option value="Social">Social</option>
                  <option value="Cultural">Cultural</option>
                  <option value="Esportivo">Esportivo</option>
                  <option value="Corporativo">Corporativo</option>
                  <option value="Religioso">Religioso</option>
                  <option value="Entreterimento">Entreterimento</option>
                  <option value="Outro">Outro</option>
                </select>

              </div>
              <div class="col">
                <input class="form-control" type="text" id="nome" required>
                <div class="invalid-feedback">
                  Insira um nome.
                </div>
              </div>
              <div class="col">
                <input class="form-control" type="text" id="desc" required>
                <div class="invalid-feedback">
                  Insira uma Descrição
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <small class="form-text align-start mb-1">
                  Endereço do evento:
                </small>
              </div>
              <div class="col">
                <small class="form-text align-start mb-1">
                  Link do Endereço:
                </small>
              </div>
              <div class="col">
                <small class="form-text align-start mb-1">
                  Data:
                </small>
              </div>

            </div>
            <div class="row">
              <div class="col">
                <input class="form-control" type="text" id="endereco" required>
                <div class="invalid-feedback">
                  Insira um endereço.
                </div>

              </div>
              <div class="col">
                <input class="form-control" type="text" id="linkEnde" required>
                <div class="invalid-feedback">
                  Insira um link do endereço.
                </div>
              </div>
              <div class="col">
                <input class="form-control" type="date" id="date" onload="definirDataMinima()" required>
                <div class="invalid-feedback">
                  Insira a data inicial
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <small class="form-text align-start mb-1">
                  Hora inicial do evento:
                </small>
              </div>
              <div class="col">
                <small class="form-text align-start mb-1">
                  Preço :
                </small>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <input class="form-control" type="text" id="horaInicial" onblur="validarHora(this)" required>
                <div class="invalid-feedback">
                  Insira uma hora inicial.
                </div>
              </div>
              <div class="col">
                <input class="form-control" type="number" id="preco" required>
                <div class="invalid-feedback">
                  Insira um preço.
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-warning">Salvar</button>
          </div>
        </form>
      </div>
    </div>
    <div class="toast align-items-center text-dark border-0 position-absolute top-0 bg-warning end-0 m-4" role="alert"
      aria-live="assertive" id="toastExist" aria-atomic="true" data-bs-delay='2000' data-bs-autohide="true">
      <div class="d-flex">
        <div class="toast-body fw-bold">
          Registro já encontrado em nosso banco
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
          aria-label="Close"></button>
      </div>
    </div>
    <div class="toast align-items-center text-light bg-danger border-0 position-absolute top-0 bg-success end-0 m-4"
      role="alert" aria-live="assertive" id="toastDanger" aria-atomic="true" data-bs-delay='2000'
      data-bs-autohide="true">
      <div class="d-flex">
        <div class="toast-body fw-bold">
          Complete todos os inputs
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
          aria-label="Close"></button>
      </div>
    </div>
  </div>
  </div>


  <div class="toast align-items-center text-light border-0 position-absolute top-0 bg-success end-0 m-4" role="alert"
    aria-live="assertive" id="toastSuccess" aria-atomic="true" data-bs-delay='2000' data-bs-autohide="true">
    <div class="d-flex">
      <div class="toast-body fw-bold">
        Registro feito com sucesso
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
        aria-label="Close"></button>
    </div>
  </div>
  </div>

  <!-- Modal de deletar -->
  <div class="modal fade" id="modal_del" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-theme="dark">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Deletar Usuario</h1>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="form_del">
          <div class="modal-body" id="modalCancel_body">

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger">Deletar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="toast align-items-center text-light border-0 position-absolute top-0 bg-danger end-0 m-4" role="alert"
    aria-live="assertive" id="toastDel" aria-atomic="true" data-bs-delay='2000' data-bs-autohide="true">
    <div class="d-flex">
      <div class="toast-body fw-bold">
        Registro deletado com successo
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
        aria-label="Close"></button>
    </div>
  </div>
  <!-- Modal de editar -->
  <div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-theme="dark">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuario</h1>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="form_edit">
          <div class="modal-body" id="modalEdit_body">

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Editar</button>
          </div>
        </form>
      </div>
    </div>
    <div class="toast align-items-center text-light border-0 position-absolute top-0 bg-primary end-0 m-4" role="alert"
      aria-live="assertive" id="toastHora" aria-atomic="true" data-bs-delay='2000' data-bs-autohide="true">
      <div class="d-flex">
        <div class="toast-body fw-bold">
          Por favor coloque no formato hh:mm
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
          aria-label="Close"></button>
      </div>
    </div>
  </div>
  <div class="toast align-items-center text-light border-0 position-absolute top-0 bg-success end-0 m-4" role="alert"
    aria-live="assertive" id="toastEdit" aria-atomic="true" data-bs-delay='2000' data-bs-autohide="true">
    <div class="d-flex">
      <div class="toast-body fw-bold">
        Edição feita com sucesso
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
        aria-label="Close"></button>
    </div>

  </div>


  <table class="table table-light table-striped text-center fw-bold table align-middle table-hover">
    <thead>
      <th>Tipo</th>
      <th>Nome</th>
      <th>Descrição</th>
      <th>Endereço</th>
      <th>Link do Endereço</th>
      <th>Data e hora inicial</th>
      <th>Preço</th>
      <th>Ações</th>
    </thead>
    <tbody id="table">

    </tbody>
  </table>
  <footer>
    <ul class="nav justify-content-center bg-dark">
      <li class="nav-item">
        <p class="text-secondary m-2 text-center">Created by: <br>Murilo Martins Mendonça &copy 2025</p>
      </li>

    </ul>
  </footer>
</body>
<script src="../JS/showTable.js"></script>

</html>