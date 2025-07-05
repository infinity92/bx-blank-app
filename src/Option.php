<?php

namespace App;

class Option
{
    private static array $cache = [];

    public function __construct(
        private readonly string $configName,
        private readonly string $configFolder = '/config'
    )
    {
    }

    public function get(string $key, $default = null): mixed
    {
        $options = explode('.', $key);
        if (empty($options)) {
            throw new \Exception('Ключ должен быть в формате "option.option..."');
        }

        if (!isset(self::$cache[$this->configName])) {
            $path = $_SERVER['DOCUMENT_ROOT'] . $this->configFolder. '/' . $this->configName . '.php';
            if (!file_exists($path)) {
                throw new \Exception("Файл конфига не найден: {$this->configName}");
            }
            self::$cache[$this->configName] = require $path;
        }

        $current = self::$cache[$this->configName];
        foreach ($options as $option) {
            if (is_array($current) && array_key_exists($option, $current)) {
                $current = $current[$option];
            } else {
                return $default;
            }
        }
        return $current;
    }
}