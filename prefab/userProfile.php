<?php @include "../phpScripts/config.php";
$curs = oci_new_cursor($conn);
$username = $_SESSION['username'];
$page = "userProfile";
$stid = oci_parse($conn, "begin user_profile.user_find(:cursbv,'" . $username . "'); end;");
oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
oci_execute($stid);
oci_execute($curs);
while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
  $name = $row['IMIE'];
  $surname = $row['NAZWISKO'];
  $e_mail = $row['E_MAIL'];
  $number = $row['NR_TELEFONU'];
}
if (!(isset($name))) $name = "";
if (!(isset($surname))) $surname = "";
if (!(isset($e_mail))) $e_mail = "";
if (!(isset($number))) $number = "";

oci_free_statement($stid);
oci_free_statement($curs);
oci_close($conn);

?>

<?php
function sprawdzRezerwacje()
{
  session_start();
  $success = include "./phpScripts/config2.php";

  if (!$success) {
    include "../phpScripts/config2.php";
  }
  $curs = oci_new_cursor($conn);
  $stid = oci_parse($conn, "begin user_profile.user_bookings(:cursbv, '" . $_SESSION['username'] . "'); end;");
  oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
  oci_execute($stid);

  oci_execute($curs);

  $nie_oplacone = false;
  while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
    if (($row['CZY_OPLACONY'] == 0) && (date($row['DATA_ODLOTU']) > date("d-m-y h:i"))) {
      $nie_oplacone = true;
    }
  }

  oci_free_statement($stid);
  oci_free_statement($curs);
  oci_close($conn);
  return $nie_oplacone;
}

function najblizszeLoty()
{

  $success = include "./phpScripts/config2.php";

  if (!$success) {
    include "../phpScripts/config2.php";
  }
  $curs = oci_new_cursor($conn);
  $stid = oci_parse($conn, "begin user_profile.user_upcoming(:cursbv, '" . $_SESSION['username'] . "'); end;");
  oci_bind_by_name($stid, ":cursbv", $curs, -1, OCI_B_CURSOR);
  oci_execute($stid);

  oci_execute($curs);

  while (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
    echo '<center>';
    echo '<div class="alert alert-primary" role="alert">';
    echo "Masz lot w dniu " . $row['DATA_ODLOTU'] . " :)";
    echo '</div>';
    echo '</center>';
  }

  oci_free_statement($stid);
  oci_free_statement($curs);
  oci_close($conn);
}
?>



<div class="row" id="userInfo">
  <div class="mb-2">
    <div class="card">
      <div class="card-body">
        <div class="d-flex flex-column align-items-center text-center">
          <img src="placeholder.gif" alt="Admin" class="rounded-circle" width="150">
          <div class="mt-3">
            <h4><?php echo ucfirst($name) . " " . ucfirst($surname) ?></h4>
            <p class="text-secondary mb-1"><?php echo $e_mail ?></p>
            <p></p>
            <button id="userEdit" class="btn btn-primary" onclick="changeEditButton();" data-bs-toggle="modal" data-bs-target="#userEditModal">Edytuj</button>
            <button id="userDelete" class="btn btn-outline-primary" onclick="changeDelButton();usunUzytkownika('<?php echo $username . '\',\'' . $page ?>');" n>Usuń</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="mb-4">
    <div class="card mb-3">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Imie</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <?php echo $name ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Nazwisko</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <?php echo $surname ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">E-mail</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <?php echo $e_mail ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Nr. telefonu</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <?php echo $number ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div>
    <div class="col-xs-12">
      <div class="table-responsive">
        <?php
        if (@sprawdzRezerwacje()) {
          echo '<center>';
          echo '<div class="alert alert-danger" role="alert">';
          echo "Masz nie opłacone rezerwacje :) Radzę zajrzeć na panel rezerwacji :)";
          echo '</div>';
          echo '</center>';
        }
        @najblizszeLoty();
        ?>
      </div>
    </div>
  </div>
</div>


<!-- Edit -->
<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="userEditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userEditModalLabel">Edytuj</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Imie</label>
            <input class="form-control" id="name" placeholder="<?php echo ucfirst($name) ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Nazwisko</label>
            <input class="form-control" id="surname" placeholder="<?php echo ucfirst($surname) ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">E-Mail</label>
            <input class="form-control" id="e_mail" placeholder="<?php echo $e_mail ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Nr. telefonu</label>
            <input class="form-control" id="number" placeholder="<?php echo $number ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Anuluj</button>
            <button type="submit" onclick="return updateUser('<?php echo $username . '\',\'' . $page ?>');" class="btn btn-primary">Zapisz</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>