<?php    
  include "lib/configbg.php";

  //SELECT * FROM `unitpay_payments` WHERE `status`= 1 ORDER BY id DESC LIMIT 5
  $adds = mysqli_query($conDB, "SELECT * FROM `buy` ORDER BY id DESC LIMIT 5");
  while ($row = mysqli_fetch_assoc($adds)) {
    
    $name = mysqli_query($conDB, 'SELECT * FROM `donate` WHERE `group`="'.$row['data'].'"');
    while ($rowName = mysqli_fetch_assoc($name)) { $img = '';?>

      <div class="last-align-items-center">
        <img class="img-top" src="https://minotar.net/avatar/<?=$row['name'];?>/75.png">
        <?php
          if ($rowName['image'] != '') {
            $img = $row['type'].'/'.$rowName['image'];
          } else {
            $img = $row['type'].'/'.$rowName['group'].'.png';
          }
        ?>
        <div class="donate-img">
          <img src="http://u-world.su/img/other/<?=$img?>">
        </div>
        <div class="card-body">
          <h5 class="card-title"><?php echo $row['name']; ?></h5>
			<?php 
				$date1 = $row['dateComplete'];
				$date2 = date("Y-m-d H:i:s");

				$diff = abs(strtotime($date2) - strtotime($date1)); 

				$years   = floor($diff / (365 * 60 * 60 * 24)); 
				$months  = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24)); 
				$days    = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24)/ (60 * 60 * 24));

				$hours   = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60)); 

				$minuts  = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60*24 - $hours * 60 * 60) / 60); 

				$seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60*24 - $hours * 60 * 60 - $minuts * 60)); 

				$datasString = '';
				

				if ($hours <= 0 && $days < 1 && $minuts < 1) {
					$secondsString = 'секунд';

					if ($seconds % 100 > 10 && $seconds % 100 < 15) {
						$secondsString = 'секунд';
					} else {
						switch ($seconds % 10) {
							case 1:
								$secondsString = 'секунда';
								break;
							case 2:
							case 3:
							case 4:
								$secondsString = 'секунды';
								break;
							default:
								$secondsString = 'секунд';
						}
					}

					$datasString = $seconds.' '.$secondsString.' назад';
				} else {
					$minutsString = '';

					if ($minuts % 100 > 10 && $minuts % 100 < 15) {
						$minutsString = $minuts.' минут';
					} else {
						switch ($minuts % 10) {
							case 1:
								$minutsString = $minuts.' минуту';
								break;
							case 2:
							case 3:
							case 4:
								$minutsString = $minuts.' минуты';
								break;
							default:
								$minutsString = $minuts.' минут';
						}
					}

					$hoursString = '';
					
					if ($hours > 0) {
						if ($hours % 100 > 10 && $hours % 100 < 15) {
							$hoursString = $hours.' часов';
						} else {
							switch ($hours % 10) {
								case 1:
									$hoursString = $hours.' час';
									break;
								case 2:
								case 3:
								case 4:
									$hoursString = $hours.' часа';
									break;
								default:
									$hoursString = $hours.' часов';
							}
						}
					}

					$datasString = $hoursString.' '.$minutsString.' назад';		
				}

				$daysString = '';
					
				if ($days > 0) {
					if ($days % 100 > 10 && $days % 100 < 15) {
						$daysString = $days.' дней';
					} else {
						switch ($days % 10) {
							case 1:
								$daysString = $days.' день';
								break;
							case 2:
							case 3:
							case 4:
								$daysString = $days.' дня';
								break;
							default:
								$daysString = $days.' дней';
						}
					}
				}

				$datasString = $daysString.' '.$datasString;
          	?>
          <p class="card-text"><small class="text-muted"><?=$rowName['name']?> за <?=$row['sum']?> руб.<br>Купил <?=$datasString?></small></p>
        </div>
      </div>
<?php }} ?>