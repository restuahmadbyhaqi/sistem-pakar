<title>Diagnosa</title>

<head>
  <style>
    select {
    -webkit-appearance: none;
    -moz-appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding: 5px;
    border-radius: 0.4em;
    border: 1px solid #ddd;
  }

  select option {
    margin: 40px;
    color: #000;
    border: 1px solid #ddd;
  }



  select option[data-id="0"]{ /* data-id not val */
      color: #ffffff;
  }
  select:disabled {
      background-color: #cccccc;
  }

  #tombol {
    position:inherit;
  }

  tbody.pilihkondisi td.opsi{
      text-align:center; 
      vertical-align:middle;
  }

  tbody.pilihkondisi td,
  tbody.pilihkondisi td.gejala,
  tbody.pilihkondisi th{
      vertical-align:middle;
  }

  tbody.pilihkondisi th{
      text-align:center; 
      vertical-align:middle;
      background: #ecf0f1;

  }

  span.hasil{
      padding: 8px;
  }

  table.diagnosa th{
      background-color: #9b59b6;   
      color: #fff;
  }

  table.diagnosa {
      border: 2px solid #9b59b6;
  }

  table.table-bordered.diagnosa th{
      border: 1px solid #9b59b6;
  }
  table.table-bordered.diagnosa td {
      border: 1px solid #e9d5eb;
  }

  /*Konsultasi*/
  table.konsultasi th{
      background-color: #95afc0;   
      color: #fff;
  }

  table.konsultasi {
      border: 1px solid #95afc0;
  }

  table.table-bordered.konsultasi th{
      border: 1px solid #95afc0;
  }
  table.table-bordered.konsultasi td {
      border: 1px solid #c9d1d9;
  }

  /*Riwayat*/
  table.riwayat th{
      background-color: #22a6b3;   
      color: #fff;
  }

  table.riwayat {
      border: 1px solid #22a6b3;
  }

  table.table-bordered.riwayat th{
      border: 1px solid #22a6b3;
  }
  table.table-bordered.riwayat td {
      border: 1px solid #c9d1d9;
      vertical-align: middle;
  }


  span.kondisipilih {
      padding: 2px 4px;
      border-radius: 4px;
  }

  div.paging {
    margin-top: 25px;
  }

  .margin4 {
      margin: 4px;
  }

  img.post{
      
  }

  .well {
    overflow: hidden;
  }
  </style>
