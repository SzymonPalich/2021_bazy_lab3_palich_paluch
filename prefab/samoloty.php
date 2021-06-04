<?php
include "../phpScripts/utils.php";
?>

<br>





<!-- Modal Dodaj -->
<div class="modal fade" id="dodajModal" tabindex="-1" aria-labelledby="dodajModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dodajModalLabel">Dodaj Samolot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Typ samolotu</label>
            <?php
              echo samolotyGetTyp("ADD");
            ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Marka</label>
            <input class="form-control" id="marka">
          </div>
          <div class="mb-3">
            <label class="form-label">Model</label>
            <input class="form-control" id="model">
          </div>
          <div class="mb-3">
            <label class="form-label">Liczba miejsc</label>
            <input class="form-control" id="miejsca">
          </div>
          <?php
            $q = $_REQUEST["q"];
            @$search = $_REQUEST["search"];
            $curr_page = '\'samoloty\'';
            $temp = 'onclick="return insertSamolot(' . $q . ', ' . $curr_page . ')"';
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
        <h5 class="modal-title" id="edytujModalLabel">Edytuj Samolot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
        <div class="mb-3">
            <label class="form-label">Typ samolotu</label>
            <?php
              echo samolotyGetTyp("EDIT");
            ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Marka</label>
            <input class="form-control" id="marka_edit">
          </div>
          <div class="mb-3">
            <label class="form-label">Model</label>
            <input class="form-control" id="model_edit">
          </div>
          <div class="mb-3">
            <label class="form-label">Liczba miejsc</label>
            <input class="form-control" id="miejsca_edit">
          </div>
          <?php
            $temp = 'onclick="return updateSamolot(' . $q . ', ' . $curr_page . ')"';
            echo '<button type="submit"' . $temp . 'class="btn btn-primary">Edytuj</button>';
            echo '<span>Edytujesz samolot o id: <span id="samolotid_edit"></span></span>';
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<h2>Samoloty <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#dodajModal">
  Dodaj
</button></h2>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Typ samolotu</th>
        <th>Marka</th>
        <th>Model</th>
        <th>L. Miejsc</th>
        <th>Edytuj</th>
        <th>Usuń</th>
      </tr>
    </thead>
    <tbody>
      <?php
      getListSamoloty($q, $search);
      getNumberOfSamoloty();
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
      makeBaginationPracownicy($q);
      ?>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>


</div>