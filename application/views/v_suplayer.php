<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Suplayer</th>
        <th>Nama Barang</th>
        <th>Stok</th>
        <th>Harga Suplayer</th>
        <th>Harga Jual</th>
        <th>Laba</th>
        
            </tr><?php
            $start=0;
            $barang_data = $this->db->get_where('barang', array('nama_suplayer'=>$this->session->userdata('username')));
            foreach ($barang_data->result() as $barang)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start; ?></td>
            <td><?php echo $barang->kode_barang ?></td>
            <td><?php echo $barang->nama_suplayer ?></td>
            <td><?php echo $barang->nama_barang ?></td>
            <td><?php echo $barang->stok ?></td>
            <td><?php echo $barang->harga_suplayer ?></td>
            <td><?php echo $barang->harga ?></td>
            <td><?php echo $barang->laba ?></td>

        </tr>
                <?php
            }
            ?>
        </table>