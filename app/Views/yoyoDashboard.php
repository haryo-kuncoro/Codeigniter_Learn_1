<!DOCTYPE html>
<html lang="en">

<head>
  <title>yoyo Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->
  <link rel="stylesheet" href="/assets/fonts/icon.css">
  <!-- <link rel="stylesheet" href="/assets/fonts/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="/assets/fonts/font-awesome.min.css">
  
  <!-- Datepicker -->
  <link href="/assets/datepicker/css/datepicker.css" rel='stylesheet' type='text/css'>
  <script src="/assets/datepicker/js/bootstrap-datepicker.js" type='text/javascript'></script>
  <style>

    .table-title .add-new {
      float: right;
      height: 30px;
      font-weight: bold;
      font-size: 12px;
      text-shadow: none;
      min-width: 100px;
      border-radius: 50px;
      line-height: 13px;
    }

    .table-title .add-new i {
      margin-right: 4px;
    }

    table.table {
      table-layout: fixed;
    }

    table.table tr th,
    table.table tr td {
      border-color: #e9e9e9;
    }

    table.table th i {
      font-size: 13px;
      margin: 0 5px;
      cursor: pointer;
    }

    table.table th:first-child {
      width: 50px;
    }

    table.table th:last-child {
      width: 100px;
    }

    table.table td a {
      cursor: pointer;
      display: inline-block;
      margin: 0 5px;
      min-width: 24px;
    }

    table.table td a.add {
      color: #27C46B;
    }

    table.table td a.edit {
      color: #FFC107;
    }

    table.table td a.delete {
      color: #E34724;
    }

    table.table td i {
      font-size: 19px;
    }

    table.table td a.add i {
      font-size: 24px;
      margin-right: -1px;
      position: relative;
      top: 3px;
    }

    table.table .form-control {
      height: 32px;
      line-height: 32px;
      box-shadow: none;
      border-radius: 2px;
    }

    table.table .form-control.error {
      border-color: #f50000;
    }

    table.table td .add {
      display: none;
    }
  </style>
  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
      var actions = $("table td:last-child").html();
            
      // [table]] on edit button click
      $(document).on("click", ".edit", function() {
        document.getElementById("InputNama").value = $(this).parents("tr").find("td:eq(1)").text();
        document.getElementById("InputStatus").value = $(this).parents("tr").find("td:eq(2)").text();
        document.getElementById("InputTanggal").value = $(this).parents("tr").find("td:eq(3)").text();
        document.getElementById("ID").value = $(this).parents("tr").find("td:eq(4)").text();

        document.getElementById("btnSimpan").disabled = true;
        document.getElementById("btnUbah").disabled = false;
        document.getElementById("btnHapus").disabled = false;
        const element = document.getElementById("btnUbah");
        element.scrollIntoView();
      });

      // [table] on delete button click
      $(document).on("click", ".delete", function() {
        if (confirm("Yakin akan menghapus data ini?")) {
          document.getElementById("ID").value = $(this).parents("tr").find("td:eq(4)").text();
          document.getElementById("InputAction").value = 'delete_f';
          const XHR = new XMLHttpRequest();
          const form = document.getElementById("form");
          const FD = new FormData(form);
          XHR.open("POST", "/home/prosesData");
          XHR.send(FD);
          location.replace("<?php echo base_url('/data'); ?>");
          // location.reload();
        } else {
          document.getElementById("ID").value = '';
          document.getElementById("InputAction").value = '';
        }
        
      });

      // Datepicker show setting
      $('#InputTanggal').datepicker({
        format: 'yyyy-mm-dd',
        locale: 'id'
      });

      
    });

    //script submit
    function mySimpan() {
      document.getElementById("InputAction").value = 'save';
    }

    function myUbah() {
      document.getElementById("InputAction").value = 'edit';
    }

    function myHapus() {
      if (confirm("Yakin akan menghapus data ini?")) {
        document.getElementById("InputAction").value = 'delete';
      } else {
        document.getElementById("ID").value = '';
        document.getElementById("InputAction").value = '';
      }
      
    }

    function myBatal(){
      document.getElementById("btnSimpan").disabled = false;
      document.getElementById("btnUbah").disabled = true;
      document.getElementById("btnHapus").disabled = true;
      const element = document.getElementById("top");
      element.scrollIntoView();
    }
  </script>
