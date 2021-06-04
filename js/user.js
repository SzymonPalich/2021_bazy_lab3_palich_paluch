function loadUserData(name) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("userMain").innerHTML =
        this.responseText;
        timer0();
        timer1();
        timer2();
    }
  };
  xhttp.open("GET", "prefab/" + name + ".php", true);
  xhttp.send();
}

function changeEditButton() {
  $("#userEdit").addClass("btn-primary").removeClass("btn-outline-primary");
  $("#userDelete").removeClass("btn-primary").addClass("btn-outline-primary");
}

function changeDelButton() {
  $("#userEdit").removeClass("btn-primary").addClass("btn-outline-primary");
  $("#userDelete").addClass("btn-primary").removeClass("btn-outline-primary");
}

function deleteUser(username, tab) {
  $.ajax({
      url: './phpScripts/accountMgmt.php',
      type: 'post',
      data: {username: username, choice: "DEL"},
      success: function (response) {
        $('#userDeleteModal').modal('hide');
        window.location.href="./index.php";
      }
  });
}

function updateUser(username, tab) {
  var name = $("#name").val().trim();
  var surname = $("#surname").val().trim();
  var e_mail = $("#e_mail").val().trim();
  var number = $("#number").val().trim();
  $.ajax({
      url: './phpScripts/accountMgmt.php',
      type: 'post',
      data: {username: username, name: name, surname: surname, e_mail: e_mail, number: number, choice: "EDIT" },
      success: function (response) {
        loadUserData('userProfile');
        $('#userEditModal').modal('hide');
      }
  });
  return false;
}

function deleteRezerwacja(id) {
  $.ajax({
      url: './phpScripts/rezerwacje.php',
      type: 'post',
      data: { id: id, command: "DELETE"},
      success: function (response) {
        loadUserData("userBookings");
      }
  });
}

function oplacRezerwacja(id) {
  $.ajax({
      url: './phpScripts/rezerwacje.php',
      type: 'post',
      data: { id: id, command: "UPDATE"},
      success: function (response) {
          loadUserData("userFlights");
      }
  });  
}

function drukuj(id) {
  window.open("phpScripts/drukuj.php?el=" + id)
}

function pay(id) {
  Swal.fire({
      title: 'Czy chcesz opłacić ten lot?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Tak',
      cancelButtonText: 'Nie',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        oplacRezerwacja(id);
      }
    })
}

function usunUzytkownika(username, tab){
  Swal.fire({
    title: 'Czy na pewno checsz usunąć konto?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Tak',
    cancelButtonText: 'Nie',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      deleteUser(username, tab);
    }
  })
}
