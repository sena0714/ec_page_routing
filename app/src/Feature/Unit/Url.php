<?php
namespace App\Feature\Unit;

use App\Service\Feature\Number;

class Url
{
    private $scheme;
    private $host;
    private $port;
    private $path;
    public function __construct(string $url)
    {
        $url = parse_url($url);
        $this->scheme = $url['scheme'];
        $this->host = $url['host'];
        $this->port = $url['port'];
        $this->path = $url['path'];
    }

    public function fullUrl()
    {
        return "{$this->scheme}://{$this->host}:{$this->port}{$this->path}";
    }

    public function matches(string $regex): bool
    {
        return preg_match($regex, $this->path);
    }

    public function parseParam(): array
    {
        $result = [];
    
        $params = explode('/', $this->path);
        array_shift($params);
        for ($i = 0; $i < count($params); $i++) {
            if (Number::isEven($i)) {
                $result[$params[$i]] = '';
            } elseif (Number::isOdd($i)) {
                $result[$params[$i-1]] = $params[$i];
            }
        }
    
        return $result;
    }

    public function path(): string
    {
        return $this->path;
    }

    static public function createOwnUrl(): self
    {
        $url = '';
        if(isset($_SERVER['HTTPS'])){
            $url .= 'https://';
        }else{
            $url .= 'http://';
        }
        $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        return new self($url);
    }
}