<?php
include "../phpScripts/utils.php";
?>

<br>
<script>
  $(function() {
    $(".bilety").bind("mouseenter", function(e) {
      $(".table-responsive").offset({
        left: e.pageX,
        top: e.pageY
      });
      $("#ToolTipDIv").show("slow");
    });
    $(".bilety").bind("mouseleave", function(e) {
      $(".table-responsive").hide("slow");
    });
  });
</script>

<!-- Modal Dodaj -->
<div class="modal fade" id="dodajModal" tabindex="-1" aria-labelledby="dodajModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dodajModalLabel">Dodaj Bilet</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Id Pasazer</label>
            <input class="form-control" id="pasazer">
          </div>
          <div class="mb-3">
            <label class="form-label">Id Lot</label>
            <input class="form-control" id="lot">
          </div>
          <div class="mb-3">
            <label class="form-label">Id Bagaz</label>
            <input class="form-control" id="bagaz">
          </div>
          <div class="mb-3">
            <label class="form-label">Miejsce</label>
            <input class="form-control" id="miejsce">
          </div>
          <div class="mb-3">
            <label class="form-label">Cena</label>
            <input class="form-control" id="cena">
          </div>
          <div class="mb-3">
            <label class="form-label">Czy oplacony?</label>
            <select class="form-control" id="oplacony">
              <option>0 - Nie oplacony</option>
              <option>1 - Oplacony</option>
            </select>
          </div>
          <?php
          $q = $_REQUEST["q"];
          @$search = $_REQUEST["search"];
          $curr_page = '\'bilety\'';
          $temp = 'onclick="return insertBilet(' . $q . ', ' . $curr_page . ')"';
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
        <h5 class="modal-title" id="edytujModalLabel">Edytuj Bilet</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Id Pasazer</label>
            <input class="form-control" id="pasazer_edit">
          </div>
          <div class="mb-3">
            <label class="form-label">Id Lot</label>
            <input class="form-control" id="lot_edit">
          </div>
          <div class="mb-3">
            <label class="form-label">Id Bagaz</label>
            <input class="form-control" id="bagaz_edit">
          </div>
          <div class="mb-3">
            <label class="form-label">Miejsce</label>
            <input class="form-control" id="miejsce_edit">
          </div>
          <div class="mb-3">
            <label class="form-label">Cena</label>
            <input class="form-control" id="cena_edit">
          </div>
          <div class="mb-3">
            <label class="form-label">Czy oplacony?</label>
            <select class="form-control" id="oplacony_edit">
              <option>0 - Nie oplacony</option>
              <option>1 - Oplacony</option>
            </select>
          </div>
          <?php
          $temp = 'onclick="return updateBilet(' . $q . ', ' . $curr_page . ')"';
          echo '<button type="submit"' . $temp . 'class="btn btn-primary">Edytuj</button>';
          echo '<span>Edytujesz bilet o id: <span id="biletid_edit"></span></span>';
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<h2>Bilety <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#dodajModal">
    Dodaj
  </button></h2>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Pasazer</th>
        <th>Lot</th>
        <th>Bagaz</th>
        <th>Miejsce</th>
        <th>Cena</th>
        <th>Czy oplacony?</th>
        <th>Edytuj</th>
        <th>Usuń</th>
      </tr>
    </thead>
    <tbody>
      <?php
      getListBilety($q, $search);
      getNumberOfBilety();
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
      makeBagintionBilety($q);
      ?>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>


</div>