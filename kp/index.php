<?php 
include 'config.php';
?>
  
<form action="index.php" method="get">
	<label>Cari :</label>
	<input type="text" name="cari">
	<input type="submit" value="Cari">
</form>
 
<?php 
if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
	echo "<b>Hasil pencarian : ".$cari."</b>";
}
?>
 
<html lang="en">
<head>
  <title>Kerja Praktek</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
		<div class = "row">
			<div class = "col-sm-6">
				<table class = "table table-hover">
					<thead>
						<tr>
							<td>No</td>
							<td>Judul</th>
							<td>Pembimbing</td>
							<td>Tahun</td>
							<td>Keterangan</td>
						</tr>
					</thead>
					<?php 
					if(isset($_GET['cari'])){
						$cari = $_GET['cari'];
						$data = mysql_query("
							SELECT pa.*, 
                                dpem1.nama as namapem1, dpem2.nama as namapem2, 
                                dpu1.nama as namauji1, dpu2.nama as namauji2, dpu3.nama as namauji3,
                                m1.nama as namamhs1, m2.nama as namamhs2, m3.nama as namamhs3
                            FROM proyekakhir AS pa
                            INNER JOIN dosen AS dpem1
                                ON pa.pemb1 = dpem1.kode
                            INNER JOIN dosen AS dpem2
                                ON pa.pemb2 = dpem2.kode

                            INNER JOIN dosen AS dpu1
                                ON 	pa.penguji1 = dpu1.kode
                            INNER JOIN dosen AS dpu2
                                ON 	pa.penguji2 = dpu2.kode
                            INNER JOIN dosen AS dpu3
                                ON 	pa.penguji3 = dpu3.kode

                            INNER JOIN mhs AS m1
                                ON 	pa.mhs1 = m1.nim
                            INNER JOIN mhs AS m2
                                ON 	pa.mhs2 = m2.nim
                            INNER JOIN mhs AS m3
                                ON 	pa.mhs3 = m3.nim
							where dpem1.nama like '%".$cari."%'
                                    or dpem2.nama like '%".$cari."%'
									or judul_indo like '%".$cari."%'
									or tahun like '%".$cari."%'");					
					}	else {
						$data = mysql_query("SELECT pa.*, 
                                dpem1.nama as namapem1, dpem2.nama as namapem2, 
                                dpu1.nama as namauji1, dpu2.nama as namauji2, dpu3.nama as namauji3,
                                m1.nama as namamhs1, m2.nama as namamhs2, m3.nama as namamhs3
                            FROM proyekakhir AS pa
                            INNER JOIN dosen AS dpem1
                                ON pa.pemb1 = dpem1.kode
                            INNER JOIN dosen AS dpem2
                                ON pa.pemb2 = dpem2.kode

                            INNER JOIN dosen AS dpu1
                                ON 	pa.penguji1 = dpu1.kode
                            INNER JOIN dosen AS dpu2
                                ON 	pa.penguji2 = dpu2.kode
                            INNER JOIN dosen AS dpu3
                                ON 	pa.penguji3 = dpu3.kode

                            INNER JOIN mhs AS m1
                                ON 	pa.mhs1 = m1.nim
                            INNER JOIN mhs AS m2
                                ON 	pa.mhs2 = m2.nim
                            INNER JOIN mhs AS m3
                                ON 	pa.mhs3 = m3.nim");		
					}
					$no = 1;
					while($d = mysql_fetch_array($data)){
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $d['judul_indo']; ?> (<?php echo $d['deskripsi']; ?>)</td>	
						<td><?php echo $d['namapem1']." & ".$d['namapem2']; ?></td>		
						<td><?php echo $d['tahun']; ?></td>	
						<td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#<?php echo $d['id'];?>">View</button></td>						
					</tr>
					<div class="modal fade" id="<?php echo $d['id'];?>" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Keterangan</h4>									
								</div>
								<div class="modal-body">	
									<div>Mahasiswa 1 :	<?php echo $d['namamhs1'];?></div>
									<div>Mahasiswa 2 :	<?php echo $d['namamhs2'];?></div>
									<div>Mahasiswa 3 :	<?php echo $d['namamhs3'];?></div>
									<div>Judul Indo :	<?php echo $d['judul_indo']; ?> (<?php echo $d['deskripsi']; ?>)</div>
									<div>Judul Inggris :	<?php echo $d['judul_inggris']; ?> (<?php echo $d['deskripsi']; ?>)</div>
									<div>Penguji 1 :	<?php echo $d['namauji1']; ?></div>
									<div>Penguji 2 :	<?php echo $d['namauji2']; ?></div>
									<div>Penguji 3 :	<?php echo $d['namauji3']; ?></div>
									<div>Platform :	<?php echo $d['platform']; ?></div>
									<div>Genre :	<?php echo $d['genre']; ?></div>
									<div>AR/VR :	<?php echo $d['ARVR']; ?></div>
								</div>
								<div class="modal-footer">
								  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<?php 
						} 
					?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>