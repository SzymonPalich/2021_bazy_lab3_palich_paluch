  <nav class="navbar navbar-expand-lg navbar-light bd-navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">WruumAir</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">


        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
          include "phpscripts/config.php";
          if (!isset($_SESSION['username'])) {
          ?><li class="nav-item"
          ><?php
                echo '<a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal" onclick="javascript: showLoginForm();">Zaloguj się</a>';
            ?></li><?php
            } else if($_SESSION['typ_konta'] == 0){
            ?><li class="nav-item dropdown">
              <a href="#" class="nav-link text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="d-none d-sm-inline mx-1">
                <?php
                      echo 'Witaj, ' . ucfirst($_SESSION['username']);
                    ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-dark text-small shadow w-100" aria-labelledby="dropdownUser">
                <li><a class="dropdown-item" id="home" href="user.php">Twój profil</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="phpScripts/logout.php">Wyloguj się</a></li>
              </ul>
            </li>
            </li>
            <?php
            } else {
            ?><li class="nav-item dropdown">
              <a href="#" class="nav-link text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="d-none d-sm-inline mx-1">
                <?php
                      echo 'Witaj, ' . ucfirst($_SESSION['username']);
                    } ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-dark text-small shadow w-100" aria-labelledby="dropdownUser">
                <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="phpScripts/logout.php">Sign Out</a></li>
              </ul>
            </li>
            </li>
        </ul>
      </div>
  </nav>