</head>

<body>
  <div class="container">

    <h2 id="top">Data Keluarga</h2>
    <p>Dibawah ini adalah data anggota keluarga:</p>
    </br>
    <div style="margin:0 0 0 0;max-height:300px;overflow-x:auto">
      <table class="table table-hover" id="tblKeluarga" style="border:1px solid;border-color:#f5f5f5">
        <thead>
          <tr class="info">
            <th>#</th>
            <th>Nama Lengkap</th>
            <th>Status</th>
            <th>Tgl Lahir</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $_totalrow = 0;

          foreach ($dt1 as $row) { //tampilkan per row 
          ?>
            <?php $_hmod = fmod($_totalrow + 1, 2); ?>
            <?php if ($_hmod < 1) { ?>
              <tr>
              <?php } else { ?>
              <tr>
              <?php } ?>

              <td><?php echo ($_totalrow + 1); ?></td>
              <td><?php echo $row->NAMA_LENGKAP; ?></td>
              <td><?php echo $row->STATUS; ?></td>
              <td><?php echo $row->TGL_LAHIR; ?></td>
              <td style="display:none;"><?php echo $row->ID; ?></td>
              <?php $_totalrow++ ?>
              <td>
                <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
              </td>
              </tr>

            <?php } ?>
        </tbody>
      </table>
    </div>

    <hr class="bg-dark opacity-1 m-0">
    <h3>Tambah Data</h3>
    <p>Lengkapi data sebelum menyimpan.</p>
    </br>

    <div id="panelInput" style="background-color:#f5f5f5;position:relative;width:100%;margin:0 0 20px 0;padding:20px">
      <form id="form" action="/home/prosesData" method="post">
        <div class="form-group row">
          <label for="labelNama" class="col-sm-2 col-form-label">Nama Lengkap</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="InputNama" name="InputNama" autocomplete="off" placeholder="Nama Lengkap" required>
            <small id="ketNama" class="form-text text-muted">Pastikan nama yg dimasukkan tidak salah.</small>
          </div>
        </div>
        <div class="form-group row">
          <label for="labelStatus" class="col-sm-2 col-form-label">Status</label>
          <div class="col-sm-10">
            <select id="InputStatus" name="InputStatus" class="form-control" autocomplete="off" required>
              <option value="" disabled selected>Pilih Status</option>
              <option>Suami</option>
              <option>Istri</option>
              <option>Anak</option>
              <option>Orang Tua</option>
              <option>Orang Lain</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="labelTanggal" class="col-sm-2 col-form-label">Tanggal Lahir</label>
          <div class="col-sm-10">
            <div class="form-group">
              <input type='text' class="form-control" id="InputTanggal" name="InputTanggal" autocomplete="off" placeholder="yyyy-mm-dd" required readonly>
            </div>
            <input type='hidden' class="form-control" id="ID" name="ID" value="" >
            <input type='hidden' class="form-control" id="InputAction" name="InputAction" value="" >
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-2">
            <span></span>
          </div>
          <div class="col-sm-10">
            <!--<button type="button" onclick="myFunction()" class="btn btn-primary">Simpan</button>-->
            <button type="submit" id="btnSimpan" onclick="mySimpan()" class="btn btn-primary">Simpan</button>
            <button type="submit" id="btnUbah" onclick="myUbah()" class="btn btn-warning" disabled>Ubah</button>
            <button type="submit" id="btnHapus" onclick="myHapus()" class="btn btn-danger" disabled>Hapus</button>
            <button type="reset" id="btnBatal" onclick="myBatal()" class="btn btn-info">Batal</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>