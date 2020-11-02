<?php 
class siteParser {

  public $site;
  public $url;
  public $keywords;

  function __construct($site, $url, $keywords) { 
    $this->site = $site;
    $this->url = $url;
    $this->keywords = $keywords;
  }

  /*
  *  Функция: обрабатывает страницу с новостями
  *  Вход: $document - HTML страница
           $tags - теги для обработки конкретного сайта (5 элементтов)
  *  Выход: результат добавления
  */
  
  public function parse($document, $tags){
    
    // Обёртка новостей
 

    $articles = $document->find($tags['article']);
    $values = Array();
    if (!empty($articles)) {

      // echo '<pre>';
      // var_dump($articles);
      // echo '</pre>';
    
      foreach($articles as $art){
       
        
        $article = pq($art);   

        // Отбираем нужные данные и заносим в массив
        $article_el = [
          'title'     => trim($article->find($tags['title'])->text()),
          'desc'      => trim($article->find($tags['desc'])->text()),
          'link'      => $this->site . $article->find($tags['link'])->attr('href'),
          'time'      => trim($article->find($tags['time'])->text()),
          'allow'     => false,
          'keywords'  => [],
          'site_url'  => $this->url,
          'site_name'  => $this->site,
        ]; 
        echo '<pre>';
        var_dump($article_el);
        echo '</pre>';

       

        if(!empty($article_el['title']) && !empty($article_el['link'])){
          
          // Проверяем на наличие ключевых слов в заголовке или описании
          foreach ($this->keywords as $key){

            // Если ключевое слово есть в заголовке или описании
            if (stripos($article_el['title'], $key) || stripos($article_el['desc'], $key)){
              
              // Допускаем новость и записываем ключевое слово
              $article_el['allow'] = true;
              array_push($article_el['keywords'], $key);
            }
            
          }
          // Добавляем данные одной заметки в массив со всеми заметками
          if($article_el['allow']){
            array_push($values, $article_el);
          }
        }
      }
    }
    else{
      return ['message' => 'На сайте не нашлось подходящих тегов ','error' => true, 'result' => $values];
    }
    
    return ['message' => 'Сайт успешно спарсен ','error' => false, 'result' => $values];
  }



    /*
  *  Функция: возвращает теги для сайта
  *  Вход: $site_name - название сайта
  *  Выход: массив с тегами 
  */
  public function set_tags($site_name){

    $tags = null;

    if ($site_name == 'prnewswire.com'){ 
      $tags = [
        'article' => 'div.row > div.card',
        'title' => 'h3 > a',
        'desc' => 'p',
        'link' => 'h3 > a',
        'time' => 'small',
      ]; 
    }elseif ($site_name == 'businesswire.com'){
      
      $tags = [
        'article' => '.bwNewsList > li',
        'title' => 'div > a > span', 
        'desc' => 'null',
        'link' => 'div > a.bwTitleLink',
        'time' => 'div.bwTimestamp > time',
      ]; 
      

    }elseif ($site_name == 'globenewswire.com'){
      $tags = [
        'article' => 'div.rl-container > div.results-link',
        'title' => 'h1.post-title16px > a',
        'desc' => 'h1.post-title16px + p',
        'link' => 'h1.post-title16px > a',
        'time' => 'null',
      ];
    }
    return $tags;
  }
}
?>