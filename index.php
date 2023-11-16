<?php

$request_url = $_SERVER['REQUEST_URI'];

//поодгружаем список постов из json-файла
$posts = json_decode(file_get_contents('view/posts.json'), true);
$categories = [
    'Coding' => 'coding',
    'Artificial Intelligence' => 'ai',
    'Security' => 'security',
    'Open source' => 'open-source',
];

$idsByCategory = [];
$page_id = '';
foreach ($posts as $id => $post) {

    //проверяем является ли запрошенный адрес одним из постов
    if ('/' . $post['url'] == $request_url) {

        $page_id = $id;
    }

    //составляем список id по категориям постов (i.e. AI -> [2, 5])
    $idsByCategory[$post['category']][] = $id;

}

//проверяем является ли запрошенный адрес одной из категорий (разумнее сверять с массивом категорий, но так тоже должно работать)
$category = '';
foreach ($categories as $categoryName => $categoryUrl) {

    if ('/' . $categoryUrl == $request_url) {

        $category = $categoryName;
    }
}

$page = file_get_contents('layout.php');

//маршрутизируем
if ($request_url == '/') {

    $content = '';

    $ids = array_rand($posts, 3);
    foreach ($ids as $id) {

        $postContent = file_get_contents("view/$id.php");

        //вырезаем все теги кроме <p> и формируем короткий анонс
        $postContent = strip_tags($postContent, '<p>');
        $announce = '';
        while (strlen($announce) < 512) {

            preg_match('#(<p>.+?</p>)#su', $postContent, $match);
            $announce .= $match[1];
            $postContent = substr($postContent, strlen($match[1]));
        }

        $content .= <<<EOT
        <div class="blog-post">
        <h2 class="blog-post-title"><a href="/{$posts[$id]['url']}" style="text-decoration: none;">{$posts[$id]['title']}</a></h2>
        <p class="blog-post-meta">{$posts[$id]['category']}</p>
        $announce
        </div><!-- /.blog-post -->
        EOT;
    }

    $page = str_replace('{{CONTENT}}', $content, $page);

} elseif (!empty($category)) {

    $content = '';

    $ids = $idsByCategory[$category];
    foreach ($ids as $id) {

        $postContent = file_get_contents("view/$id.php");

        //вырезаем все теги кроме <p> и формируем короткий анонс
        $postContent = strip_tags($postContent, '<p>');
        $announce = '';
        while (strlen($announce) < 512) {

            preg_match('#(<p>.+?</p>)#su', $postContent, $match);
            $announce .= $match[1];
            $postContent = substr($postContent, strlen($match[1]));
        }

        $content .= <<<EOT
        <div class="blog-post">
        <h2 class="blog-post-title"><a href="/{$posts[$id]['url']}" style="text-decoration: none;">{$posts[$id]['title']}</a></h2>
        $announce
        </div><!-- /.blog-post -->
        EOT;
    }

    $page = str_replace('{{CONTENT}}', $content, $page);

} elseif (!empty($page_id)) {

    $content = file_get_contents("view/$page_id.php");//получаем контент запрошенной страницы

    //добавляем заголовок и категорию на страницу поста
    $content = <<<EOT
    <div class="blog-post">
        <h1 class="blog-post-title">{$posts[$page_id]['title']}</h1>
        <p class="blog-post-meta">{$posts[$page_id]['category']}</p>
        $content
    </div>
    EOT;

    $page = str_replace('{{CONTENT}}', $content, $page);

} else {

    $page = file_get_contents('404.php');
}

echo $page;