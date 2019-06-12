<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=barang.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

 <table>
            <tr>
            <td>kode_barang</td>
            <td>nama_barang</td>
            <td>stok</td>
            <td>harga</td>
            <td>harga_suplayer</td>
            <td>laba</td>
            <td>nama_suplayer</td>
            </tr><?php
            $barang_data = $this->db->get('barang');
            foreach ($barang_data->result() as $barang)
            {
                ?>
                <tr>
            <td><?php echo $barang->kode_barang ?></td>
            <td><?php echo $barang->nama_barang ?></td>
            <td><?php echo $barang->stok ?></td>
            <td><?php echo $barang->harga ?></td>
            <td><?php echo $barang->harga_suplayer ?></td>
            
            <td><?php echo $barang->laba ?></td>
            <td><?php echo $barang->nama_suplayer ?></td>
            
        </tr>
                <?php
            }
            ?>
        </table>