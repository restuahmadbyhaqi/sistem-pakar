<title>Home</title>
<?php 
  $htgejala=mysql_query("SELECT count(*) as total from gejala");
	$dtgejala=mysql_fetch_assoc($htgejala); ?>
	<div class='row'>
        <div class='col-lg-3 col-xs-6'>
          <!-- small box -->
          <div class='small-box bg-aqua'>
            <div class='inner'>
              <h3> <?php echo $dtgejala["total"]; ?></h3>
              <p>Total Gejala</p>
            </div>
            <div class='icon'>
              <i class='ion ion-thermometer'></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
<?php 
	$htpenyakit=mysql_query("SELECT count(*) as total from penyakit");
	  $dtpenyakit=mysql_fetch_assoc($htpenyakit); ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3> <?php echo $dtpenyakit["total"]; ?></h3>

              <p>Total Penyakit</p>
            </div>
            <div class="icon">
              <i class="ion ion-medkit"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
<?php 
	$htpengetahuan=mysql_query("SELECT count(*) as total from basis_pengetahuan");
	  $dtpengetahuan=mysql_fetch_assoc($htpengetahuan); ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $dtpengetahuan["total"]; ?></h3>

              <p>Total Pengetahuan</p>
            </div>
            <div class="icon">
              <i class="ion ion-erlenmeyer-flask"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
<?php 
	$htadmin=mysql_query("SELECT count(*) as total from admin");
	  $dtadmin=mysql_fetch_assoc($htadmin); ?>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
             <h3> <?php echo $dtadmin["total"]; ?> </h3>
              <p>Admin</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>

      </div>
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="aset/banner/1.jpg" alt="First slide">
                    <div class="carousel-caption">
                    </div>
                  </div>
                  <div class="item">
                    <img src="aset/banner/3.jpg" alt="Second slide">
                    <div class="carousel-caption">
                    </div>
                  </div>
                </div> 
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
			  <br>