<?php

namespace App;

class Code implements Matchable
{
    public function __construct(
        private readonly string $code,
    )
    {
    }

    public function getId(): string
    {
        return $this->code;
    }

    public function match(Matchable $entity): bool
    {
        return $this->getId() === $entity->getId();
    }

    public function __toString(): string
    {
        return $this->code;
    }
}