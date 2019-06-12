<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('tabungan/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('tabungan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tabungan'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>No Pengguna</th>
        <th>Nama Pengguna</th>
        <th>Saldo</th>
        <th>Pengeluaran</th>
        
        <th>Action</th>
            </tr><?php
            foreach ($tabungan_data as $tabungan)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $tabungan->no_santri ?></td>
            <td><?php 
            $sql = $this->db->query("SELECT * FROM santri where no_santri='$tabungan->no_santri' ")->row();
            echo $sql->nama;
             ?></td>
            <td><?php
            $saldo_tambahan = 0; 
            $detail_tabungan = $this->db->query("SELECT * FROM detail_tabungan WHERE no_santri='$tabungan->no_santri'");
            foreach ($detail_tabungan->result() as $d) {
                $saldo_tambahan = $saldo_tambahan + $d->saldo_tambahan;
            }
            $total_saldo = $tabungan->saldo + $saldo_tambahan;
            echo number_format($total_saldo) ?></td>
            <td><?php echo number_format($tabungan->pengeluaran) ?></td>
            
            <td style="text-align:center" width="200px">
                <a href="app/cetak_saldo/<?php echo $tabungan->no_santri ?>" target="_blank">Cetak Saldo</a>
                <?php 
                //echo anchor(site_url('app/cetak_saldo/'.$tabungan->no_santri),'Cetak Saldo'); 
                echo ' | '; 
                echo anchor(site_url('tabungan/update/'.$tabungan->id_tabungan),'Update'); 
                echo ' | '; 
                echo anchor(site_url('tabungan/delete/'.$tabungan->id_tabungan),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                <a href="app/export_tabungan" target="_blank" class="btn btn-primary">Export</a>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>