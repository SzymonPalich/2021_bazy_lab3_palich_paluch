<?php
include "../phpScripts/utils.php";
?>
<br>

<!-- Modal Dodaj -->
<div class="modal fade" id="dodajModal" tabindex="-1" aria-labelledby="dodajModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dodajModalLabel">Dodaj Lot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Miejsce odlotu</label>
            <?php
            echo lotyGetOdlot("ADD");
            ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Miejsce przylotu</label>
            <?php
            echo lotyGetPrzylot("ADD");
            ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Samolot</label>
            <?php
            echo lotyGetSamolot("ADD");
            ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Data odlotu</label>
            <input type="datetime-local" class="form-control" id="d_odlotu">
          </div>
          <div class="mb-3">
            <label class="form-label">Data przylotu</label>
            <input type="datetime-local" class="form-control" id="d_przylotu">
          </div>
          <?php
          $q = $_REQUEST["q"];
          @$search = $_REQUEST["search"];
          $curr_page = '\'loty\'';
          $temp = 'onclick="return insertLot(' . $q . ', ' . $curr_page . ')"';
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
        <h5 class="modal-title" id="edytujModalLabel">Edytuj Lot</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Miejsce odlotu</label>
            <?php
            echo lotyGetOdlot("EDIT");
            ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Miejsce przylotu</label>
            <?php
            echo lotyGetPrzylot("EDIT");
            ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Samolot</label>
            <?php
            echo lotyGetSamolot("EDIT");
            ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Data odlotu</label>
            <input type="datetime-local" class="form-control" id="d_odlotu_edit">
          </div>
          <div class="mb-3">
            <label class="form-label">Data przylotu</label>
            <input type="datetime-local" class="form-control" id="d_przylotu_edit">
          </div>
          <?php
          $temp = 'onclick="return updateLot(' . $q . ', ' . $curr_page . ')"';
          echo '<button type="submit"' . $temp . 'class="btn btn-primary">Edytuj</button>';
          echo '<span>Edytujesz samolot o id: <span id="lotid_edit"></span></span>';
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<h2>Loty <button type="button"  onclick="fixAddDate();" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#dodajModal">
    Dodaj
  </button></h2>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>M. Odlotu</th>
        <th>M. Przylotu</th>
        <th>Samolot</th>
        <th>D. odlotu</th>
        <th>D. przylotu</th>
        <th>Czas lotu</th>
        <th>Waga bagazy</th>
        <th>Zysk</th>
        <th>Edytuj</th>
        <th>Usuń</th>
      </tr>
    </thead>
    <tbody>
      <?php
      getListLoty($q, $search);
      getNumberOfLoty();
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
      makeBagintionLoty($q);
      ?>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
</div>

