<div class="row col-md-12">
  <div class="panel panel-info">
    <div class="panel-heading">Tanya Jawab</div>
    <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="5%">No</th>
			  <?php if($sess_level== "siswa"){?>
              <th width="20%">Nama Guru</th>
			  <th width="20%">Mata Pelajaran</th>
			  <?php }elseif($sess_level== "guru"){?>
			  <th width="20%">Nama Siswa</th>
			  <th width="20%">Mata Pelajaran</th>
			  <?php }?>
              <th width="15%">Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php
                $no = 1;
                if($sess_level== "siswa"){
					$tanyajawab_query = mysql_query("SELECT * FROM tr_guru_mapel");
				}elseif($sess_level== "guru"){
					$tanyajawab_query = mysql_query("SELECT * FROM m_soal_tanya_jawab where id_guru='$_SESSION[sess_konid]'");
				}
				while($tanyajawab_data = mysql_fetch_array($tanyajawab_query)){?>
			<tr>
			  <td><?php echo $no;?></td>
			  <?php if($sess_level== "siswa"){?>
              <td><?php 
			  $namaguru = mysql_fetch_array(mysql_query("SELECT * FROM m_guru where id='$_SESSION[sess_konid]'"));
			  echo $namaguru['nama'];?></td>
              <td><?php 
			  $namamapel = mysql_fetch_array(mysql_query("SELECT * FROM m_mapel where id='$tanyajawab_data[id_mapel]'"));
			  echo $namamapel['nama'];?></td>
			  <?php }elseif($sess_level== "guru"){?>
			   <td><?php 
			  $namamasiswa = mysql_fetch_array(mysql_query("SELECT * FROM m_siswa where id='$tanyajawab_data[id_user]'"));
			  echo $namamasiswa['nama'];?></td>
              <td><?php echo $tanyajawab_data['soal'];?></td>
			  <?php }
			  $checknilai_query = mysql_fetch_array(mysql_query("SELECT nilai FROM tr_angket where id_guru='$tanyajawab_data[id_guru]' and id_mapel='$tanyajawab_data[id_mapel]' and id_user='$_SESSION[sess_konid]'"));
			  ?>
              <td>
			 <?php 
			 if($sess_level== "guru"){?>
				<a href='<?php echo base_url()."adm/ikut_tanya_jawab/$tanyajawab_data[id]/$tanyajawab_data[id_guru]/$tanyajawab_data[id_mapel]/$namamasiswa[id]";?>' target="_blank" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-user" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;
			  Jawab</a>
			  <?php
			  }elseif($sess_level== "siswa"){?>
				 <a href='<?php echo base_url()."adm/ikut_tanya_jawab/$tanyajawab_data[id_guru]/$tanyajawab_data[id_mapel]/$_SESSION[sess_konid]";?>' target="_blank" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-user" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;
			  Tanya</a>
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
