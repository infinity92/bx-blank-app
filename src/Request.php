<?php

namespace App;

class Request
{
    private array $get;
    private array $post;
    private array $server;

    public function __construct()
    {
        $this->get = $_GET ?? [];
        $this->post = $_POST ?? [];
        $this->server = $_SERVER ?? [];
    }

    public function get(string $key, $default = null)
    {
        return $this->get[$key] ?? $default;
    }

    public function post(string $key, $default = null)
    {
        return $this->post[$key] ?? $default;
    }

    public function server(string $key, $default = null)
    {
        return $this->server[$key] ?? $default;
    }

    public function allGet(): array
    {
        return $this->get;
    }

    public function allPost(): array
    {
        return $this->post;
    }

    public function allServer(): array
    {
        return $this->server;
    }

    public function method(): string
    {
        return $this->server['REQUEST_METHOD'] ?? 'GET';
    }

    public function isPostMethod(): bool
    {
        return $this->method() === 'POST';
    }

    public function isGetMethod(): bool
    {
        return $this->method() === 'GET';
    }
}