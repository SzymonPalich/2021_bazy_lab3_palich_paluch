<br>

<!-- Modal Dodaj -->
<div class="modal fade" id="dodajModal" tabindex="-1" aria-labelledby="dodajModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dodajModalLabel">Dodaj Pracownika</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Imie</label>
                        <input class="form-control" id="imie">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nazwisko</label>
                        <input class="form-control" id="nazwisko">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stanowisko</label>
                        <input class="form-control" id="stanowisko">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pensja</label>
                        <input class="form-control" id="pensja">
                    </div>
                    <?php
                    include "../phpScripts/utils.php";
                    $q = $_REQUEST["q"];
                    @$search = $_REQUEST["search"];
                    $curr_page = '\'pracownicy\'';
                    $temp = 'onclick="return insertPracownik(' . $q . ', ' . $curr_page . ')"';
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
                <h5 class="modal-title" id="edytujModalLabel">Edytuj Pracownika</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Imie</label>
                        <input class="form-control" id="imie_edit">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nazwisko</label>
                        <input class="form-control" id="nazwisko_edit">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stanowisko</label>
                        <input class="form-control" id="stanowisko_edit">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pensja</label>
                        <input class="form-control" id="pensja_edit">
                    </div>
                    <?php
                    $temp = 'onclick="return updatePracownik(' . $q . ', ' . $curr_page . ')"';
                    echo '<button type="submit"' . $temp . 'class="btn btn-primary">Edytuj</button>';
                    echo '<span>Edytujesz pracownika o id: <span id="pracownikid_edit"></span></span>';
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<h2>Pracownicy
    <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#dodajModal">
        Dodaj
    </button>
</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Imie</th>
                <th>Nazwisko</th>
                <th>Stanowisko</th>
                <th>Pensja</th>
                <th>Edytuj</th>
                <th>Usuń</th>
            </tr>
        </thead>
        <tbody>
            <?php
            getListPracownicy($q, $search);
            getNumberOfPracownicy();
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