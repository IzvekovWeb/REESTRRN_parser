<?php 
class siteParser {

  public $site;
  public $url;
  public $keywords;

  function __construct($site, $url, $keywords) { 
    $this->site = $site;
    $this->url = $url['url'];
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
    
    // echo "Тег статьи: " . $tags['article'] . "<br>";


    if (!empty($articles)) {

      // dump($articles);

      foreach($articles as $art){

        $article = pq($art);   

        // dump($article);

        if ($tags['link'] != null) {
          // Задаём ссылку на статью
          if (strpos($article->find($tags['link'])->attr('href'), 'http') || strpos($article->find($tags['link'])->attr('href'), $this->site) ) {
            $link = $article->find($tags['link'])->attr('href');
          }else {
            $link = $this->site . $article->find($tags['link'])->attr('href');
          }
        }else{
          $link = $this->url;
        }

        // Отбираем нужные данные и заносим в массив
        $article_el = [
          'title'     => trim($article->find($tags['title'])->text()),
          'desc'      => cutStr(trim($article->find($tags['desc'])->text()), 650),
          'link'      => $link,
          'time'      => trim($article->find($tags['time'])->text()),
          'allow'     => false,
          'keywords'  => [],
          'site_url'  => $this->url,
          'site_name' => $this->site,
        ]; 
 
        // dump($article_el); 

        // Проверяем на наличие ключевых слов в заголовке или описании
        if(!empty($article_el['title']) && !empty($article_el['link'])){ 

          // foreach ($this->keywords as $key){ 
            
          //   // Если ключевое слово есть в заголовке или описании
          //   if (stripos($article_el['title'], $key) !== false || stripos($article_el['desc'], $key) !== false){
 
          //     // Допускаем новость и записываем ключевое слово
          //     $article_el['allow'] = true;
          //     array_push($article_el['keywords'], $key);
          //   }
          // }

          // Добавляем данные одной заметки в массив со всеми заметками

          // dump($article_el); 

          array_push($values, $article_el);
        }
      }
    }
    else{
      return ['message' => 'На сайте не нашлось подходящих тегов','error' => true, 'result' => $values];
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
    $values = Array();

    if(!empty($json) && $json ) {

      foreach($json as $article){
        
        // dump($article);  
        
        $link = '';
        if ($this->site == "streetinsider.com") {
          $link = "https://www.streetinsider.com/dr/news.php?id=" . $article->{$tags['link']};
        }
        else {
          $link = $article->{$tags['link']};
        } 

        // Отбираем нужные данные и заносим в массив
        $article_el = [
          'title'     => trim($article->{$tags['title']}),
          'desc'      => cutStr(trim($article->{$tags['desc']}), 650),
          'link'      => $link,
          'time'      => trim($article->{$tags['time']}),
          'allow'     => false,
          'keywords'  => [],
          'site_url'  => $this->url,
          'site_name'  => $this->site,
        ]; 

        // dump($article_el); 

        // Проверяем на наличие ключевых слов в заголовке или описании
        if(!empty($article->{$tags['title']}) && $link != ''){
          
          foreach ($this->keywords as $key){

            // Если ключевое слово есть в заголовке или описании
            if (stripos($article->{$tags['title']}, $key) || stripos($article->{$tags['desc']}, $key)){
               
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
    if ($site_name == 'aoreestr.ru'){ 
      $tags = [
        'article' => 'div.Row > div.NewsItem',
        'title' => 'h3.NewsItem__Title',
        'desc' => null,
        'link' => 'a.NewsItem__TitleLink',
        'time' => 'span.NewsItem__DateAdd',
      ]; 
    }elseif($site_name == 'vrk.ru'){
      $tags = [
        'article' => 'div.faq-page > div > div.news',
        'title' => 'a.tit > span',
        'desc' => 'p',
        'link' => 'a.tit',
        'time' => 'div.date',
      ];
    }
    elseif($site_name == 'mrz.ru'){
      $tags = [
        'article' => 'div.nl-news > div.nl-item',
        'title' => 'h3.nl-title',
        'desc' => null,
        'link' => null,
        'time' => 'p.nl-date',
      ];
    }
    return $tags;
  }
}
?>