<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Kode Barang <?php echo form_error('kode_barang') ?></label>
            <!-- <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang" value="<?php echo $kode_barang; ?>" /> -->
            <br>
            <select id="nama_barang" name="kode_barang" class="selectpicker" class="form-control" data-live-search="true" >
            <option value="<?php echo $kode_barang; ?>"><?php echo $kode_barang; ?></option>
            <?php
            $sql = $this->db->get('barang');
            foreach ($sql->result() as $row) {
             ?>
            <option value="<?php echo $row->kode_barang ?>"><?php echo $row->kode_barang ?>-<?php echo $row->nama_barang ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
            <label for="date">Tgl Setoran <?php echo form_error('tgl_setoran') ?></label>
            <input type="date" class="form-control" name="tgl_setoran" id="tgl_setoran" placeholder="Tgl Setoran" value="<?php echo $tgl_setoran; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Jumlah Setoran<?php echo form_error('jumlah') ?></label>
            <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Petugas <?php echo form_error('petugas') ?></label>
            <input type="text" class="form-control" name="petugas" id="petugas" placeholder="Petugas" value="<?php echo $this->session->userdata('nama'); ?>" />
        </div>
        <input type="hidden" name="id_setoran" value="<?php echo $id_setoran; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('setoran_suplayer') ?>" class="btn btn-default">Cancel</a>
    </form>