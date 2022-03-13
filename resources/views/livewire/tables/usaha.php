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
                    <label for="ju">Jenis Usaha: </label>
                    <input type="text"class="form-control"
                        name="ju">
            </div>
            <div class="form-group">
                    <label for="au">Alamat Usaha: </label>
                    <input type="text"class="form-control"
                        name="au">
            </div>
            <div class="form-group">
                    <label for="tu">Tahun Usaha: </label>
                    <input type="date"class="form-control"
                        name="tu">
            </div>
            <button class="btn btn-sm btn-primary" type="submit">Edit</button>
            <button class="btn btn-sm btn-danger" type="submit">Delete</button>

<?php
require_once "footer.php";
?>