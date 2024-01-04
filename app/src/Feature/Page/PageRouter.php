<?php
namespace App\Feature\Page;

use App\Feature\Unit\Url;

class PageRouter
{
    private $url;
    private $setting;
    public function __construct(Url $url, Setting $setting)
    {
        $this->url = $url;
        $this->setting = $setting;
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
    
    private function matches(string $pagePathParams): bool
    {
        $pattern = preg_replace('/\//', '\/', $pagePathParams);
        $pattern = preg_replace('/{.+?}/', '.+', $pattern);
        return (bool)preg_match('/^'.$pattern.'$/', $this->url->path());
    }

    private function parseParams(string $routePath): array
    {
        $result = [];

        $urlPathParams = explode('/', $this->url->path());
        $pagePathParams = explode('/', $routePath);
        for ($i = 0; $i < count($pagePathParams); $i++) {
            if (preg_match('/{.+?}/', $pagePathParams[$i])) {
                // パスの{}で囲まれている部分のみ取り出してキーにする
                $key = strtr($pagePathParams[$i], [
                    '{' => '', 
                    '}' => ''
                ]);
                $result[$key] = $urlPathParams[$i];
            }
        }

        return $result;
    }
}