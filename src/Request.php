<?php

namespace App;

use Dotenv\Dotenv;

class Request
{
    private array $get;
    private array $post;
    private array $server;
    private array $env;

    public function __construct()
    {
        $this->get = $_GET ?? [];
        $this->post = $_POST ?? [];
        $this->server = $_SERVER ?? [];
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
        $this->env = $_ENV ?? [];
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

    public function allEnv(): array
    {
        return $this->env;
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

    public function env(string $key, $default = null)
    {
        return $this->env[$key] ?? $default;
    }
}