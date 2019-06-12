<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=tabungan.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

 <table >
            <tr>
        <th>No Santri</th>
        <th>Nama Santri</th>
        <th>Saldo</th>
        <th>Pengeluaran</th>
            </tr><?php
            $tabungan_data = $this->db->get('tabungan');
            foreach ($tabungan_data->result() as $tabungan)
            {
                ?>
                <tr>
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
        
        </tr>
                <?php
            }
            ?>
        </table>