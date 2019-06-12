<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">No Induk <?php echo form_error('no_santri') ?></label>
            <input type="text" class="form-control" name="no_santri" id="no_santri" placeholder="No Santri" value="<?php echo $no_santri; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
        <div class="form-group">
            <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
        </div>
        <div class="form-group">
            <label for="varchar">Tempat Lahir <?php echo form_error('tempat_lahir') ?></label>
            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>" />
        </div>
        <div class="form-group">
            <label for="date">Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></label>
            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">No Telp <?php echo form_error('no_telp') ?></label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Kelas </label>
            <input type="text" class="form-control" name="kelas" id="kelas" placeholder="Kelas" value="<?php echo $kelas; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Unit Pendidikan </label>
            <!-- <input type="text" class="form-control" name="unit_pendidikan" id="unit_pendidikan" placeholder="No Telp" value="<?php echo $unit_pendidikan; ?>" /> -->
            <select class="form-control" name="unit">
                <option value="<?php echo $unit_pendidikan; ?>"><?php echo $unit_pendidikan; ?></option>
                <option value="KMA Al Wustho">KMA Al Wustho</option>
                <option value="KMI Al Wustho">KMI Al Wustho</option>
                <option value="KMA Al Ulya">KMA Al Ulya</option>
                <option value="SMK MH">SMK MH</option>
            </select>
        </div>
        <input type="hidden" name="id_santri" value="<?php echo $id_santri; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('santri') ?>" class="btn btn-default">Cancel</a>
    </form>