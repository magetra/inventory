 <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Kode Barang <?php echo form_error('kode_barang') ?></label>
            <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang" value="<?php echo $kode_barang; ?>" readonly/>
        </div>
        <div class="form-group">
            <label for="varchar">Nama Suplayer <?php echo form_error('nama_barang') ?></label>
            <input type="text" class="form-control" name="nama_suplayer" id="nama_suplayer" placeholder="Nama Suplayer" value="<?php echo $nama_suplayer; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama Barang <?php echo form_error('nama_barang') ?></label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Stok <?php echo form_error('stok') ?></label>
            <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Harga Suplayer<?php echo form_error('harga_suplayer') ?></label>
            <input type="text" class="form-control" name="harga_suplayer" id="harga_suplayer" placeholder="Harga suplayer" value="<?php echo $harga_suplayer; ?>" />
        </div>

        <div class="form-group">
            <label for="int">Harga Jual<?php echo form_error('harga') ?></label>
            <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" />
        </div>
        <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('barang') ?>" class="btn btn-default">Cancel</a>
    </form>