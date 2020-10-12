<?php 

$file = './log.txt';
$current = file_get_contents($file);

for ($i = 1; $i <= 10; $i++) {

  file_put_contents($file,"Поступил запрос " . $i . "\n", FILE_APPEND | LOCK_EX);

  $start = microtime(true);
  file_put_contents($file,"Начальное время - " .$start ."\n", FILE_APPEND | LOCK_EX);
 
  file_put_contents($file,"sleep-start \n", FILE_APPEND | LOCK_EX);

  sleep(10);

  file_put_contents($file,"sleep-end \n", FILE_APPEND | LOCK_EX);

  include('index.php');
  
  $time = microtime(true);

  file_put_contents($file,"Конечное время - " .$time ."\n", FILE_APPEND | LOCK_EX);
  file_put_contents($file,"Время - " .microtime(true)-$start ."\n", FILE_APPEND | LOCK_EX);

  file_put_contents($file,"\n=====================" ."\n\n", FILE_APPEND | LOCK_EX);
 
}
file_put_contents($file,"Конец программы\n", FILE_APPEND | LOCK_EX);
 
?>