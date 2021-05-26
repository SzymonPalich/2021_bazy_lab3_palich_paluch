function setId(id, dest) {
    $(dest).text(id);
}

function loadTableContent(str, dest) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tabela").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "prefab/" + dest + ".php?q=" + str, true);
    xmlhttp.send();
}

function loadTableContentSearch(str, dest) {
    var search = $("#search").val(); // undefined
    if (search == null) {
        search = "";
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tabela").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "prefab/" + dest + ".php?q=" + str + "&search=" + search, true);
    xmlhttp.send();
}

function loadTable(dest) {
    curr = "#".concat(dest).concat("_link");
    $(".nav-link").removeClass("active");
    $(curr).addClass("active");
    loadTableContent(1, dest);
}


function loadTableOth(dest) {
    curr = "#".concat(dest).concat("_link");
    $(".nav-link").removeClass("active");
    $(curr).addClass("active");
    loadTableContentOth(dest);
}


function loadTableContentOth(dest) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tabela").innerHTML = this.responseText;
            drawChartBagaze();
            drawChartMiejsca();
            drawChartKlienci();     
        }
    };
    xmlhttp.open("GET", "prefab/" + dest + ".php", true);
    xmlhttp.send();
}

function loadTableContentPensje(dest) {
    curr = "#".concat(dest).concat("_link");
    $(".nav-link").removeClass("active");
    $(curr).addClass("active");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tabela").innerHTML = this.responseText;
            drawChartPensje();            
        }
    };
    xmlhttp.open("GET", "prefab/" + dest + ".php", true);
    xmlhttp.send();
}

function loadTableContentObrot(dest) {
    curr = "#".concat(dest).concat("_link");
    $(".nav-link").removeClass("active");
    $(curr).addClass("active");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tabela").innerHTML = this.responseText;
            //drawChartPensje();
            
        }
    };
    xmlhttp.open("GET", "prefab/" + dest + ".php", true);
    xmlhttp.send();
}


function deleteUser(id, q) {
    $.ajax({
        url: './phpScripts/uzytkownikDIU.php',
        type: 'post',
        data: { id: id, command: "DELETE" },
        success: function (response) {
            loadTableContent(q, "uzytkownicy");
        }
    });
}

function updateUser(q, dest) {
    var id = $("#userid_edit").text();
    var username = $("#username_edit").val().trim();
    var pass = $("#password_edit").val().trim();
    var typ_konta = $("#typ_konta_edit").val().trim();
    if (typ_konta != "")
        typ_konta = typ_konta.match(/\d+/g)[0];
    $('#edytujModal').modal('hide');
    $.ajax({
        url: './phpScripts/uzytkownikDIU.php',
        type: 'post',
        data: { id: id, username: username, pass: pass, typ_konta: typ_konta, command: "UPDATE" },
        success: function (response) {
            loadTableContent(q, dest);
        }
    });
    return false;
}

function insertUser(q, dest) {

    var username = $("#username").val().trim();
    var pass = $("#password").val().trim();
    var typ_konta = $("#typ_konta").val().trim();
    if (typ_konta != "")
        typ_konta = typ_konta.match(/\d+/g)[0];
    $('#dodajModal').modal('hide');
    $.ajax({
        url: './phpScripts/uzytkownikDIU.php',
        type: 'post',
        data: { username: username, pass: pass, typ_konta: typ_konta, command: "INSERT" },
        success: function (response) {
            loadTableContent(q, dest);
        }
    });
    return false;
}

function deleteSamolot(id, q) {
    $.ajax({
        url: './phpScripts/samolotDIU.php',
        type: 'post',
        data: { id: id, command: "DELETE" },
        success: function (response) {
            loadTableContent(q, "samoloty");
        }
    });
}

function updateSamolot(q, dest) {
    var id = $("#samolotid_edit").text();
    var id_typ = $("#typ_edit").val().trim();
    if (id_typ != "")
        id_typ = id_typ.match(/\d+/)[0];
    var marka = $("#marka_edit").val().trim();
    var model = $("#model_edit").val().trim();
    var l_miejsc = $("#miejsca_edit").val().trim();
    $('#edytujModal').modal('hide');
    $.ajax({
        url: './phpScripts/samolotDIU.php',
        type: 'post',
        data: { id: id, id_typ: id_typ, marka: marka, model: model, l_miejsc: l_miejsc, command: "UPDATE" },
        success: function (response) {
            loadTableContent(q, dest);
        }
    });
    return false;
}



