
<br>

<!-- Modal Dodaj -->
<div class="modal fade" id="dodajModal" tabindex="-1" aria-labelledby="dodajModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dodajModalLabel">Dodaj Lotniska</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Kod lotniska</label>
                        <input class="form-control" id="kod">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Miasto</label>
                        <input class="form-control" id="miasto">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kraj</label>
                        <input class="form-control" id="kraj">
                    </div>
                    <?php
                    include "../phpScripts/utils.php";
                    $q = $_REQUEST["q"];
                    @$search = $_REQUEST["search"];
                    $curr_page = '\'lotniska\'';
                    $temp = 'onclick="return insertLotnisko(' . $q . ', ' . $curr_page . ')"';
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
                <h5 class="modal-title" id="edytujModalLabel">Edytuj Lotnisko</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Kod lotniska</label>
                        <input class="form-control" id="kod_edit">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Miasto</label>
                        <input class="form-control" id="miasto_edit">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kraj</label>
                        <input class="form-control" id="kraj_edit">
                    </div>
                    <?php
                    $temp = 'onclick="return updateLotnisko(' . $q . ', ' . $curr_page . ')"';
                    echo '<button type="submit"' . $temp . 'class="btn btn-primary">Edytuj</button>';
                    echo '<span>Edytujesz lotnisko o id: <span id="lotniskoid_edit"></span></span>';
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<h2>Lotniska
    <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#dodajModal">
        Dodaj
    </button>
</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Kod lotniska</th>
                <th>Miasto</th>
                <th>Kraj</th>
                <th>Edytuj</th>
                <th>Usuń</th>
            </tr>
        </thead>
        <tbody>
            <?php
            getListLotniska($q, $search);
            getNumberOfLotniska();
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
            makeBagintionLotniska($q);
            ?>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>


</div>