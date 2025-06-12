<?php include "lib/variables.php"; ?>
<!DOCTYPE html>
<html lang="ru">
   	<head>
      	<meta charset="UTF-8">
      	<meta http-equiv="X-UA-Compatible" content="IE=edge">
      	<meta name="viewport" content="width=device-width, initial-scale=1">
      	<title>U-World | Главная</title>
      	<link rel="stylesheet" href="css/bootstrap.css">
      	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
      	<link rel="stylesheet" href="css/style.css">
	</head>
  <body>
      	<?php echo $content_menu;?>
      	<div class="jumbotron jumbotron-fluid text-center">
        	<div class="container">
            	<h5 class="lifedrop"><i class="fas fa-life-ring"></i> Последние покупки</h5>
            	<div class="card-deck justify-content-center" id="life"></div>
            	<?php 
            		$col = mysqli_query($conDB, "SELECT * FROM `buy`");
               		$count = 0;
              		while ($row = mysqli_fetch_assoc($col)) { $count++; } 
      			   ?>
            	<h6 class="timedrop">(Всего <?php echo $count;?> покупок, выдано <?php echo $count;?>/<?php echo $count;?>)</h6>
         	</div>
      	</div>
      	<div class="container">
         	<div class="row">
            	<ul class="nav nav-pills mb-3 col-md-12 justify-content-center" id="pills-tab" role="tablist">
               		<li class="nav-item active show">
                  		<a class="nav-link" id="pills-perm-tab" data-toggle="pill" href="#pills-perm" role="tab" aria-controls="pills-perm" aria-selected="true"><span class="icon" style="background-image: url(../img/icon/ranks.png);"></span> Привилегии</a>
	            	</li>
	               	<li class="nav-item">
	                  	<a class="nav-link" id="pills-case-tab" data-toggle="pill" href="#pills-case" role="tab" aria-controls="pills-case" aria-selected="true"><span class="icon" style="background-image: url(../img/icon/cases.png);"></span> Ключи от кейсов</a>
	               	</li>
	               	<li class="nav-item">
	                  	<a class="nav-link" id="pills-money-tab" data-toggle="pill" href="#pills-money" role="tab" aria-controls="pills-money" aria-selected="true"><span class="icon" style="background-image: url(../img/icon/credits.png);"></span> Монетки</a>
	               	</li>
	               	<li class="nav-item">
	                  	<a class="nav-link" id="pills-yunik-tab" data-toggle="pill" href="#pills-yunik" role="tab" aria-controls="pills-yunik" aria-selected="true"><span class="icon" style="background-image: url(../img/icon/gold-wallet.png);"></span> Юники</a>
	               	</li>
	               	<li class="nav-item">
	                	<a class="nav-link" id="pills-mysterybox-tab" data-toggle="pill" href="#pills-mysterybox" role="tab" aria-controls="pills-mysterybox" aria-selected="true"><span class="icon" style="background-image: url(../img/icon/mysterybox.png);"></span> Мистические сундуки</a>
	               	</li>
	               	<li class="nav-item">
	                	<a class="nav-link" id="pills-mysterygift-tab" data-toggle="pill" href="#pills-mysterygift" role="tab" aria-controls="pills-mysterygift" aria-selected="true"><span class="icon" style="background-image: url(../img/icon/mysterygift.png);"></span> Подарочные коробки</a>
	               	</li>
	               	<li class="nav-item">
	                	<a class="nav-link" id="pills-tituls-tab" data-toggle="pill" href="#pills-tituls" role="tab" aria-controls="pills-tituls" aria-selected="true"><span class="icon" style="background-image: url(../img/icon/tituls.png);"></span> Титулы</a>
	               	</li>
	               	<li class="nav-item">
	                	<a class="nav-link" id="pills-other-tab" data-toggle="pill" href="#pills-other" role="tab" aria-controls="pills-other" aria-selected="true"><span class="icon" style="background-image: url(../img/icon/others.png);"></span> Разное</a>
	               	</li>
           		</ul>
            	<div class="tab-content col-md-10 col-xs-12 mx-auto" id="pills-tabContent" style="margin: 20px;">
               		<?php
	               		$types = mysqli_query($conDB,"SELECT DISTINCT `type` FROM `donate`");

	                  	$first = 'show active';
	                  	$nf = 0;

	                  	while ($rowType = mysqli_fetch_assoc($types)) {
	                    	$nf++;
	               	?>
                  	<div class="tab-pane fade <?php if ($nf==1) echo $first; ?>" id="pills-<?=$rowType['type']?>" role="tabpanel" aria-labelledby="pills-<?=$rowType['type']?>-tab">
                     	<div class="products row">
                        	<?php
                   				$adds = mysqli_query($conDB, 'SELECT * FROM `donate` WHERE `type`="'.$rowType['type'].'"');

                  				$mostValue = '';
                   				$mostCount = 5;

                   				while ($result = mysqli_fetch_assoc($adds)) {
                   					$countType = 0;

                      				$group = mysqli_query($conDB, 'SELECT * FROM `buy` WHERE `data`="'.$result['group'].'"');
                 					while ($c = mysqli_fetch_assoc($group)) { $countType++; }
                   					if ($countType > $mostCount) {
          										$mostValue = $result['group'];
          										$mostCount = $countType;
                   					}
                   				}

                   				$adds2 = mysqli_query($conDB, 'SELECT * FROM `donate` WHERE `type`="'.$rowType['type'].'"');
                        		while ($row = mysqli_fetch_assoc($adds2)) {
                        			$img = '';

                        			$description = $row['description'];
                        	?>
                       		<div class="col col-4-12 product">
             					<div class="capsula">
	               			        <?php if ($row['label'] != '') {?>
	               			        	<div class="time-value"><?=$row['label'];?></div>
	                            	<?php $description = ''; } ?>
                      				<div class="top">
	                                 	<?php if ($description != '') {?>
		                					<a data-toggle="modal" data-target="#modalOp" data-description="<?=$description;?>" data-header="<?=$row['name'];?>">
		                                   		<i class="fa fa-info"></i>
		                                    </a>
	                                	<?php }?>
                                    <span class="countBuy">
                              			<?php
                               				$count = 0;
                              				$group = mysqli_query($conDB, 'SELECT * FROM `buy` WHERE `data`="'.$row['group'].'"');
                         					while ($c = mysqli_fetch_assoc($group)) { $count++; }
                           				?>
                                       	<i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <?=$count; ?>
                                    </span>
	                     			</div>
		                     			<?php
		                     				if ($row['image'] != '') {
		                     					$img = $rowType['type'].'/'.$row['image'];
		                     				} else {
		                     					$img = $rowType['type'].'/'.$row['group'].'.png';
		                     				}
		                     			?>
	                     				<div style="width: 120px; height: 106px; margin: 10 auto; background: url(../img/other/<?=$img?>) no-repeat; background-size: auto 106px; background-position: center;"></div>
	                                <div class="name"><?=$row['name'];?></div>
	                                <div class="price"><?=$row['price'];?> ₽</div>
	                                <?php if ($mostValue == $row['group']) { ?>
	                                	<div class="most-value">Самый продаваемый</div>
	                            	<?php } ?>
	                                <div class="btn-group btn-group-lg">
	                   					<button class="btn bnt-new btn-lg btn-block" style="border-radius: 15px 30px;" data-toggle="modal" data-target="#donatebuy" data-group="<?=$row['group'];?>" data-name="<?=$row['name'];?>" data-img="<?=$img?>" data-price="<?=$row['price'];?>">Купить</button>
	                                </div>
                            	</div>
                       		</div>
                        	<?php } ?>
                     	</div>
                  	</div>
               		<?php } ?>
            	</div>
        	</div>
      	</div>
      	<div class="modal fade" id="donatebuy" tabindex="-1" role="dialog" aria-labelledby="donatebuyLabel">
         	<div class="modal-dialog" role="document">
            	<div class="modal-content">
               		<div class="modal-header">
                  		<div id="result"></div>
                  		<button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
               		</div>
               		<div class="modal-body">
                  		<div id="img"></div>
                  		<form action="donate/buy.php" method="post" id="form" onchange="checkprice()">
                     		<div class="form-group">
                        		<label for="nickname">Введите ниже данные для покупки:</label>
                        		<div id="setNick"></div>
                        		<div id="setPromo"></div>
                     		</div>
                     		<div class="text-center">
                        		<div class="form-group">
                           			<input type="hidden" name="group" id="group">
                        		</div>
                        		<div id="buyclick"></div>
                     		</div>
                  		</form>
               		</div>
            	</div>
         	</div>
      	</div>
      	<div class="modal fade" id="modalOp" tabindex="-1" role="dialog" aria-labelledby="modalOpLabel">
         	<div class="modal-dialog" role="document">
            	<div class="modal-content">
               		<div class="modal-header">
                  		<div id="header"></div>
                  		<button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
               		</div>
               		<div class="modal-body">
                  		<div id="description" style="text-align: center!important; margin-top: 10px"></div>
               		</div>
            	</div>
         	</div>
      	</div>

	    <footer>
			<div class="container">
		        <span>© 2019 UniversalWorld - Все права защищены.</span>
		        <p>Мы не являемся коммерческой организацией. Все средства с приобретения доната идут на развитие проекта.</p>
				<a href="https://metrika.yandex.ru/stat/?id=49112071&amp;from=informer"
				target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/49112071/3_1_FFCF39FF_F5AF19FF_0_pageviews"
				style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="49112071" data-lang="ru" /></a>

				<script type="text/javascript" >
				   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
				   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
				   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

				   ym(49112071, "init", {
				        clickmap:true,
				        trackLinks:true,
				        accurateTrackBounce:true,
				        webvisor:true,
				        trackHash:true
				   });
				</script>
				<noscript><div><img src="https://mc.yandex.ru/watch/49112071" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		   	</div>
	    </footer>

      	<script src="js/jquery-2.2.0.min.js"></script>
      	<script src="js/bootstrap.js"></script>
      	<script src="js/common.js?v=1.1"></script>
      	<script>
        	function show() {
             	$.ajax({
                 	url: "live.php", // Путь к php скрипту который будет загружать заголовки
                 	cache: false,
                 	success: function(html){
                     	$("#life").html(html); // Блок куда будем выводить информацию
                 	}
             	});
         	}
         
         	$(document).ready(function() {
             	show();
             	setInterval(show, 1000); //5000 Интервал обновления в миллисекундах 
         	});
      	</script>
   	</body>
</html>