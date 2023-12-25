<?php
ini_set('display_errors', 'On');
require_once(__DIR__.'/../vendor/autoload.php');

use App\Feature\Unit\Url;
use App\Feature\Page\PageRouter;
use App\Feature\Page\Setting;

try {
    // コントローラーを動かす
    $url = Url::createOwnUrl();
    $pageSetting = new Setting();
    $pageRouter = new PageRouter($url, $pageSetting);
    if (!$page = $pageRouter->find()) {
        throw new Exception('404 Not Found');
    }

    $page->controller()->{$page->method()}($page->params());
} catch(\Exception $e) {
    echo $e->getMessage();
    exit;
}