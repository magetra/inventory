<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">No Induk <?php echo form_error('no_santri') ?></label>
            <!-- <input type="text" class="form-control" name="no_santri" id="no_santri" placeholder="No Santri" value="<?php echo $no_santri; ?>" /> -->
            <br>
          <select id="no_santri" name="no_santri" class="selectpicker" class="form-control" data-live-search="true" autofocus>
            <?php 
            $this->db->order_by('id_santri','desc');
            $sql = $this->db->get('santri');
            foreach ($sql->result() as $row) {
             ?>
            <option value="<?php echo $no_santri; ?>"><?php echo $no_santri; ?></option>
            <option value="<?php echo $row->no_santri ?>"><?php echo $row->no_santri.' - '.$row->nama ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
            <label for="int">Saldo <?php echo form_error('saldo') ?></label>
            <input type="text" class="form-control" name="saldo" id="saldo" placeholder="Saldo" value="<?php echo $saldo; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Pengeluaran <?php echo form_error('pengeluaran') ?></label>
            <input type="text" class="form-control" name="pengeluaran" id="pengeluaran" placeholder="0" value="<?php echo $pengeluaran; ?>" readonly/>
        </div>
        
        <input type="hidden" name="id_tabungan" value="<?php echo $id_tabungan; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('tabungan') ?>" class="btn btn-default">Cancel</a>
    </form>