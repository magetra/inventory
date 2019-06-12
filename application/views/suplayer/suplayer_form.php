<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Kode Barang <?php echo form_error('kode_barang') ?></label>
            <!-- <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang" value="<?php echo $kode_barang; ?>" /> -->
            <br>
            <select id="nama_barang" name="nama_barang" class="selectpicker" class="form-control" data-live-search="true" >
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
            <label for="varchar">Nama Suplayer <?php echo form_error('nama_suplayer') ?></label>
            <input type="text" class="form-control" name="nama_suplayer" id="nama_suplayer" placeholder="Nama Suplayer" value="<?php echo $nama_suplayer; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Jumlah Storan <?php echo form_error('jumlah_storan') ?></label>
            <input type="text" class="form-control" name="jumlah_storan" id="jumlah_storan" placeholder="Jumlah Storan" value="<?php echo $jumlah_storan; ?>" />
        </div>
        <div class="form-group">
            <label for="date">Tgl Penyetoran <?php echo form_error('tgl_penyetoran') ?></label>
            <input type="date" class="form-control" name="tgl_penyetoran" id="tgl_penyetoran" placeholder="Tgl Penyetoran" value="<?php echo $tgl_penyetoran; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Jumlah Terjual <?php echo form_error('jumlah_terjual') ?></label>
            <input type="text" class="form-control" name="jumlah_terjual" id="jumlah_terjual" placeholder="Jumlah Terjual" value="<?php echo $jumlah_terjual; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Sisa Barang <?php echo form_error('sisa_barang') ?></label>
            <input type="text" class="form-control" name="sisa_barang" id="sisa_barang" placeholder="Sisa Barang" value="<?php echo $sisa_barang; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Nominal Uang <?php echo form_error('nominal_uang') ?></label>
            <input type="text" class="form-control" name="nominal_uang" id="nominal_uang" placeholder="Nominal Uang" value="<?php echo $nominal_uang; ?>" />
        </div>
        <div class="form-group">
            <label for="date">Tgl Pengambilan <?php echo form_error('tgl_pengambilan') ?></label>
            <input type="date" class="form-control" name="tgl_pengambilan" id="tgl_pengambilan" placeholder="Tgl Pengambilan" value="<?php echo $tgl_pengambilan; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Petugas <?php echo form_error('petugas') ?></label>
            <input type="text" class="form-control" name="petugas" id="petugas" placeholder="Petugas" value="<?php echo $this->session->userdata('nama') ?>" />
        </div>
        <input type="hidden" name="id_suplayer" value="<?php echo $id_suplayer; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('suplayer') ?>" class="btn btn-default">Cancel</a>
    </form>

<script type="text/javascript">
  $(document).ready(function(){
    $('#nama_barang').change(function() {
      var id = $(this).val();
      $.ajax({
        type : 'POST',
        url : '<?php echo base_url('app/cek_barang') ?>',
        Cache : false,
        dataType: "json",
        data : 'kode_barang='+id,
        success : function(resp) {
            $('#nama_suplayer').val(resp.nama_suplayer); 
        }
      });
    });
    
  });
</script>