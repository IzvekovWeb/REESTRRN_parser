<?php 

class Files {


  /*
  *  Функция: получение всех файлов в каталоге с определенным разширением
  *  Вход: путь к каталогу, разширение
  *  Выход: массив: дата создания - имя файлы
  */
  public static function get_all_files($path, $ext){
    $myFiles = [];
    // Выбираем все файдлы в каталоге
    foreach (scandir($path) as $filename)
    {
      // Выбираем файлы с расширением txt
      if (Files::check_extension($filename, '.'. $ext)){ 

        // Определяем дату создания файлы из Unix метки 
        $date = date_create();  
        date_timestamp_set($date, filectime($path .'/' .$filename));
        $date = date_format($date, 'Y-m-d H:i:s');  
        // Массив: ключ - дата, значение - имя файла
        $myFiles[$date] = $filename;
      }
    }

    return $myFiles;
  } 

  /*
  *  Функция: удаления старых файлов
  *  Вход: массив: дата создания - имя файлы
  *  Выход: boolean - результат удаления
  */
  public static function delete_old_files($myFiles){ 

    $path = dirname(__FILE__);
     
    $myFiles = Files::get_all_files($path, 'txt');

    // Сортируем массив по дате 
    krsort($myFiles);
    // Выбираем файлы на удаление (если больше 3х)
    $deleteFiles = array_slice($myFiles, 3, null, true);
    // Удаляем лишние файлы
    if (!empty($deleteFiles)){
      foreach ($deleteFiles as $dfile){
        try {
          unlink($path . '/' .$dfile);
        }catch (\Exception $e){
          echo $e;
          return false;
        }
      }
    }
    return true;
  }



  /*
  *  Функция: проверка окончания строки
  *  Вход: строка, подстрока окончания
  *  Выход: boolean
  */
  public static function check_extension($string, $ext) {
    $strlen = strlen($string);
    $testlen = strlen($ext);
    if ($testlen > $strlen) return false;
    return substr_compare($string, $ext, $strlen - $testlen, $testlen) === 0;
  }
}