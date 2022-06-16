
<!DOCTYPE html>
<html lang="en">

<head>
  <title>yoyo Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/assets/bootstrap/3.4.1/css/bootstrap.css">
  <script src="/assets/ajax/libs/jquery/3.6.0/jquery.js"></script>
  <script src="/assets/bootstrap/3.4.1/js/bootstrap.js"></script>
  
  <style>
    a:link {
      text-decoration: none;
    }

    a:visited {
      text-decoration: none;
    }

    a:hover {
      text-decoration: none;
    }

    a:active {
      text-decoration: none;
    }

    div a{
      color:#333333;
      font-weight: bold;
    }

    li a{
      color:#333333;
      /* color: #E34724; */
      font-weight: bold;
    }
    .dropdown > a{
      color:#E34724;
    }

    
  </style>
</head>

<body>

  <div id="header-atas" style="background-color:#d9edf7;position:sticky;float:left;width:100%;height:70px;top:0;text-align:right;z-index:15;margin:0 0 20px 0">
    <div class="container" style="padding:10px">
      <nav class="navbar">
          <div class="navbar-header"><a class="navbar-brand" style="background: #d9edf7;border-style: none;" href=<?php echo base_url('/'); ?>>yoyo<code>Dashboard</code></a><button data-toggle="collapse" class="navbar-toggle collapsed" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></div>
              <div class="collapse navbar-collapse" id="navcol-1" style="background: #d9edf7;border-style: none;">
                  <ul class="nav navbar-nav navbar-right">
                      <li><a href=<?php echo base_url('/data'); ?>>Data Keluarga</a></li>
                      <li><a href=<?php echo base_url('/contact'); ?>>Contact</a></li>
                      <li><a href=<?php echo base_url('/about'); ?>>About</a></li>
                      <?php $arrNm = explode(" ",$_SESSION['nama_lengkap']); ?>
                      <?php if ($arrNm[0]=='') { ?>

                        <li class="dropdown"><a class="dropdown-toggle" aria-expanded="false" data-toggle="dropdown" href="#">Account <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                              <li><a href=<?php echo base_url('/home/prosesLogout'); ?>>Log Out</a></li>
                          </ul>
                        </li>

                      <?php } else { ?>

                        <li class="dropdown"><a class="dropdown-toggle" aria-expanded="false" data-toggle="dropdown" href="#">
                          <?php if (strlen($arrNm[0])<=2) { ?>
                            <?php echo $arrNm[0]; ?> <?php echo $arrNm[1]; ?>
                          <?php } else { ?>
                            <?php echo $arrNm[0]; ?>
                          <?php } ?>  
                          <span class="caret"></span></a>
                          
                          <ul class="dropdown-menu">
                            <?php if ($_SESSION['level']=='1') {?>
                              <li><a href="#">Users Manage</a></li>
                              <li><a href=<?php echo base_url('/home/prosesLogout'); ?>>Log Out</a></li>
                            <?php } else { ?>
                              <li><a href=<?php echo base_url('/home/prosesLogout'); ?>>Log Out</a></li>
                            <?php } ?>
                              
                          </ul>
                        </li>

                      <?php } ?>
                      
                  </ul>
              </div>
          </div>
      </nav>
    </div>
    
  </div>
  
</body>

</html>