<?php 
$uri3 = mysql_real_escape_string($this->uri->segment(3));
$uri4 = mysql_real_escape_string($this->uri->segment(4));
$namaguru = mysql_fetch_array(mysql_query("SELECT * FROM m_guru where id='$_SESSION[sess_konid]'"));
?>
<div class="row col-md-12">
  <div class="panel panel-info">
    <div class="panel-heading">Tanya Jawab Guest</div>
	<?php if($uri3!="jawab_guest"){?>
    <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="5%">No</th>
			  <th width="30%">Soal</th>
			  <th width="30%">Jawaban</th>
			  <th width="20%">Penjawab</th>
              <th width="15%">Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php
                $no = 1;
                $tanyajawabguest_query = mysql_query("SELECT * FROM tr_guest");
				
				while($tanyajawabguest_data = mysql_fetch_array($tanyajawabguest_query)){?>
			<tr>
			  <td><?php echo $no;?></td>
			  <td><?php echo $tanyajawabguest_data['tanya_guest'];?></td>
			  <td><?php echo $tanyajawabguest_data['jawab_guest'];?></td>
			  <td>
			  <?php echo $tanyajawabguest_data['penjawab_guest']; ?></td>
			  <td>
			  <?php 
			 if($tanyajawabguest_data['jawab_guest']==""){?>
				<a href='<?php echo base_url()."adm/tanya_jawab_guest/jawab_guest/$tanyajawabguest_data[id_guest]";?>' class="btn btn-info btn-xs"><i class="glyphicon glyphicon-user" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;
			  Jawab</a>
			  <?php
			  }?>
			  </td>
			</tr>
			<?php	
			$no++;
			}
            ?>            
          </tbody>
        </table>

       </div>
    <?php }else{
		 $tanyajawabguest_query_data = mysql_fetch_array(mysql_query("SELECT * FROM tr_guest where id_guest='$uri4'"));
	?>
	<div class="panel-body">
		<form class="form-horizontal" action='<?php echo base_url()."adm/updateGuest";?>' method="POST" enctype="multipart/form-data">
		<input type="hidden" name="penjawab_guest" value="<?php echo $namaguru['nama'];?>">
		<input type="hidden" name="id_guest" value="<?php echo $tanyajawabguest_query_data['id_guest'];?>">
		<div class="col-lg-8">
			<div class="form-group">
				<label class="control-label col-lg-2">ID GUEST</label>
				<div class="col-lg-3">
					<input type="text" name="userid_guest" value="<?php echo $tanyajawabguest_query_data['userid_guest'];?>" class="form-control" readonly />
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="form-group">
				<label class="control-label col-lg-2">Pertanyaan</label>
				<div class="col-lg-10">
					<textarea class="form-control" style="resize: vertical; overflow: auto; " rows="4" readonly><?php echo $tanyajawabguest_query_data['tanya_guest'];?></textarea>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="form-group">
				<label class="control-label col-lg-2">Jawaban</label>
				<div class="col-lg-10">
					<textarea name="jawab_guest" placeholder="Jawaban" class="form-control" rows="4"></textarea>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<div class="form-group">
				<label class="control-label col-lg-2"></label>
				<div class="col-lg-10">
					<button class="btn btn-success"><i class="icon-arrow-right icon-white"></i> SUBMIT </button>
				</div>
			</div>
		</div>
		</form>
	</div>
	<?php } ?>
	</div>
  </div>
</div>
