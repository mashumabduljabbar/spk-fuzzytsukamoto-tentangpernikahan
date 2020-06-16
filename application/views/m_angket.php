<div class="row col-md-12">
  <div class="panel panel-info">
    <div class="panel-heading">Daftar Angket</div>
    <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th width="20%">Nama Guru</th>
              <th width="20%">Mata Pelajaran</th>
              <th width="10%">Nilai</th>
              <th width="15%">Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php
                $no = 1;
                $angket_query = mysql_query("SELECT * FROM m_soal_angket where id_mapel IN(SELECT id_mapel FROM tr_siswa_mapel where id_siswa='$_SESSION[sess_konid]') group by id_mapel");
				while($angket_data = mysql_fetch_array($angket_query)){?>
			<tr>
			  <td><?php echo $no;?></td>
              <td><?php 
			  $namaguru = mysql_fetch_array(mysql_query("SELECT * FROM m_guru where id='$angket_data[id_guru]'"));
			  echo $namaguru['nama'];?></td>
              <td><?php 
			  $namamapel = mysql_fetch_array(mysql_query("SELECT * FROM m_mapel where id='$angket_data[id_mapel]'"));
			  echo $namamapel['nama'];?></td>
              <?php
			  $checkangket_query = mysql_fetch_array(mysql_query("SELECT count(*) as countall FROM tr_angket where id_guru='$angket_data[id_guru]' and id_mapel='$angket_data[id_mapel]' and id_user='$_SESSION[sess_konid]'"));
			  
			   $checknilai_query = mysql_fetch_array(mysql_query("SELECT nilai FROM tr_angket where id_guru='$angket_data[id_guru]' and id_mapel='$angket_data[id_mapel]' and id_user='$_SESSION[sess_konid]'"));
			  ?>
			  <td><?php echo $checknilai_query['nilai']; ?></td>
              <td>
			  <?php 
			  if($checkangket_query['countall']=="0"){?>
			  <a href="<?php echo base_url().'adm/ikut_angket/'.$angket_data['id_guru'].'/'.$angket_data['id_mapel'].'/'.$_SESSION['sess_konid'];?>" target="_blank" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Ikuti Angket</a>
			  <?php }else{ ?>
				<a href="<?php base_url().'adm/sudah_selesai_angket/'?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-ok" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Anda sudah ikut</a>  
			  <?php }?>
			  </td>		
			</tr>
			<?php	
			$no++;
			}
            ?>            
          </tbody>
        </table>

       </div>
    </div>
  </div>
</div>
