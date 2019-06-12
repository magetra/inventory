<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('pengambilan_suplayer/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('pengambilan_suplayer/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pengambilan_suplayer'); ?>" class="btn btn-default">Reset</a>
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
        <th>Kode Barang</th>
        <th>Tgl Pengambilan</th>
        <th>Jumlah</th>
        <th>Sisa Barang</th>
        <th>Nominal Uang</th>
        <th>Petugas</th>
        <th>Action</th>
            </tr><?php
            foreach ($pengambilan_suplayer_data as $pengambilan_suplayer)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $pengambilan_suplayer->kode_barang ?></td>
            <td><?php echo $pengambilan_suplayer->tgl_pengambilan ?></td>
            <td><?php echo $pengambilan_suplayer->jumlah ?></td>
            <td><?php echo $pengambilan_suplayer->sisa_barang ?></td>
            <td><?php echo $pengambilan_suplayer->nominal_uang ?></td>
            <td><?php echo $pengambilan_suplayer->petugas ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                echo anchor(site_url('pengambilan_suplayer/read/'.$pengambilan_suplayer->id_pengambilan),'Cetak'); 
                echo ' | '; 
                echo anchor(site_url('pengambilan_suplayer/update/'.$pengambilan_suplayer->id_pengambilan),'Update'); 
                echo ' | '; 
                echo anchor(site_url('pengambilan_suplayer/delete/'.$pengambilan_suplayer->id_pengambilan),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
        <?php echo anchor(site_url('pengambilan_suplayer/excel'), 'Export', 'class="btn btn-primary"'); ?>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>