<?php
namespace App\Service\Page;

use App\Service\Unit\Url;
use App\Service\Page\Page;
use App\Service\Page\Setting;

class PageRouter
{
    private $setting;
    private $url;
    public function __construct(Url $url)
    {
        $this->setting = new Setting();
        $this->url = $url;
    }

    public function find(): ?Page
    {
        foreach ($this->setting->pages() as $page) {
            if ($this->matches($page['path'])) {
                $params = $this->parseParams($page['path']);
                return new Page($page['controller'], $page['method'], $params);
            }
        }

        return null;
    }
    
    public function matches(string $routePath): bool
    {
        $pattern = preg_replace('/\//', '\/', $routePath);
        $pattern = preg_replace('/{.+?}/', '.+', $pattern);
        return (bool)preg_match('/^'.$pattern.'$/', $this->url->path());
    }

    public function parseParams(string $routePath): array
    {
        $result = [];

        $urlPathParams = explode('/', $this->url->path());
        $routePathParams = explode('/', $routePath);
        for ($i = 0; $i < count($routePathParams); $i++) {
            if (preg_match('/{.+?}/', $routePathParams[$i])) {
                // パスの{}で囲まれている部分のみ取り出してキーにする
                $key = strtr($routePathParams[$i], [
                    '{' => '', 
                    '}' => ''
                ]);
                $result[$key] = $urlPathParams[$i];
            }
        }

        return $result;
    }
}