function insertSamolot(q, dest) {
    var id_typ = $("#typ").val().trim().charAt(0);
    var marka = $("#marka").val().trim();
    var model = $("#model").val().trim();
    var l_miejsc = $("#miejsca").val().trim();
    $('#dodajModal').modal('hide');
    $.ajax({
        url: './phpScripts/samolotDIU.php',
        type: 'post',
        data: { id_typ: id_typ, marka: marka, model: model, l_miejsc: l_miejsc, command: "INSERT" },
        success: function (response) {
            loadTableContent(q, dest);
        }
    });
    return false;
}


function deletePracownik(id, q) {
    $.ajax({
        url: './phpScripts/pracownikDIU.php',
        type: 'post',
        data: { id: id, command: "DELETE" },
        success: function (response) {
            loadTableContent(q, "pracownicy");
        }
    });
}

function updatePracownik(q, dest) {
    var id = $("#pracownikid_edit").text();
    var imie = $("#imie_edit").val().trim();
    var nazwisko = $("#nazwisko_edit").val().trim();
    var stanowisko = $("#stanowisko_edit").val().trim();
    var pensja = $("#pensja_edit").val().trim();
    $('#edytujModal').modal('hide');
    $.ajax({
        url: './phpScripts/pracownikDIU.php',
        type: 'post',
        data: { id: id, imie: imie, nazwisko: nazwisko, stanowisko: stanowisko, pensja: pensja, command: "UPDATE" },
        success: function (response) {
            loadTableContent(q, dest);
        }
    });
    return false;
}

function insertPracownik(q, dest) {
    var imie = $("#imie").val().trim();
    var nazwisko = $("#nazwisko").val().trim();
    var stanowisko = $("#stanowisko").val().trim();
    var pensja = $("#pensja").val().trim();
    $('#dodajModal').modal('hide');
    $.ajax({
        url: './phpScripts/pracownikDIU.php',
        type: 'post',
        data: { imie: imie, nazwisko: nazwisko, stanowisko: stanowisko, pensja: pensja, command: "INSERT" },
        success: function (response) {
            loadTableContent(q, dest);
        }
    });
    return false;
}


function deleteLotnisko(id, q) {
    $.ajax({
        url: './phpScripts/lotniskaDIU.php',
        type: 'post',
        data: { id: id, command: "DELETE" },
        success: function (response) {
            loadTableContent(q, "lotniska");
        }
    });
}



function updateLotnisko(q, dest) {
    var id = $("#lotniskoid_edit").text();
    var kod_lotniska = $("#kod_edit").val().trim();
    var miasto = $("#miasto_edit").val().trim();
    var kraj = $("#kraj_edit").val().trim();
    $('#edytujModal').modal('hide');
    $.ajax({
        url: './phpScripts/lotniskaDIU.php',
        type: 'post',
        data: { id: id, kod_lotniska: kod_lotniska, miasto: miasto, kraj: kraj, command: "UPDATE" },
        success: function (response) {
            loadTableContent(q, dest);
        }
    });
    return false;
}

function insertLotnisko(q, dest) {
    var kod_lotniska = $("#kod").val().trim();
    var miasto = $("#miasto").val().trim();
    var kraj = $("#kraj").val().trim();
    $('#dodajModal').modal('hide');
    $.ajax({
        url: './phpScripts/lotniskaDIU.php',
        type: 'post',
        data: { kod_lotniska: kod_lotniska, miasto: miasto, kraj: kraj, command: "INSERT" },
        success: function (response) {
            loadTableContent(q, dest);
        }
    });
    return false;
}

function deleteBagaz(id, q) {
    $.ajax({
        url: './phpScripts/bagazeDIU.php',
        type: 'post',
        data: { id: id, command: "DELETE" },
        success: function (response) {
            loadTableContent(q, "bagaze");
        }
    });
}

function updateBagaz(q, dest) {
    var id = $("#bagazid_edit").text();
    var waga_bagazu_podrecznego = $("#waga_bagazu_podrecznego_edit").val().trim();
    var waga_bagazu_rejestrowanego = $("#waga_bagazu_rejestrowanego_edit").val().trim();
    $('#edytujModal').modal('hide');
    $.ajax({
        url: './phpScripts/bagazeDIU.php',
        type: 'post',
        data: { id: id, waga_bagazu_podrecznego: waga_bagazu_podrecznego, waga_bagazu_rejestrowanego: waga_bagazu_rejestrowanego, command: "UPDATE" },
        success: function (response) {
            loadTableContent(q, dest);
        }
    });
    return false;
}

function insertBagaz(q, dest) {
    var waga_bagazu_podrecznego = $("#waga_bagazu_podrecznego").val().trim();
    var waga_bagazu_rejestrowanego = $("#waga_bagazu_rejestrowanego").val().trim();
    $('#dodajModal').modal('hide');
    $.ajax({
        url: './phpScripts/bagazeDIU.php',
        type: 'post',
        data: { waga_bagazu_podrecznego: waga_bagazu_podrecznego, waga_bagazu_rejestrowanego: waga_bagazu_rejestrowanego, command: "INSERT" },
        success: function (response) {

            loadTableContent(q, dest);
        }
    });
    return false;
}

