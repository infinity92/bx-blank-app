<?php

namespace App;

interface Matchable extends Identifiable
{
    public function match(Matchable $entity): bool;
}