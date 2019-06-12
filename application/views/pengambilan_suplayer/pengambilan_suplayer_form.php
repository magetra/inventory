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
            <label for="date">Tgl Pengambilan <?php echo form_error('tgl_pengambilan') ?></label>
            <input type="date" class="form-control" name="tgl_pengambilan" id="tgl_pengambilan" placeholder="Tgl Pengambilan" value="<?php echo $tgl_pengambilan; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Jumlah Terjual<?php echo form_error('jumlah') ?></label>
            <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" />
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
            <label for="varchar">Petugas <?php echo form_error('petugas') ?></label>
            <input type="text" class="form-control" name="petugas" id="petugas" placeholder="Petugas" value="<?php echo $this->session->userdata('nama'); ?>" />
        </div>
        <input type="hidden" name="id_pengambilan" value="<?php echo $id_pengambilan; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('pengambilan_suplayer') ?>" class="btn btn-default">Cancel</a>
    </form>

    <script type="text/javascript">
  $(document).ready(function(){
    $('#nama_barang').change(function() {
      var id = $(this).val();
      $.ajax({
        type : 'POST',
        url : '<?php echo base_url('app/cek_barang_suplayer') ?>',
        Cache : false,
        dataType: "json",
        data : 'kode_barang='+id,
        success : function(resp) {
            $('#jumlah').val(resp.terjual); 
            $('#sisa_barang').val(resp.stok); 
            $('#nominal_uang').val(resp.nominal); 
        }
      });
    });
    
  });
</script>