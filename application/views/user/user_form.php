<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">Nama Lengkap <?php echo form_error('nama_lengkap') ?></label>
            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Foto <?php echo form_error('foto') ?></label>
            <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" />
            <?php 
            if ($foto !== '') {
                ?>
                <div>
                    *) Gambar Sebelumnya <br>
                    <img src="image/user/<?php echo $foto ?>" style="width: 100px;height: 100px;">
                </div>
                <?php
            } else {
                #kosngs
            }
            ?>
        </div>
        <div class="form-group">
            <label for="varchar">Unit Kantor</label>
            <select class="form-control" name="unit">
                <option value="<?php echo $unit; ?>"><?php echo $unit; ?></option>
                <option value="Jakarta Pusat">Jakarta Pusat</option>
                <option value="Jakarta Barat">Jakarta Barat</option>
                <option value="Jakarta Utara">Jakarta Utara</option>
                <option value="Jakarta Timur">Jakarta Timur</option>
            </select>
        </div>

        <div class="form-group">
            <label for="varchar">Level <?php echo form_error('level') ?></label>
            <select class="form-control" name="level">
                <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
                <option value="admin">admin</option>
                <option value="kasir">kasir</option>
                <option value="tabungan">tabungan</option>
                <option value="pendidikan">pendidikan</option>
                <option value="suplayer">suplayer</option>
            </select>
        </div>
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('user') ?>" class="btn btn-default">Cancel</a>
    </form>