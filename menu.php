<?php
$module = $_GET['module'];
?>
<li><a <?php if ($module == "") echo 'class="active"'; ?> href="./"><i class="fa fa-home"></i> <span>Home</span></a><li>
  <div class="container"></div>
  <?php
  if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
      ?>
    <li><a <?php if ($module == "penyakit") echo 'class="active"'; ?> href="penyakit"><i class="fa fa-medkit"></i> <span>Penyakit</span></a><li>
      <div class="container"></div>	
    <li><a <?php if ($module == "gejala") echo 'class="active"'; ?> href="gejala"><i class="fa fa-eyedropper"></i> <span>Gejala</span></a><li>
      <div class="container"></div>
    <li><a <?php if ($module == "pengetahuan") echo 'class="active"'; ?> href="pengetahuan"><i class="fa fa-flask"></i> <span>Pengetahuan</span></a><li>
      <div class="container"></div>
      <div class="container"></div>
      <?php
  }else {
      ?>
    <li><a <?php if ($module == "diagnosa") echo 'class="active"'; ?> href="diagnosa"><i class="fa fa-search-plus"></i> <span>Mulai Diagnosa</span></a><li>
      <div class="container"></div>
    <li><a <?php if ($module == "riwayat") echo 'class="active"'; ?> href="riwayat"><i class="fa fa-clock-o"></i> <span>Riwayat Diagnosa</span></a><li>
      <div class="container"></div>
      <?php
  }
  ?>