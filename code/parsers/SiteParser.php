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
  public function parse_HTML($document, $tags){
    
    // Обёртка новостей
 

    $articles = $document->find($tags['article']);
    $values = Array();
    if (!empty($articles)) {

      echo '<pre>';
      var_dump($tags['article']);
      echo '</pre>';

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

        // echo '<pre>';
        // var_dump($article_el);
        // echo '</pre>';

        // Проверяем на наличие ключевых слов в заголовке или описании
        if(!empty($article_el['title']) && !empty($article_el['link'])){

          
          
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
  *  Функция: парсит JSON данные со страницы
  *  Вход: $json - JSON страница
           $tags - теги для обработки конкретного сайта (5 элементтов)
  *  Выход: результат добавления
  */
  public function parse_JSON($data, $tags){
    
    // Обёртка новостей
    $json = json_decode($data);

    // dump($json);

    // $articles = $document->find($tags['article']);
    // $values = Array();
    // if (!empty($articles)) {

    //   echo '<pre>';
    //   var_dump($tags['article']);
    //   echo '</pre>';

    //   // echo '<pre>';
    //   // var_dump($articles);
    //   // echo '</pre>';
    
      foreach($json as $article){
        
        dump($art); 
        echo $article->$tags['title'];
        // Отбираем нужные данные и заносим в массив
        $article_el = [
          'title'     => trim($article->$tags['title']),
          // 'desc'      => trim($article->find($tags['desc'])->text()),
          // 'link'      => $this->site . $article->find($tags['link'])->attr('href'),
          // 'time'      => trim($article->find($tags['time'])->text()),
          // 'allow'     => false,
          // 'keywords'  => [],
          // 'site_url'  => $this->url,
          // 'site_name'  => $this->site,
        ]; 

        // echo '<pre>';
        // var_dump($article_el);
        // echo '</pre>';

        // Проверяем на наличие ключевых слов в заголовке или описании
        if(!empty($article_el['title']) && !empty($article_el['link'])){

          
          
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
    // }
    // else{
    //   return ['message' => 'На сайте не нашлось подходящих тегов ','error' => true, 'result' => $values];
    // }
    
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
    elseif ($site_name == 'finance.yahoo.com'){
      $tags = [
        'article' => 'div#Fin-Stream > ul > li',
        'title' => 'h3 > a',
        'desc' => 'p',
        'link' => 'h3 > a',
        'time' => 'null',
      ];
    }

    // Разобраться с ссылкой, ее нет в JSON
    elseif ($site_name == 'streetinsider.com'){
      // JSON
      $tags = [
        'article' => 'id',
        'title' => 'headline',
        'desc' => 'body',
        'link' => 'a',
        'time' => 'date',
      ];
    }
    // elseif ($site_name == 'bloomberg.com'){
    //   $tags = [
    //     'article' => 'div.story-package-module',
    //     'title' => 'h3.story-package-module__story__headline > a',
    //     'desc' => 'dfn',
    //     'link' => 'h3.story-package-module__story__headline > a',
    //     'time' => 'null',
    //   ];
    // }
    // elseif ($site_name == 'cnbc.com'){
    //   $tags = [
    //     'article' => 'div.Card-card',
    //     'title' => 'a',
    //     'desc' => 'null',
    //     'link' => 'a',
    //     'time' => 'null',
    //   ];
    // }n
    elseif ($site_name == 'barrons.com'){
      $tags = [
        'article' => 'article',
        'title' => 'h3[class^="BarronsTheme--headline"] > a',
        'desc' => 'p[class^="BarronsTheme--summary"]',
        'link' => 'h3[class^="BarronsTheme--headline"] > a',
        'time' => 'div[class^="BarronsTheme--timestamp"] > p',
      ];
    }
    elseif ($site_name == 'seekingalpha.com'){
      $tags = [
        'article' => 'li[class^="mc"]',
        'title' => 'div.title > a',
        'desc' => 'null',
        'link' => 'div.title > a',
        'time' => 'null',
      ];
    }

    
    return $tags;
  }
}
?>