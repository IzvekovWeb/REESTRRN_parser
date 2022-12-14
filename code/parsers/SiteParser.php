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
          $href_text = $article->find($tags['link'])->attr('href');
          if (strpos($href_text, 'http') || strpos($href_text, $this->site) ) {
            $link = $href_text;
          }elseif($href_text) {
            $link = $this->site . $href_text;
          }elseif($tags['link'] == 'CURRENT') {
            $link = $article->attr('href');

          }else {
            $link = $this->site . $article->parents('a')->attr('href');
          }
        }else{
          $link = $this->url;
        }

        $time = $article->find($tags['time'])->text();
        if (preg_match('/[\p{Cyrillic}]/u', $time)) {
          $time = preg_replace('/[\t\n\r\s]+/', ' ', $time);
        }else {
          $time = preg_replace('/[\t\n\r\s]+/', '', $time);
        };

        $desc_text = trim($article->find($tags['desc'])->text());
        if ($tags['title'] == "SHORT_DESC"){
          $title = cutStr($desc_text, 150);
        }else {
          $title = trim($article->find($tags['title'])->text());
        }

        // Отбираем нужные данные и заносим в массив
        $article_el = [
          'title'     => mb_convert_encoding($title, 'UTF-8'),
          'desc'      => mb_convert_encoding(cutStr(trim($article->find($tags['desc'])->clone()->children()->remove()->end()->text()), 650), "UTF-8"),
          'link'      => $link,
          'time'      => trim($time),
          'allow'     => false,
          'keywords'  => [],
          'site_url'  => $this->url,
          'site_name' => $this->site,
        ]; 
 
        // dump($article_el); 

        if(!empty($article_el['title']) && !empty($article_el['link'])){  
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
        $link = $article->{$tags['link']};

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
    elseif($site_name == 'rrost.ru'){
      $tags = [
        'article' => 'div.events__r > ul > li',
        'title' => 'a.enents__link',
        'desc' => 'p',
        'link' => 'a.enents__link',
        'time' => 'div.date',
      ];
    }
    elseif($site_name == 'newreg.ru'){
      $tags = [
        'article' => 'main.site-main > article.cat-event-list',
        'title' => 'header.entry-header > h2 > a',
        'desc' => 'div.entry-content > div.cat-event-excerpt > div',
        'link' => 'header.entry-header > h2 > a',
        'time' => 'div.entry-content > div.cat-event-excerpt > div.event-date-archive',
      ];
    }
    elseif($site_name == 'profrc.ru'){
      $tags = [
        'article' => 'ul.b-news-list > li > article > div.b-news-preview__text',
        'title' => 'h3.b-news-preview__title',
        'desc' => null,
        'link' => 'a',
        'time' => 'time.b-news-time',
      ];
    }
    elseif($site_name == 'paritet.ru'){
      $tags = [
        'article' => 'div.pir-news__container > a.pir-news__wrap',
        'title' => 'h3.pir-news__title',
        'desc' => 'p',
        'link' => 'CURRENT',
        'time' => 'span.pir-news__date',
      ];
    }
    elseif($site_name == 'rtreg.ru'){
      $tags = [
        'article' => 'div.posts__list > article.posts__item',
        'title' => 'div > header > h4 > a',
        'desc' => 'p',
        'link' => 'div > header > h4 > a',
        'time' => 'div.show-for-large > time',
      ];
    }
    elseif($site_name == 'regkrc.ru'){
      $tags = [
        'article' => 'div.news-list > div.row > div.news-block',
        'title' => 'p.news-item',
        'desc' => null,
        'link' => 'p.news-item > a.podrobnee',
        'time' => 'p.news-item > span.news-date-time',
      ];
    }
    elseif($site_name == 'rostatus.ru'){
      $tags = [
        'article' => 'div.news-list > div.news-item',
        'title' => 'div.info-news > a.news-title',
        'desc' => null,
        'link' => 'div.info-news > a.news-title',
        'time' => 'span.news-date-time',
      ];
    }
    elseif($site_name == 'draga.ru'){
      $tags = [
        'article' => 'div.section-news-feed > div',
        'title' => 'h6 > a',
        'desc' => null,
        'link' => 'h6 > a',
        'time' => 'h8',
      ];
    }
    elseif($site_name == 'draga.ru'){
      $tags = [
        'article' => 'div.section-news-feed > div',
        'title' => 'h6 > a',
        'desc' => null,
        'link' => 'h6 > a',
        'time' => 'h8',
      ];
    }
    elseif($site_name == 'a-rnr.ru'){
      $tags = [
        'article' => 'div.news-list > p.news-item',
        'title' => 'SHORT_DESC',
        'desc' => 'span',
        'link' => null,
        'time' => 'span.news-date-time',
      ];
    }
    elseif($site_name == 'vtbreg.ru'){
      $tags = [
        'article' => 'ul.news-clients > li',
        'title' => 'div.client-box',
        'desc' => 'div.client-box',
        'link' => 'a',
        'time' => 'div.client-box > em',
      ];
    }
    elseif($site_name == 'reggarant.ru'){
      $tags = [
        'article' => 'div.news-list-wrapper > div.row > div',
        'title' => 'a.news__link > div > h2',
        'desc' => null,
        'link' => 'a.news__link',
        'time' => 'a.news__link > div > time',
      ];
    }
    elseif($site_name == 'zao-srk.ru'){
      $tags = [
        'article' => 'div.root-news-list > div.root-news-item',
        'title' => 'a',
        'desc' => null,
        'link' => 'a',
        'time' => 'div.date',
      ];
    }
    elseif($site_name == 'intraco.ru'){
      $tags = [
        'article' => 'div.news  > div.item > div.row > div > div.text',
        'title' => 'a.title',
        'desc' => null,
        'link' => 'a.title',
        'time' => 'span.date',
      ];
    }
    elseif($site_name == 'sineft.ru'){
      $tags = [
        'article' => 'div.news-items > a.news-item',
        'title' => 'div.item > div.news-item-title',
        'desc' => null,
        'link' => 'CURRENT',
        'time' => 'div.item > div.news-item-top > span.news-item-date',
      ];
    }
    elseif($site_name == 'industria-reestr.ru'){
      $tags = [
        'article' => 'div.newsList > div.newsCard',
        'title' => 'div.newsCardTitle > a',
        'desc' => null,
        'link' => 'div.newsCardTitle > a',
        'time' => 'div.newsCardDate',
      ];
    }
    elseif($site_name == 'servis-reestr.ru'){
      $tags = [
        'article' => 'div.n-list > div.n-item',
        'title' => 'div.preview_text',
        'desc' => null,
        'link' => 'div.bottom_block > div.more > a',
        'time' => 'div.bottom_block > div.date',
      ];
    }
    elseif($site_name == 'earc.ru'){
      $tags = [
        'article' => 'div.er-news-cards-cnt > div.er-news-card',
        'title' => 'div.er-news-card__content > a.er-news-card__title',
        'desc' => null,
        'link' => 'div.er-news-card__content > a.er-news-card__title',
        'time' => 'div.er-news-card__content > div.er-news-card__date > span',
      ];
    }
    elseif($site_name == 'crc-reg.com'){
      $tags = [
        'article' => 'div.news-list > div.news-list__item',
        'title' => 'div.news-list__info > a.news-list__ttl',
        'desc' => 'div.news-list__info > div.news-list__preview',
        'link' => 'div.news-list__info > a.news-list__ttl',
        'time' => 'div.news-list__date',
      ];
    }
    elseif($site_name == 'srmfc.ru'){
      $tags = [
        'article' => 'table.views-table > tbody > tr',
        'title' => 'td.views-field-title-1 > a',
        'desc' => null,
        'link' => 'td.views-field-title-1 > a',
        'time' => 'td.views-field-created',
      ];
    }
    elseif($site_name == 'rrcentre.ru'){
      $tags = [
        'article' => 'div.news-list > p.news-item',
        'title' => 'a.news-title',
        'desc' => '',
        'link' => 'a.news-title',
        'time' => 'span.news-date-time',
      ];
    }
    elseif($site_name == 'registrator-rekom.ru'){
      $tags = [
        'article' => 'div.list > p.item',
        'title' => 'a',
        'desc' => null,
        'link' => 'a',
        'time' => 'span',
      ];
    }
    elseif($site_name == 'oboronregistr.ru'){
      $tags = [
        'article' => 'div.wrapper > article',
        'title' => 'h3 > a',
        'desc' => 'span.info',
        'link' => 'h3 > a',
        'time' => 'span.date',
      ];
    }

    return $tags;
  }
}
?>
