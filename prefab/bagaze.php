<?php
include "../phpScripts/utils.php";
?>

<br>


<!-- Modal Dodaj -->
<div class="modal fade" id="dodajModal" tabindex="-1" aria-labelledby="dodajModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dodajModalLabel">Dodaj Bagaz</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Waga bagazu podrecznego</label>
            <input class="form-control" id="waga_bagazu_podrecznego">
          </div>
          <div class="mb-3">
            <label class="form-label">Waga bagazu rejestrowanego</label>
            <input class="form-control" id="waga_bagazu_rejestrowanego">
          </div>
          <?php
            $q = $_REQUEST["q"];
            @$search = $_REQUEST["search"];
            $curr_page = '\'bagaze\'';
            $temp = 'onclick="return insertBagaz(' . $q . ', ' . $curr_page . ')"';
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
        <h5 class="modal-title" id="edytujModalLabel">Edytuj Bagaz</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
        <div class="mb-3">
            <label class="form-label">Waga bagazu podrecznego</label>
            <input class="form-control" id="waga_bagazu_podrecznego_edit">
          </div>
          <div class="mb-3">
            <label class="form-label">Waga bagazu rejestrowanego</label>
            <input class="form-control" id="waga_bagazu_rejestrowanego_edit">
          </div>
          <?php
            $temp = 'onclick="return updateBagaz(' . $q . ', ' . $curr_page . ')"';
            echo '<button type="submit"' . $temp . 'class="btn btn-primary">Edytuj</button>';
            echo '<span>Edytujesz bagaz o id: <span id="bagazid_edit"></span></span>';
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<h2>Bagaze <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#dodajModal">
  Dodaj
</button></h2>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Typ bagazu</th>
        <th>Waga bagazu podrecznego</th>
        <th>Waga bagazu rejestrowanego</th>
        <th>Edytuj</th>
        <th>Usuń</th>
      </tr>
    </thead>
    <tbody>
      <?php
      getListBagaze($q, $search);
      getNumberOfBagaze();
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
      makeBagintionBagaze($q);
      ?>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>


</div>