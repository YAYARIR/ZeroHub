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
	<title>Установка скинов в Майнкрафт используя TLauncher</title>
	
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
          <h1 class="welcome">Установка скинов в Майнкрафт используя TLauncher</h1>
      </div>
    </div>
  <div class="container">
    

      <div class="tab-content">
	<div class="text2">
	  
<p>На некоторых серверах может играть очень много людей и поэтому среди толпы трудно отличить одного игрока от другого, поэтому скины остаются актуальны, в этой статье вы узнаете самый простой и быстрый способ его установки в ваш Minecraft. Конечно же, мы предлагаем эту функцию абсолютно бесплатно, в отличии от то же лицензии, которую нужно покупать. Поэтому <strong>установить скин на Майнкрафт</strong> так просто!</p>

<p>Первое, что необходимо нам сделать, так это пройти <a href="https://tlauncher.org/ru/reg/" rel="nofollow" target="_blank">регистрацию на сайте</a> проекта, предоставляющего возможность установки скина: </p>
<p><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/reg-tlauncher.png" title="Регистрация на сайте TLauncher" alt="Регистрация на сайте TLauncher" width="750" height="350" /></p>
<p>По нажатию на кнопку "Регистрация" вы попадёте на страницу своего профиля, в котором вам нужно выставить свой собственный скин (Используя кнопку "Загрузить скин") или взять из Каталога.</p>
<p><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/profile-tlauncher.png" title="Профиль на сайте TLauncher" alt="Профиль на сайте TLauncher" width="750" height="350" /></p>
<p>Запускаем TLauncher (Если отсутствует, то <a href="https://tlauncher.org/" target="_blank">скачать TLauncher</a> можно с официального сайта) и выставляем галочку возле надписи "Аккаунт".</p>
<p><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/check-account-tlauncher-2.0.png" title="Чекбокс аккаунты в TLauncher" alt="Чекбокс аккаунты в TLauncher" /></p>
<p>В выпадающем меню нажимаем на "Настройки аккаунтов" и попадаем на страницу авторизации, смотрим чтобы галочка стояла возле "Аккаунт TLauncher" и вводим ваш логин и пароль, который вы использовали при регистрации недавно.</p>
<p>Нажимаем  "Сохранить аккаунт", и если авторизация прошла успешна, то аккаунт появится в списке (Если же нет, появится соответствующая ошибка).</p>
<p><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/account-list-tl.jpg" title="Список аккаунтов TLauncher" alt="Список аккаунтов TLauncher" /></p>
<p>Теперь из списка версий выбираем любую с иконкой TL (Это является обязательным, так как только версии с такой иконкой будут работать скины) и нажимаем "Установить".</p>
<p><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/install-tl-versions-2.0.png" title="Установка версии с иконкой TL в TLauncher" alt="Установка версии с иконкой TL в TLauncher" /></p>
<p>Заходим на сервере и проверяем, что скин ваш! Вот такой вот простой способ установки с помощью сайта tlauncher.org, рекомендуйте своим друзьям.</p>
<p><img style="display: block; margin-left: auto; margin-right: auto;" src="/img/skin-install-tl.jpg" title="Установленный скин с помощью TLauncher" alt="Установленный скин с помощью TLauncher" /></p>
</div>
		
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