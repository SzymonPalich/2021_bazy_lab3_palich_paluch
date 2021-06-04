<br>

<!-- Modal Dodaj -->
<div class="modal fade" id="dodajModal" tabindex="-1" aria-labelledby="dodajModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dodajModalLabel">Dodaj Uzytkownika</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Nazwa użytkownika</label>
            <input class="form-control" id="username">
          </div>
          <div class="mb-3">
            <label class="form-label">Hasło</label>
            <input type="password" class="form-control" id="password">
          </div>
          <div class="mb-3">
            <label class="form-label">Typ Konta</label>
            <select class="form-control" id="typ_konta">
              <option>0 - Uzytkownik</option>
              <option>1 - Administrator</option>
            </select>
          </div>
          <?php
          include "../phpScripts/utils.php";
          $q = $_REQUEST["q"];
          @$search = $_REQUEST["search"];
          $curr_page = '\'uzytkownicy\'';
          $temp = 'onclick="return insertUser(' . $q . ', ' . $curr_page . ')"';
          echo '<button type="submit"' . $temp . 'class="btn btn-primary">Dodaj</button>';
          ?>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal Edit -->
<div class="modal fade" id="edytujModal" tabindex="-1" aria-labelledby="edytujModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edytujModalLabel">Edytuj Uzytkownika</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input class="form-control" id="username_edit">
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" id="password_edit">
          </div>
          <div class="mb-3">
            <label class="form-label">Typ Konta</label>
            <select class="form-control" id="typ_konta_edit">
              <option>0 - Uzytkownik</option>
              <option>1 - Administrator</option>
            </select>
          </div>
          <?php
          $temp = 'onclick="return updateUser(' . $q . ', ' . $curr_page . ')"';
          echo '<button type="return submit"' . $temp . 'class="btn btn-primary">Edytuj</button>';
          echo '<span>Edytujesz uzytkownika o id: <span id="userid_edit"></span></span>';
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<h2>Uzytkownicy<button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#dodajModal">
    Dodaj
  </button></h2>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Nazwa Użytkownika</th>
        <th>Typ Konta</th>
        <th>Edytuj</th>
        <th>Usuń</th>
      </tr>
    </thead>
    <tbody>
      <?php
      getListUzytkownicy($q, $search);
      getNumberOfUzytkownicy();
      ?>
    </tbody>
  </table>


  <nav id="paginacja" aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <?php
      makeBagintionUzytkownicy($q);
      ?>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>


</div>