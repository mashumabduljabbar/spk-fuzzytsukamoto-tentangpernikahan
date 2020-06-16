<!DOCTYPE html>
<html>
<head>
<style> 
.flex-container {
    display: -webkit-flex;
    display: flex;  
    -webkit-flex-flow: row wrap;
    flex-flow: row wrap;
    text-align: center;
}

.flex-container > * {
    padding: 15px;
    -webkit-flex: 1 100%;
    flex: 1 100%;
}

.article {
    text-align: left;
}

header {background: black;color:white;}
footer {background: #aaa;color:white;}
.nav {background:#eee;}

.nav ul {
    list-style-type: none;
    padding: 0;
}
.nav ul a {
    text-decoration: none;
}

@media all and (min-width: 768px) {
    .nav {text-align:left;-webkit-flex: 1 auto;flex:1 auto;-webkit-order:1;order:1;}
    .article {-webkit-flex:5 0px;flex:5 0px;-webkit-order:2;order:2;}
    footer {-webkit-order:3;order:3;}
}
</style>
<link href="<?php echo base_url(); ?>___/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>___/css/style.css" rel="stylesheet">
<script>
var observe;
if (window.attachEvent) {
    observe = function (element, event, handler) {
        element.attachEvent('on'+event, handler);
    };
}
else {
    observe = function (element, event, handler) {
        element.addEventListener(event, handler, false);
    };
}
function init () {
    var text = document.getElementById('text');
    function resize () {
        text.style.height = 'auto';
        text.style.height = text.scrollHeight+'px';
    }
    /* 0-timeout to get the already changed text */
    function delayedResize () {
        window.setTimeout(resize, 0);
    }
    observe(text, 'change',  resize);
    observe(text, 'cut',     delayedResize);
    observe(text, 'paste',   delayedResize);
    observe(text, 'drop',    delayedResize);
    observe(text, 'keydown', delayedResize);

    text.focus();
    text.select();
    resize();
	
	
}
</script>
</head>
<body onload="init();">

<div class="flex-container" >
<header>
  <h1>Aplikasi Ujian Pernikahan Online</h1>
</header>

<nav class="nav">
<ul>
  <li><a href="<?php echo base_url(); ?>adm"><button class="button btn btn-warning btn-large col-lg-12 top15">HOME</button></a></li>
  <li><a href="<?php echo base_url(); ?>adm/guest"><button class="button btn btn-warning btn-large col-lg-12 top15">PERTANYAAN GUEST</button></a>
  <li><a href="<?php echo base_url(); ?>adm/hasilguest"><button class="button btn btn-warning btn-large col-lg-12 top15">HASIL PERTANYAAN GUEST</button></a>
  <li><a href="<?php echo base_url(); ?>adm/login" target="_blank"><button class="button btn btn-warning btn-large col-lg-12 top15">LOGIN</button></a></li>
</ul>
</nav>

<article class="article" style="min-height:500px;">
	<?php  
	$uri2 = mysql_real_escape_string($this->uri->segment(2));
	$uri3 = mysql_real_escape_string($this->uri->segment(3));
	$query_data_guest = mysql_fetch_array(mysql_query("Select * from tr_guest where userid_guest='$uri3'"));
	if($uri2 == "guest"){
	$IDGUEST = date("Ymdhms");	
		?>
	<form class="form-horizontal" action="createGuest" method="POST" enctype="multipart/form-data">
	<div class="col-lg-8">
		<div class="form-group">
			<label class="control-label col-lg-2">ID GUEST</label>
			<div class="col-lg-3">
				<input type="text" name="userid_guest" value="<?php echo $IDGUEST;?>" class="form-control" readonly />
			</div> [ <b style="color:red">PENTING</b> : ID GUEST akan digunakan untuk mengecheck jawaban di menu HASIL PERTANYAAN GUEST ]
		</div>
	</div>
	<div class="col-lg-8">
		<div class="form-group">
			<label class="control-label col-lg-2">Pertanyaan</label>
			<div class="col-lg-10">
				<textarea name="tanya_guest" placeholder="Pertanyaan" class="form-control" rows="4"></textarea>
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
	<?php
	}elseif($uri2 == "suksesguest"){
		echo "Pertanyaan Berhasil disubmit. USERID anda adalah : $uri3";
		echo "<br>";
		echo "Untuk melihat jawaban, silahkan masuk ke menu HASIL PERTANYAAN GUEST";
	}elseif($uri2 == "hasilguest"  and $uri3 == ""){?>
	<form class="form-horizontal" action="readGuest" method="POST" enctype="multipart/form-data">
		<div class="col-lg-8">
		<div class="form-group">
			<label class="control-label col-lg-2">ID GUEST</label>
			<div class="col-lg-5">
				<input type="text" name="userid_guest" placeholder="Masukkan USERID GUEST anda" class="form-control"  />
			</div></div>
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
	<?php 
	}elseif($uri2 == "hasilguest" and $uri3!=""){?>
	<form class="form-horizontal" enctype="multipart/form-data">
				<div class="col-lg-8">
				<div class="form-group">
					<label class="control-label col-lg-2">PERTANYAAN</label>
					<div class="col-lg-10">
						<textarea class="form-control" style="resize: vertical; overflow: auto; " rows="1" readonly>USERID : <?php echo $query_data_guest['userid_guest'];?> Pada <?php echo $query_data_guest['created_guest'];?></textarea>
						<textarea class="form-control" rows="4" style="resize: vertical; overflow: auto; " readonly><?php echo $query_data_guest['tanya_guest'];?></textarea>
						
					</div>
				</div>
				</div>
				<div class="col-lg-8">
				<div class="form-group">
					<label class="control-label col-lg-2">JAWABAN</label>
					<div class="col-lg-10">
						<textarea class="form-control" style="resize: vertical; overflow: auto; " rows="1" readonly>Penjawab : <?php echo $query_data_guest['penjawab_guest'];?> Pada <?php echo $query_data_guest['update_guest'];?></textarea>
						<textarea name="notelp_bloknomor[]" rows="4" class="form-control" style="height:1em;" id="text" readonly><?php echo $query_data_guest['jawab_guest'];?></textarea>
					</div>
				</div>
				</div>
	</form>
	<?php 
	}else{
		echo "Selamat Datang";
	}
	?>
</article>
<footer>Copyright &copy; 2018</footer>
</div>

</body>
</html>
