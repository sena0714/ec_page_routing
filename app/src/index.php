<?php
ini_set('display_errors', 'On');
require_once(__DIR__.'/../vendor/autoload.php');

use App\Service\Unit\Url;
use App\Service\Page\PageRouter;

try {
    // コントローラーを動かす
    $url = Url::createOwnUrl();
    $pageRouter = new PageRouter($url);
    if (!$page = $pageRouter->find()) {
        echo '404 not found';
        exit;
    }

    $page->controller()->{$page->method()}($page->params());
} catch(\Exception $e) {
    echo $e->getMessage();
    exit;
}