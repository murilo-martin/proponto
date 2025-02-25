<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
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

  <div class=" w-100 d-flex justify-content-around align-center">

    <!-- <div class="col">
      <select class="form-select" id='estado' aria-label="Default select example" oninput="table('searchbar')">
        <option value="todos" selected>Todos</option>
        <option value="falta">Em falta</option>
        <option value="em_estoque">Em estoque</option>
      </select>
    </div> -->

    <div class="input-group w-25 p-3">
      <input class="form-control" type="text" placeholder="Pesquisar..." id='searchbar'
        aria-label="default input example" oninput="showTable('searchbar')">
      <span class="input-group-text" id="inputGroup-sizing-default">
        <i class="bi bi-search"></i>
      </span>
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
  <div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-theme="dark">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Usuario</h1>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="form_add" class="needs-validation" novalidate>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="mb-3 w-100">
                  <label for="nome" class="col-form-label fw-bold">Nome:</label>
                  <input type="text" class="form-control " id="nome" required>
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="email" class="col-form-label fw-bold">Email:</label>
                  <input type="email" class="form-control" id="email" required>
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="tel" class="col-form-label fw-bold">Telefone:</label>
                  <input type="text" class="form-control" id="tel" placeholder="(XX)XXXXX-XXXX" required>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Cadastrar</button>
          </div>
        </form>
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
  </div>
  <table class="table table-dark table-striped text-center fw-bold table align-middle">
    <thead>
      <th>Nome</th>
      <th>Email</th>
      <th>Telefone</th>
      <th>Ações</th>
    </thead>
    <tbody id="table">

    </tbody>
  </table>
  <footer>
    <ul class="nav justify-content-center bg-dark">
      <li class="nav-item">
        <p class="text-secondary m-2 text-center">Create by: <br>Murilo Martins Mendonça ©2025</p>
      </li>

    </ul>
  </footer>
</body>
<script src="../JS/showTable.js"></script>

</html>