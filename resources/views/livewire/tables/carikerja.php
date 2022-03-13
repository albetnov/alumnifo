<?php
require_once "header.php";
require_once "navbar.php";
require_once "topbar.php";

?>
            <div class="form-group">
                    <label for="nama">Nama: </label>
                    <input type="text"class="form-control"
                        name="nama">
            </div>
            <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email"class="form-control"
                        name="email">
            </div>
            <div class="form-group">
                    <label for="jk">Jenis Kelamin: </label>
                   <select class="form-control" name="gender">
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                    </select>
            </div>
            <div class="form-group">
                    <label for="alamat">Alamat: </label>
                    <input type="text"class="form-control"
                        name="alamat">
            </div>
            <div class="form-group">
                    <label for="ack">Alasan Cari Kerja: </label>
                    <input type="text"class="form-control"
                        name="ack">
            </div>
            <div class="form-group">
                    <label for="pyd">Pekerjaan yang Diminati: </label>
                    <input type="text"class="form-control"
                        name="pyd">
            </div>
            <button class="btn btn-sm btn-primary" type="submit">Edit</button>
            <button class="btn btn-sm btn-danger" type="submit">Delete</button>

<?php
require_once "footer.php";
?>