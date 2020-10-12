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

  public function parse($document){
    
    // Обёртка новостей
    $articles = $document->find('div.row > div.card');
    $values = Array();
    if (!empty($articles)) {
    
      foreach($articles as $art){
        
        $article = pq($art);  

        // Отбираем нужные данные и заносим в массив
        $article_el = [
          'title'     => $article->find('h3 > a')->text(),
          'desc'      => $article->find('p')->text(),
          'link'      => $this->site . $article->find('h3 > a')->attr('href'),
          'time'      => $article->find('small')->text(),
          'allow'     => false,
          'keywords'  => [],
          'site_url'  => $this->url,
          'site_name'  => $this->site,
        ]; 
        
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
      return ['message' => 'На сайте не нашлось подходящих тегов','error' => true, 'result' => $values];
    }
    
    return ['message' => 'Сайт успешно спарсен','error' => false, 'result' => $values];
  }
}
?>