<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=pengguna.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

 <table >
            <tr>
        <td>no_induk</td>
        <td>nama</td>
        <td>alamat</td>
        <td>tempat_lahir</td>
        <td>tanggal_lahir</td>
        <td>no_telp</td>
        <td>kelas</td>
        <td>unit_pendidikan</td>
            </tr><?php
            $santri_data = $this->db->get('santri');
            foreach ($santri_data->result() as $santri)
            {
                ?>
                <tr>
            <td><?php echo $santri->no_santri ?></td>
            <td><?php echo $santri->nama ?></td>
            <td><?php echo $santri->alamat ?></td>
            <td><?php echo $santri->tempat_lahir ?></td>
            <td><?php echo $santri->tanggal_lahir ?></td>
            <td><?php echo $santri->no_telp ?></td>
            <td><?php echo $santri->kelas ?></td>
            <td><?php echo $santri->unit_pendidikan ?></td>
        </tr>
                <?php
            }
            ?>
        </table>