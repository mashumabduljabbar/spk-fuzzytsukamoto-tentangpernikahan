<?php
$sess_level = $this->session->userdata('admin_level');
$uri3 = mysql_real_escape_string($this->uri->segment(3));
$uri4 = mysql_real_escape_string($this->uri->segment(4));
$uri5 = mysql_real_escape_string($this->uri->segment(5));
$uri6 = mysql_real_escape_string($this->uri->segment(6));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dashboard - Aplikasi Ujian Pernikahan Online</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="<?php echo base_url(); ?>___/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>___/css/style.css" rel="stylesheet">
<!--<link href="<?php echo base_url(); ?>___/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>___/css/font-awesome.css" rel="stylesheet">
<!--<link href="<?php echo base_url(); ?>___/css/style.css" rel="stylesheet">-->
<!--<link href="<?php echo base_url(); ?>___/css/pages/dashboard.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

<nav class="navbar navbar-findcond navbar-fixed-top">
    <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">Aplikasi Ujian Pernikahan Online</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $this->session->userdata('admin_nama')." (".$this->session->userdata('admin_user').")"; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#" onclick="return rubah_password();">Ubah Password</a></li>
            <li><a href="<?php echo base_url(); ?>adm/logout" onclick="return confirm('keluar..?');">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container" style="margin-top: 70px">

<div class="col-lg-12 row">
  <div class="alert alert-warning col-md-6">
      <table class="table table-bordered" style="margin-bottom: 0px">
        <?php if($sess_level == "siswa"){?>
		<tr><td>Nama Pengajar</td><td>
		<?php  
		$guru_query = mysql_fetch_array(mysql_query("SELECT * FROM m_guru where id='$uri3'"));
		echo $guru_query['nama'];
		?>
		</td></tr>
		<?php }elseif($sess_level == "guru"){?>
		<tr><td>Nama Siswa</td><td>
		<?php  
		$guru_query = mysql_fetch_array(mysql_query("SELECT * FROM m_siswa where id='$uri6'"));
		echo $guru_query['nama'];
		?>
		</td></tr>
		<?php }?>
      </table>
  </div>
  <div class="alert alert-warning col-md-6">
      <table class="table table-bordered" style="margin-bottom: 0px">
        <tr><td>Mata Kuliah</td><td>
		<?php  
		if($sess_level == "siswa"){
			$mapel_query = mysql_fetch_array(mysql_query("SELECT * FROM m_mapel where id='$uri4'"));
		}elseif($sess_level == "guru"){
			$mapel_query = mysql_fetch_array(mysql_query("SELECT * FROM m_mapel where id='$uri5'"));
		}
		echo $mapel_query['nama'];
		?>
		</td></tr>
      </table>
  </div>
  <div class="col-md-2"></div>

</div>

<div class="row col-md-12">
	<div class="panel panel-info">
    <div class="panel-heading">Form Tanya Jawab</div>
    <div class="panel-body">
	  <table class="table table-bordered" style="margin-bottom: 0px">
	  <thead>
		<tr>
			<th width="1%">No</th>
			<th width="36%">Pertanyaan</th>
			<th width="46%">Jawaban</th>
			<th width="17%">Aksi</th>
		</tr>
	  </thead>
	  <tbody>
			<?php
                $no = 1;
				if($sess_level == "siswa"){
					$tanyajawab__query = mysql_query("SELECT * FROM m_soal_tanya_jawab where id_guru='$uri3' and id_mapel='$uri4' and id_user='$uri5'");
				}elseif($sess_level == "guru"){
					$tanyajawab__query = mysql_query("SELECT * FROM m_soal_tanya_jawab where id='$uri3' and id_guru='$uri4' and id_mapel='$uri5' and id_user='$uri6'");
				}
				while($tanyajawab_data = mysql_fetch_array($tanyajawab__query)){?>
			<tr>
			  <td><?php echo $no;?></td>
			  <td><?php echo $tanyajawab_data['soal'];?></td>
			  <td align="center"><?php echo $tanyajawab_data['jawaban'];?></td>
			  <td><?php if($sess_level == "siswa" and $tanyajawab_data['jawaban']==""){?>
			  <a href='<?php echo base_url()."adm/deleteTanyajawab/$tanyajawab_data[id]/$uri3/$uri4/$uri5";?>' class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Hapus</a><?php } ?>
			  <?php if($sess_level == "guru" and $tanyajawab_data['jawaban']==""){?>
			  <a data-toggle="modal" data-target="#m_soal_tanyajawab_jawaban" data-id="<?php echo $tanyajawab_data['soal'];?>" class="open-AddBookDialog btn btn-info btn-xs" href="#addBookDialog"><i class="glyphicon glyphicon-volume-up" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Jawab</a><?php } ?>
			  </td>		
			</tr>
			<?php	
			$no++;
			}
            ?>       
	  </tbody>
	  </table>
	  <br>
	  <?php if($sess_level == "siswa"){?>
      <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#m_soal_tanyajawab_tambah"><i class="glyphicon glyphicon-plus" style="margin-left: 0px; color: #fff"></i> &nbsp;&nbsp;Tambah Pertanyaan</a>
	  <?php }?>
	  <!-- Modal Tambah Pertanyaan-->
			<div><div class="modal fade" id="m_soal_tanyajawab_tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 id="myModalLabel">Tambah Pertanyaan</h4>
				  </div>
				  <div class="modal-body">
					  <form action="<?php echo base_url().'adm/createTanyajawab';?>" method="post">
					   <input type="hidden" name="id_guru" value="<?php echo $uri3;?>">
					  <input type="hidden" name="id_mapel" value="<?php echo $uri4;?>">
					  <input type="hidden" name="id_user" value="<?php echo $uri5;?>">
						<table class="table table-bordered">
						<tr><td>Pertanyaan</td><td>:</td>
						<td>
						<textarea class="form-control" name="soal"></textarea>
						</td></tr></table>
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
    
	<!-- Modal Tambah Jawaban-->
			<div><div class="modal fade" id="m_soal_tanyajawab_jawaban" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 id="myModalLabel">Tambah Jawaban</h4>
				  </div>
				  <div class="modal-body">
					  <form action="<?php echo base_url().'adm/updateTanyajawab';?>" method="post">
					  
					  <input type="hidden" name="id_soal" value="<?php echo $uri3;?>">
					   <input type="hidden" name="id_guru" value="<?php echo $uri4;?>">
					  <input type="hidden" name="id_mapel" value="<?php echo $uri5;?>">
					  <input type="hidden" name="id_user" value="<?php echo $uri6;?>">
						<table class="table table-bordered">
						<tr><td>Soal</td><td>:</td>
						<td>
						<textarea class="form-control" id="soal"></textarea>
						</td></tr>
						<tr><td>Jawaban</td><td>:</td>
						<td>
						<textarea class="form-control" name="jawaban"></textarea>
						</td></tr></table>
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
    
	</div>
    </div>
</div>

<div class="col-md-12" style="border-top: solid 1px #eee; padding-top: 10px; margin-top: 50px; margin-bottom: 20px">
  <div class="span12"> &copy; 2018 <a href="<?php echo base_url(); ?>adm">Aplikasi Ujian Pernikahan Online</a>. </div>
</div>




<script src="<?php echo base_url(); ?>___/js/jquery-1.11.3.min.js"></script> 
<script src="<?php echo base_url(); ?>___/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>___/js/jquery.countdown.min.js"></script> 
<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url(); ?>___/js/aplikasi.js"></script> 
<script type="text/javascript">
$(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     $(".modal-body #soal").val( myBookId );
});
</script>
</body>
</html>
