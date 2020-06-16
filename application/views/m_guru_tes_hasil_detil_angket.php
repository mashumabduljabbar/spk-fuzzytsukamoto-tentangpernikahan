<?php 
$uri4 = $this->uri->segment(4);
?>

<div class="row col-md-12">
  <div class="panel panel-info">
    <div class="panel-heading">Daftar Hasil Angket
     <div class="tombol-kanan">
      </div>
    </div>
    <div class="panel-body">

      <table class="table table-bordered">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th width="50%">Nama Guru</th>
            <th width="15%">Nilai Angket</th>
          </tr>
        </thead>

        <tbody>
          <?php 
            if (!empty($hasil)) {
              $no = 1;
              foreach ($hasil as $d) {
                echo '<tr>
                      <td class="ctr">'.$no.'</td>
                      <td>'.$d->nama.'</td>
                      <td class="ctr">'.$d->nilai.'</td>
                      </tr>
                      ';
              $no++;
              }
            } else {
              echo '<tr><td colspan="5">Belum ada data</td></tr>';
            }
          ?>
        </tbody>
      </table>
    
      </div>
    </div>
  </div>
</div>