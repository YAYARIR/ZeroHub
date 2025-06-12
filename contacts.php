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
	<title>Контакты | u-world.su</title>
	
    <meta name="keywords" content="скины, установка, майнкрафт, minecraft, tlauncher"/>
    <meta name="description" content="Хотите выделится на сервере? Тогда прочитайте наилучший гайд по установке скинов в Minecraft с помощью TLauncher"/>
	
	<link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	
	
	  <style>
   .text2 {
    font-family: Verdana, Arial, Helvetica, sans-serif; 
    font-size: 13pt; /* Размер шрифта в пунктах */ 
   }
  </style>
</head>
<body>
	  <!--Добавление меню с бд-->	
      <?php echo $content_menu;?>

<div class="content">
    <div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
      <h1 class="welcome"><i class="fas fa-address-book"></i> Контакты</h1>
    </div>
  </div>
  <div class="container">
    

      <div class="tab-content">
	<div class="text2">
	  

<p><b>Контакты администрации:</b></p>
<p>Для технических вопросов - <a class="arr" href="mailto:admin@scrollmine.net">admin@u-world.su</a></p>

<p>Для вопросов касаемых игры - <a class="arr" href="https://vk.com/miomoor">ссылка</a></p>
<p><b>ВНИМАНИЕ!</b><br>
	Эта почта исключительно по техническим вопросам, помощь и ответы на вопросы администрация отвечает только в группе ВК</p>
<p>Наша группа ВК для вопросов по игре - <a href="https://vk.com/universalworld" target="blank"><i class="fab fa-vk fa-2x"></i></a></p>
<p>Наш Discord сервер - <a href="https://discord.gg/Ubs6R2" target="blank"><i class="fab fa-discord fa-2x"></i></a></p>


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