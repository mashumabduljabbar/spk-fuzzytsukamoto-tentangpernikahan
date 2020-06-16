<?php 
$uri2 = $this->uri->segment(2);
$uri3 = $this->uri->segment(3);
?>

<div class="row col-md-12">
  <div class="panel panel-info">
    <div class="panel-heading">Data Soal Angket
      <div class="tombol-kanan">
        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#m_soal_angket_tambah"><i class="glyphicon glyphicon-plus" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Tambah Data</a>
      </div>
    </div>
    <div class="panel-body">
        
        <!-- accordion -->
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<?php 
		$_GET['mapel'] = "";
		$getmapel = $_GET['mapel']; ?>
		<select name="forma" onchange="var id_mapel = this.value; window.location.assign(base_url+'adm/m_soal_angket/'+id_mapel);" class='form-control col-md-12'>
			<option value=""><?php
			 $query_data_m_mapel = mysql_fetch_array(mysql_query("SELECT * FROM m_mapel where id='$getmapel'"));
			if ($getmapel==""){ echo "Pilih Mapel";}else{ echo $query_data_m_mapel['nama'];}
			?></option>
									 <?php 
									 $query_m_mapel = mysql_query("SELECT * FROM m_mapel");
									 while ($data_m_mapel = mysql_fetch_array($query_m_mapel)){
									 ?>
			<option value="<?php echo "$data_m_mapel[id]";?>"><?php echo $data_m_mapel['nama'];?></option>
									 <?php } ?>
		</select>
		<br>
		<!-- Modal Tambah -->
			<div><div class="modal fade" id="m_soal_angket_tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 id="myModalLabel">Tambah Data Angket</h4>
				  </div>
				  <div class="modal-body">
					  <form action="<?php echo base_url().'adm/createAngket';?>" method="post">
						<table class="table table-bordered">
						<tr><td>Pilih Mapel</td><td>:</td>
						<td>
						<select name="id_mapel" class='form-control col-md-12'>
							<?php $query_m_mapel = mysql_query("SELECT * FROM m_mapel");
							while ($data_m_mapel = mysql_fetch_array($query_m_mapel)){?>
							<option value="<?php echo "$data_m_mapel[id]";?>"><?php echo $data_m_mapel['nama'];?></option>
							<?php } ?>
						</select>
						</td></tr>
						<tr><td>Pernyataan</td><td>:</td>
						<td>
						<textarea class="form-control" name="soal"></textarea>
						</td></tr></table
				  </div>
				  <div class="modal-footer">
					<button class="btn btn-primary">Simpan</button>
					<button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
				  </div>
					</form>
				</div>
			  </div>
			</div>
			</div>
		<br>
		  <?php if($uri3!=""){?>
			<table class="table table-bordered">
			<thead>
			  <tr>
				<th width="5%">No</th>
				<th width="75%">Pernyataan</th>
				<th width="20%">Aksi</th>
			  </tr>
			</thead>
			<tbody>
			<?php 
			$no = 1;
			$query_m_soal_angket = mysql_query("select * from m_soal_angket where id_mapel='$uri3'");
			while($data = mysql_fetch_array($query_m_soal_angket)){
			?>
			<tr>
                      <td class="ctr"><?php echo $no;?></td>
                      <td><?php echo $data['soal'];?></td>
                      <td class="ctr">
                        <div class="btn-group">
                          <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#m_soal_angket<?php echo $data['id'];?>"><i class="glyphicon glyphicon-pencil" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Edit</a>
                          <a href="<?php echo base_url().'adm/deleteAngket/'.$data['id'].'/'.$uri3;?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a>
                </div>
                </td>
            </tr>
			<!-- Modal Ubah -->
			<div><div class="modal fade" id="m_soal_angket<?php echo $data['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 id="myModalLabel">Ubah Data Angket</h4>
				  </div>
				  <div class="modal-body">
					  <form action="<?php echo base_url().'adm/updateAngket';?>" method="post">
						<input type="hidden" name="id" value="<?php echo $data['id'];?>">
						<input type="hidden" name="mapel" value="<?php echo $uri3;?>">
							Pernyataan : <input type="text" class="form-control" name="soal" value="<?php echo $data['soal'];?>">
				  </div>
				  <div class="modal-footer">
					<button class="btn btn-primary">Simpan</button>
					<button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
				  </div>
					</form>
				</div>
			  </div>
			</div>
			</div>
			<?php $no++;}?>
			</tbody>
			</table>
		  <?php } ?>
		  <div class="alert alert-danger">Silakan pilih mata pelajaran.</div>

    </div>
  
  </div>
</div>
</div>



