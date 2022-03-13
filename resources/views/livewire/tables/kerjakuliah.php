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
                    <label for="jk">Jenis Kelamin: </label>
                   <select class="form-control" name="gender">
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                    </select>
            </div>
            <div class="form-group">
                    <label for="np">Nama Perusahaan: </label>
                    <input type="text"class="form-control"
                        name="np">
            </div>
            <div class="form-group">
                    <label for="jabatan">Jabatan: </label>
                    <input type="text"class="form-control"
                        name="jabatan">
            </div>
            <div class="form-group">
                    <label for="tk">Tahun Kerja: </label>
                    <input type="date"class="form-control"
                        name="tk">
            </div>
            <div class="form-group">
                    <label for="universitas">Universitas: </label>
                    <input type="text"class="form-control"
                        name="universitas">
            </div><div class="form-group">
                    <label for="Jurusan">Jurusan: </label>
                    <input type="text"class="form-control"
                        name="Jurusan">
            </div>
            <button class="btn btn-sm btn-primary" type="submit">Edit</button>
            <button class="btn btn-sm btn-danger" type="submit">Delete</button>

<?php
require_once "footer.php";
?>