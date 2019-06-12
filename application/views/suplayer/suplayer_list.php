<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('suplayer/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('suplayer/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('suplayer'); ?>" class="btn btn-default">Reset</a>
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
        <th>Nama Suplayer</th>
        <th>Jumlah Storan</th>
        <th>Tgl Penyetoran</th>
        <th>Jumlah Terjual</th>
        <th>Sisa Barang</th>
        <th>Nominal Uang</th>
        <th>Tgl Pengambilan</th>
        <th>Petugas</th>
        <th>Action</th>
            </tr><?php
            foreach ($suplayer_data as $suplayer)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $suplayer->kode_barang ?></td>
            <td><?php echo $suplayer->nama_suplayer ?></td>
            <td><?php echo $suplayer->jumlah_storan ?></td>
            <td><?php echo $suplayer->tgl_penyetoran ?></td>
            <td><?php echo $suplayer->jumlah_terjual ?></td>
            <td><?php echo $suplayer->sisa_barang ?></td>
            <td><?php echo $suplayer->nominal_uang ?></td>
            <td><?php echo $suplayer->tgl_pengambilan ?></td>
            <td><?php echo $suplayer->petugas ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                echo anchor(site_url('suplayer/update/'.$suplayer->id_suplayer),'Update'); 
                echo ' | '; 
                echo anchor(site_url('suplayer/delete/'.$suplayer->id_suplayer),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
                <a href="app/export_suplayer" target="_blank" class="btn btn-info">Export</a>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>