</head>
<?php
switch ($_GET['act']) {

  default:
    if ($_POST['submit']) {
      date_default_timezone_set("Asia/Jakarta");
      $inptanggal = date('Y-m-d H:i:s');

      $arbobot = array('1', '0.8', '0.6', '0.4', '0',);
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

      //print_r($arkondisitext);
// -------- perhitungan certainty factor (CF) ---------
// --------------------- START ------------------------
      $sqlpenyakit = mysql_query("SELECT * FROM penyakit order by kode_penyakit");
      $arpenyakit = array();
      while ($rpenyakit = mysql_fetch_array($sqlpenyakit)) {
        $cftotal_temp = 0;
        $cf = 0;
        $sqlgejala = mysql_query("SELECT * FROM basis_pengetahuan where kode_penyakit=$rpenyakit[kode_penyakit]");
        $cflama = 0;
        while ($rgejala = mysql_fetch_array($sqlgejala)) {
          $arkondisi = explode("_", $_POST['kondisi'][0]);
          $gejala = $arkondisi[0];

          for ($i = 0; $i < count($_POST['kondisi']); $i++) {
            $arkondisi = explode("_", $_POST['kondisi'][$i]);
            $gejala = $arkondisi[0];
            if ($rgejala['kode_gejala'] == $gejala) {
              $cf = ($rgejala['mb'] - $rgejala['md']) * $arbobot[$arkondisi[1]];
              if (($cf >= 0) && ($cf * $cflama >= 0)) {
                $cflama = $cflama + ($cf * (1 - $cflama));
              }
              if ($cf * $cflama < 0) {
                $cflama = ($cflama + $cf) / (1 - Math . Min(Math . abs($cflama), Math . abs($cf)));
              }
              if (($cf < 0) && ($cf * $cflama >= 0)) {
                $cflama = $cflama + ($cf * (1 + $cflama));
              }
            }
          }
        }
        if ($cflama > 0) {
          $arpenyakit += array($rpenyakit[kode_penyakit] => number_format($cflama, 4));
        }
      }

      arsort($arpenyakit);

      $inpgejala = serialize($argejala);
      $inppenyakit = serialize($arpenyakit);

      $np1 = 0;
      foreach ($arpenyakit as $key1 => $value1) {
        $np1++;
        $idpkt1[$np1] = $key1;
        $vlpkt1[$np1] = $value1;
      }

      mysql_query("INSERT INTO hasil(
                  tanggal,
                  gejala,
                  penyakit,
                  hasil_id,
                  hasil_nilai
				  ) 
	        VALUES(
                '$inptanggal',
                '$inpgejala',
                '$inppenyakit',
                '$idpkt1[1]',
                '$vlpkt1[1]'
				)");
// --------------------- END -------------------------

      echo "<div class='content'>
	<h2 class='text text-primary'>Hasil Diagnosis &nbsp;&nbsp; </h2>
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
        echo '<td><span class="kondisipilih" style=":' . $arcor[$kondisi] . '">' . $arkondisitext[$kondisi] . "</span></td></tr>";
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
    } else {
      echo "
	 <h2 class='text text-primary'>Diagnosa Penyakit</h2>  <hr>
	 <div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h4><i class='icon fa fa-exclamation-triangle'></i>Perhatian !</h4>
                Silahkan memilih gejala sesuai dengan apa yang anda rasakan, anda dapat memilih kepastian kondisi gejala dari pasti tidak sampai pasti ya, jika sudah tekan tombol proses (<i class='fa fa-search-plus'></i>)  di bawah untuk melihat hasil.
              </div>
		<form name=text_form method=POST action='diagnosa' >
           <table class='table table-bordered table-striped konsultasi'><tbody class='pilihkondisi'>
           <tr><th>No</th><th>Kode</th><th>Gejala</th><th width='20%'>Pilih Kondisi</th></tr>";

      $sql3 = mysql_query("SELECT * FROM gejala order by kode_gejala");
      $i = 0;
      while ($r3 = mysql_fetch_array($sql3)) {
        $i++;
        echo "<tr><td class=opsi>$i</td>";
        echo "<td class=opsi>G" . str_pad($r3[kode_gejala], 3, '0', STR_PAD_LEFT) . "</td>";
        echo "<td class=gejala>$r3[nama_gejala]</td>";
        echo '<td class="opsi"><select name="kondisi[]" id="sl' . $i . '" class="opsikondisi"/>';
        echo '<option data-id="0" value="0"> kejelasan gejala</option>';
        $s = "select * from kondisi order by id";
        $q = mysql_query($s) or die($s);
        while ($rw = mysql_fetch_array($q)) {
            ?>
            <option data-id="<?php echo $rw['id']; ?>" value="<?php echo $r3['kode_gejala'] . '_' . $rw['id']; ?>"><?php echo $rw['kondisi']; ?></option>
            <?php
        }
        echo '</select></td>';
        echo "</tr>";
        ?>
        <script type="text/javascript">
          $(document).ready(function () {
            set();
            $('.pilihkondisi').on('change', 'tr td select#sl<?php echo $i; ?>', function () {
              set();
            });
            function set()
            {
              var selectedItem = $('tr td select#sl<?php echo $i; ?> :selected');
              $('tr td select#sl<?php echo $i; ?>.opsikondisi').css('', );
      
            }
          });
        </script>
        <?php
        echo "</tr>";
      }
      echo "
		  <input class='float' type=submit data-toggle='tooltip' data-placement='top' title='Klik disini untuk melihat hasil diagnosa' name=submit value='&#xf00e;' style='font-family:Arial, FontAwesome'>
          </tbody></table></form>";
    }
    break;
}
?>
