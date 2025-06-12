<?php
   include "lib/variables.php";
 ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<link rel="icon" type="image/png" href="img/server-icon.jpg" sizes="32x32">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>U-World.su| Instructions</title>
	<link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	  <!--Добавление меню с бд-->	
      <?php echo $content_menu;?>

  <div class="content">
    <div class="jumbotron jumbotron-fluid text-center">
      <div class="container">
        <h1 class="welcome"><i class="fas fa-bomb"></i> Гайды</h1>
       
      </div>
      </div>
    <div class="container">
    <div class="row">
    <div class="jumbotron">
      <h1 class="display-6">Установить скин на Майнкрафт</h1>
      <p class="lead">Гайд по установке скина на сервер</p>
      <hr class="my-6">
      <a class="btn btn-jumb btn-lg" href="ustanovka-skinov-minecraft.php" role="button">Подробнее <i class="fa fa-angle-right" aria-hidden="true"></i></a>
    </div>
        <div class="jumbotron">
      <h1 class="display-6">Установить плащ на Майнкрафт</h1>
      <p class="lead">Гайд по установке плаща на сайт</p>
      <hr class="my-6">
      <a class="btn btn-jumb btn-lg" href="ustanovka-plaja-minecraft.php" role="button">Подробнее <i class="fa fa-angle-right" aria-hidden="true"></i></a>
    </div>
    </div>
  </div>
  </div>
<footer class="footer"></footer>

<script src="js/jquery-2.2.0.min.js"></script>
<script src="js/bootstrap.js"></script>
<script>
  $("#myTabs a").click(function(e) {
    e.preventDefault();
    $(this).tab("show");
  });
</script>
<script src="js/common.js?v=1.1"></script>
<script type="text/javascript">
	var visible = false;
	$("#showPromo").click(function() {
		if (visible) {
	        document.getElementById('promoblock').style.display = 'none';
	        visible = false;
	    } else {
	        document.getElementById('promoblock').style.display = 'block';
	        visible = true;
	    }
	});
</script>
</body>
</html>