function deleteLot(id, q) {
    $.ajax({
        url: './phpScripts/lotyDIU.php',
        type: 'post',
        data: { id: id, command: "DELETE" },
        success: function (response) {
            loadTableContent(q, "loty");
        }
    });
}

function updateLot(q, dest) {
    var id = $("#lotid_edit").text();
    var m_odlotu = $("#m_odlotu_edit").val();
    if (m_odlotu != "")
        m_odlotu = m_odlotu.match(/\d+/)[0];

    var m_przylotu = $("#m_przylotu_edit").val();
    if (m_przylotu != "")
        m_przylotu = m_przylotu.match(/\d+/g)[0];

    var samolot = $("#samolot_edit").val();
    if (samolot != "")
        samolot = samolot.match(/\d+/g)[0];

    var d_odlotu = $("#d_odlotu_edit").val().trim().replace("T", " ");
    var d_przylotu = $("#d_przylotu_edit").val().trim().replace("T", " ");
    $('#edytujModal').modal('hide');

    $.ajax({
        url: './phpScripts/lotyDIU.php',
        type: 'post',
        data: { id: id, m_odlotu: m_odlotu, m_przylotu: m_przylotu, samolot: samolot, d_odlotu: d_odlotu, d_przylotu: d_przylotu, command: "UPDATE" },
        success: function (response) {
            loadTableContent(q, dest);
        }
    });
    return false;
}

function insertLot(q, dest) {
    var m_odlotu = $("#m_odlotu").val();
    if (m_odlotu != "")
        m_odlotu = m_odlotu.match(/\d+/)[0];

    var m_przylotu = $("#m_przylotu").val();
    if (m_przylotu != "")
        m_przylotu = m_przylotu.match(/\d+/g)[0];

    var samolot = $("#samolot").val();
    if (samolot != "")
        samolot = samolot.match(/\d+/g)[0];

    var d_odlotu = $("#d_odlotu").val().trim().replace("T", " ");
    var d_przylotu = $("#d_przylotu").val().trim().replace("T", " ");

    $('#dodajModal').modal('hide');
    $.ajax({
        url: './phpScripts/lotyDIU.php',
        type: 'post',
        data: { m_odlotu: m_odlotu, m_przylotu: m_przylotu, samolot: samolot, d_odlotu: d_odlotu, d_przylotu: d_przylotu, command: "INSERT" },
        success: function (response) {
            loadTableContent(q, dest);
        }
    });
    return false;
}

function deleteBilet(id, q) {
    $.ajax({
        url: './phpScripts/biletyDIU.php',
        type: 'post',
        data: { id: id, command: "DELETE" },
        success: function (response) {
            loadTableContent(q, "bilety");
        }
    });
}

function updateBilet(q, dest) {
    var id = $("#biletid_edit").text();
    var pasazer = $("#pasazer_edit").val().trim();
    var lot = $("#lot_edit").val().trim();
    var bagaz = $("#bagaz_edit").val().trim();
    var miejsce = $("#miejsce_edit").val().trim();
    var cena = $("#cena_edit").val().trim();
    var oplacony = $("#oplacony_edit").val().trim();
    if (oplacony != "")
        oplacony = oplacony.match(/\d+/g)[0];
    $('#edytujModal').modal('hide');
    $.ajax({
        url: './phpScripts/biletyDIU.php',
        type: 'post',
        data: { id: id, pasazer: pasazer, lot: lot, bagaz: bagaz, miejsce: miejsce, cena: cena, oplacony: oplacony, command: "UPDATE" },
        success: function (response) {
            loadTableContent(q, dest);
        }
    });
    return false;
}

function insertBilet(q, dest) {
    var pasazer = $("#pasazer").val().trim();
    var lot = $("#lot").val().trim();
    var bagaz = $("#bagaz").val().trim();
    var miejsce = $("#miejsce").val().trim();
    var cena = $("#cena").val().trim();
    var oplacony = $("#oplacony").val().trim();
    if (oplacony != "")
        oplacony = oplacony.match(/\d+/g)[0];
    $('#dodajModal').modal('hide');
    $.ajax({
        url: './phpScripts/biletyDIU.php',
        type: 'post',
        data: { pasazer: pasazer, lot: lot, bagaz: bagaz, miejsce: miejsce, cena: cena, oplacony: oplacony, command: "INSERT" },
        success: function (response) {
            loadTableContent(q, dest);
        }
    });
    return false;
}