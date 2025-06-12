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
	<title>Установка плаща в Майнкрафт используя TLauncher</title>
	
    <meta name="keywords" content="установка, плащи, майнкрафт, minecraft, tlauncher"/>
    <meta name="description" content="Возможность установить плащи в Minecraft появилась благодаря TLauncher, в этой статье инструкция по установке!"/>
	
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
      <h1 class="welcome">Установка плаща в Майнкрафт используя TLauncher</h1>
    </div>
  </div>
  <div class="container">
    

      <div class="tab-content">
	<div class="text2">
	  
<p>Как стать крайне популярным и заметным на сервере? Если скин например уже стоит.. Самый отличный вариант, это <strong>установить в свой Майнкрафт плащ!</strong> Мы сомневаемся, что на сервере много людей с ним, вы наверное вообще их не видели! Ведь даже с лицензии его не поставить! Но только для вас, мы подготовили способ установки, который доступен каждому, конечно же, его будут видеть все на сервере!!!</p>

<p>Если до сих пор не установили собственный скин, читайте соответствующий <a href="/ustanovka-skinov-minecraft.html" target="_blank">гайд по установке скинов</a> у нас на сайте.</p>

<p>Нужно понимать, что плащи это такая фишка, которая должна оставаться желанной и актуальной всегда, поэтому чтобы его поставить, вам нужен <a href="https://tlauncher.org/ru/premium.html" target="_blank">TLauncher Premium</a>! Почитать можно про него на официальном сайте. Помимо плаща, этот премиум даёт очень много других плюшек, которые могут облегчить жизнь и выделить вас на сервере: отключение любой рекламы и установка HD скинов. Цена вполне адекватна за такие функции, учитывая что все игроки видят плащи и HD скины.</p>
<p>Если же вы его подключили (Понятно, нужно пройти <a rel="nofollow" href="https://tlauncher.org/ru/reg/" target="_blank">регистрацию на tlauncher.org</a> и приобрести премиум), приступайте к его установке.</p>
<p><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/profile-tlauncher.png" title="Профиль на сайте TLauncher" alt="Профиль на сайте TLauncher" width="750" height="350" /></p>
<p>В профиле ищем кнопку "Загрузить плащ" и указываем с компьютера файл плаща. Размер его должен быть 64x32, но можно и больше - то есть, можно и <strong>HD плащ установить в TLauncher</strong>! В каталоге можете найти готовые, если не хотите искать сами.</p>
<p><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/catalog-capes-tlauncher.png" title="Каталог плащей на сайте TLauncher" alt="Каталог плащей на сайте TLauncher" width="750" height="350" /></p>
<p>Как только загрузите или укажите из каталога, в профиле ваш персонаж получит плащ и вы сможете увидеть как он смотрится.</p>
<p><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/profile-tlauncher-cape.png" title="Профиль с плащом на сайте TLauncher" alt="Профиль с плащом на сайте TLauncher" width="750" height="350" /></p>
<p>Теперь через TLauncher (Если нету, то скачиваем с <a href="https://tlauncher.org" target="_blank">официального сайта</a>) авторизовываемся под своим аккаунтом, если не сделали это раньше, и запускаем версию с иконкой TL.</p>
<p><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/install-tl-versions-2.0.png" title="Установка версии с иконкой TL в TLauncher" alt="Установка версии с иконкой TL в TLauncher" /></p>
<p>Плащ уже должен быть на вашем персонаже! Поздравляем!</p>
<p><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/example-cape-minecraft.jpg" title="Пример плаща с помощью TLauncher" alt="Пример плаща с помощью TLauncher" /></p>
	  
	  
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