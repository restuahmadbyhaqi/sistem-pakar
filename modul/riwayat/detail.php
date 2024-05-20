<title>Detail</title>
<?php

if ($_GET['id']) {
  date_default_timezone_set("Asia/Jakarta");
  $inptanggal = date('Y-m-d H:i:s');

  $arbobot = array('0', '1', '0.8', '0.6', '0.4', '-0.2', '-0.4', '-0.6', '-0.8', '-1');
  $argejala = array();

  for ($i = 0; $i < count($_POST['kondisi']); $i++) {
    $arkondisi = explode("_", $_POST['kondisi'][$i]);
    if (strlen($_POST['kondisi'][$i]) > 1) {
      $argejala += array($arkondisi[0] => $arkondisi[1]);
    }
  }

  $sqlkondisi = mysql_query("SELECT * FROM kondisi order by id+0");
  while ($rkondisi = mysql_fetch_array($sqlkondisi)) {
    $arkondisitext[$rkondisi['id']] = $rkondisi['kondisi'];
  }

  $sqlpkt = mysql_query("SELECT * FROM penyakit order by kode_penyakit+0");
  while ($rpkt = mysql_fetch_array($sqlpkt)) {
    $arpkt[$rpkt['kode_penyakit']] = $rpkt['nama_penyakit'];
    $ardpkt[$rpkt['kode_penyakit']] = $rpkt['det_penyakit'];
    $arspkt[$rpkt['kode_penyakit']] = $rpkt['srn_penyakit'];
  }

  $sqlhasil = mysql_query("SELECT * FROM hasil where id_hasil=" . $_GET['id']);
  while ($rhasil = mysql_fetch_array($sqlhasil)) {
    $arpenyakit = unserialize($rhasil['penyakit']);
    $argejala = unserialize($rhasil['gejala']);
  }

  $np1 = 0;
  foreach ($arpenyakit as $key1 => $value1) {
    $np1++;
    $idpkt1[$np1] = $key1;
    $vlpkt1[$np1] = $value1;
  }


// --------------------- END -------------------------

  echo "<div class='content'>
	<h2 class='text text-primary'>Hasil Diagnosis &nbsp;&nbsp;</h2>
		  <hr><table class='table table-bordered table-striped diagnosa'> 
          <th width=8%>No</th>
          <th width=10%>Kode</th>
          <th>Gejala yang dialami (keluhan)</th>
          <th width=20%>Pilihan</th>
          </tr>";
  $ig = 0;
  foreach ($argejala as $key => $value) {
    $kondisi = $value;
    $ig++;
    $gejala = $key;
    $sql4 = mysql_query("SELECT * FROM gejala where kode_gejala = '$key'");
    $r4 = mysql_fetch_array($sql4);
    echo '<tr><td>' . $ig . '</td>';
    echo '<td>G' . str_pad($r4[kode_gejala], 3, '0', STR_PAD_LEFT) . '</td>';
    echo '<td><span class="hasil text text-primary">' . $r4[nama_gejala] . "</span></td>";
    echo '<td><span class="kondisipilih" style="color:' . $arcolor[$kondisi] . '">' . $arkondisitext[$kondisi] . "</span></td></tr>";
  }
  $np = 0;
  foreach ($arpenyakit as $key => $value) {
    $np++;
    $idpkt[$np] = $key;
    $nmpkt[$np] = $arpkt[$key];
    $vlpkt[$np] = $value;
  }

  echo "<div class='callout callout-default'>Jenis penyakit yang diderita adalah <b><h3 class='text text-success'>" . $nmpkt[1] . "</b> / " . round($vlpkt[1], 2) . " % (" . $vlpkt[1] . ")<br></h3>";
  echo "</div></div><div class='box box-info box-solid'><div class='box-header with-border'><h3 class='box-title'>Detail</h3></div><div class='box-body'><h4>";
  echo $ardpkt[$idpkt[1]];
  echo "</h4></div></div>
          <div class='box box-warning box-solid'><div class='box-header with-border'><h3 class='box-title'>Saran</h3></div><div class='box-body'><h4>";
  echo $arspkt[$idpkt[1]];
  echo "</h4></div></div>
          <div class='box box-danger box-solid'><div class='box-header with-border'><h3 class='box-title'>Kemungkinan lain:</h3></div><div class='box-body'><h4>";
  for ($ipl = 2; $ipl < count($idpkt); $ipl++) {
    echo " <h4><i class='fa fa-caret-square-o-right'></i> " . $nmpkt[$ipl] . "</b> / " . round($vlpkt[$ipl], 2) . " % (" . $vlpkt[$ipl] . ")<br></h4>";
  }
  echo "</div></div>
		  </div>";
}
?>