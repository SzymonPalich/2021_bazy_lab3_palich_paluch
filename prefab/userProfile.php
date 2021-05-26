<?php include "../phpScripts/config.php";
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
              <button id="userEdit" class="btn btn-primary" onclick="changeEditButton();" data-bs-toggle="modal" data-bs-target="#userEditModal">Edit</button>
              <button id="userDelete" class="btn btn-outline-primary" onclick="changeDelButton();" data-bs-toggle="modal" data-bs-target="#userDeleteModal">Delete</button>
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
              <h6 class="mb-0">фамилия</h6>
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
  </div>

  <!-- Edit -->
  <div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="userEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userEditModalLabel">Edit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label class="form-label">Imie</label>
              <input class="form-control" id="name" placeholder="<?php echo ucfirst($name) ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">фамилия</label>
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
              <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
              <button type="submit" onclick="return updateUser('<?php echo $username . '\',\'' . $page ?>');" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Delete -->
<div class="modal fade" id="userDeleteModal" tabindex="-1" aria-labelledby="userDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userDeleteModalLabel">Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4>Are you sure you want to delete your account?</h4>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary" onclick="deleteUser('<?php echo $username . '\',\'' . $page ?>');">Yes</button>
        </div>
      </div>
    </div>
  </div>