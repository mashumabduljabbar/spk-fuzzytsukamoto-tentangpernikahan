<?php
$uri3 = mysql_real_escape_string($this->uri->segment(3));
$uri4 = mysql_real_escape_string($this->uri->segment(4));
$uri5 = mysql_real_escape_string($this->uri->segment(5));
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
  <div class="alert alert-warning col-md-5">
      <table class="table table-bordered" style="margin-bottom: 0px">
        <tr><td width="30%">Nama Peserta</td><td width="70%">
		<?php  
		$siswa_query = mysql_fetch_array(mysql_query("SELECT * FROM m_siswa where id='$uri5'"));
		echo $siswa_query['nama'];
		?>
		</td></tr>
        <tr><td>Nama Pengajar</td><td>
		<?php  
		$guru_query = mysql_fetch_array(mysql_query("SELECT * FROM m_guru where id='$uri3'"));
		echo $guru_query['nama'];
		?>
		</td></tr>
        <tr><td>Mata Kuliah</td><td>
		<?php  
		$mapel_query = mysql_fetch_array(mysql_query("SELECT * FROM m_mapel where id='$uri4'"));
		echo $mapel_query['nama'];
		?>
		</td></tr>
        <tr><td>Jumlah Pernyataan</td><td>
		<?php  
		$angket_count = mysql_fetch_array(mysql_query("SELECT count(id) as countall FROM m_soal_angket where id_guru='$uri3' and id_mapel='$uri4'"));
		echo $angket_count['countall'];
		?>
		</td></tr>
      </table>
  </div>
  <div class="col-md-2"></div>

</div>

<div class="row col-md-12">
	<div class="panel panel-info">
    <div class="panel-heading">Form Angket</div>
    <div class="panel-body">
      <form method="post" action="<?php echo base_url().'adm/createPost';?>">
	  <input type="hidden" name="id_guru" value="<?php echo $uri3;?>">
	  <input type="hidden" name="id_mapel" value="<?php echo $uri4;?>">
	  <input type="hidden" name="id_user" value="<?php echo $uri5;?>">
	  <input type="hidden" name="jumlah_angket" value="<?php echo $angket_count['countall'];?>">
	  <table class="table table-bordered" style="margin-bottom: 0px">
	  <thead>
		<tr>
			<th width="2%">No</th>
			<th width="56%">Pernyataan</th>
			<th width="11%">Sangat Setuju</th>
			<th width="10%">Setuju</th>
			<th width="11%">Kurang Setuju</th>
			<th width="10%">Tidak setuju</th>
		</tr>
	  </thead>
	  <tbody>
			<?php
                $no = 1;
                $angket_query = mysql_query("SELECT * FROM m_soal_angket where id_guru='$uri3' and id_mapel='$uri4'");
				while($angket_data = mysql_fetch_array($angket_query)){?>
			<tr>
			  <td><?php echo $no;?></td>
			  <td><?php echo $angket_data['soal'];?><input type="hidden" name="id[]" value="<?php echo $angket_data['id'];?>"></td>
			  <td align="center"><input type="radio" name="jawaban<?php echo $angket_data['id'];?>" value="<?php echo $angket_data['opsi_a'];?>"></td>
			  <td align="center"><input type="radio" name="jawaban<?php echo $angket_data['id'];?>" value="<?php echo $angket_data['opsi_b'];?>"></td>
			  <td align="center"><input type="radio" name="jawaban<?php echo $angket_data['id'];?>" value="<?php echo $angket_data['opsi_c'];?>"></td>
			  <td align="center"><input type="radio" name="jawaban<?php echo $angket_data['id'];?>" value="<?php echo $angket_data['opsi_d'];?>"></td>
			</tr>
			<?php	
			$no++;
			}
            ?>       
	  </tbody>
	  </table>
	  <br>
      <button type="submit" class="action submit btn btn-success btn-sm">Submit Angket</button>
	  
      </form>
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

</body>
</html>
