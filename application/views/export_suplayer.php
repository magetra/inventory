<?php
 
 // header("Content-type: application/vnd-ms-excel");
 
 // header("Content-Disposition: attachment; filename=suplayer.xls");
 
 // header("Pragma: no-cache");
 
 // header("Expires: 0");
 
 ?>

<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
        <th>Kode Barang</th>
        <th>Nama Suplayer</th>
        <th>Jumlah Storan</th>
        <th>Tgl Penyetoran</th>
        <th>Jumlah Terjual</th>
        <th>Sisa Barang</th>
        <th>Nominal Uang</th>
        <th>Tgl Pengambilan</th>
        <th>Petugas</th>
            </tr><?php
            $suplayer_data = $this->db->get('suplayer');
            foreach ($suplayer_data->result() as $suplayer)
            {
                ?>
                <tr>
            <td><?php echo $suplayer->kode_barang ?></td>
            <td><?php echo $suplayer->nama_suplayer ?></td>
            <td><?php echo $suplayer->jumlah_storan ?></td>
            <td><?php echo $suplayer->tgl_penyetoran ?></td>
            <td><?php echo $suplayer->jumlah_terjual ?></td>
            <td><?php echo $suplayer->sisa_barang ?></td>
            <td><?php echo $suplayer->nominal_uang ?></td>
            <td><?php echo $suplayer->tgl_pengambilan ?></td>
            <td><?php echo $suplayer->petugas ?></td>
            
        </tr>
                <?php
            }
            ?>
        </table>