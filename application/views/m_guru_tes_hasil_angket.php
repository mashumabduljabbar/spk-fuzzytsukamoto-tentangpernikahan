<div class="row col-md-12">
  <div class="panel panel-info">
    <div class="panel-heading">Daftar Hasil Angket
    </div>
    <div class="panel-body">


      <table class="table table-bordered">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th width="20%">Nama Siswa</th>
            <th width="25%">Nama Guru</th>
            <th width="20%">Mata Pelajaran</th>
            <th width="10%">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php 
		  $query_hasilangket = mysql_query("select * from tr_angket");
          while ($data_hasilangket= mysql_fetch_array($query_hasilangket)){
			  $query_data_siswa = mysql_fetch_array(mysql_query("select * from m_siswa where id='$data_hasilangket[id_user]'"));
			  $query_data_mapel = mysql_fetch_array(mysql_query("select * from m_mapel where id='$data_hasilangket[id_mapel]'"));
			  $query_data_guru = mysql_fetch_array(mysql_query("select * from m_guru where id='$data_hasilangket[id_guru]'"));
              $no = 1;
                echo '<tr>
                      <td class="ctr">'.$no.'</td>
                      <td>'.$query_data_siswa['nama'].'</td>
                      <td>'.$query_data_guru['nama'].'</td>
                      <td>'.$query_data_mapel['nama'].'</td>
                      <td class="ctr">
                        <div class="btn-group">
                          <a href="'.base_url().'adm/h_angket/det/'.$data_hasilangket['id'].'" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-search" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Lihat Hasil</a>
                        </div>
                      </td>
                      </tr>
                      ';
              $no++;
            }
          ?>
        </tbody>
      </table>
    
      </div>
    </div>
  </div>
</div>