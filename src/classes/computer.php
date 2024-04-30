<?php

namespace Classes;

class Computer
{
    private $hmacKey;
    private $move;
    private $hmac;

    public function __construct(int $count)
    {
        $this->hmacKey = bin2hex(random_bytes(32));
        $this->move = rand(0, $count - 1);
        $this->hmac = hash_hmac('SHA3-256', $this->move + 1, $this->hmacKey);
    }

    public function getHmacKey(): string
    {
        return $this->hmacKey;
    }

    public function getMove(): string
    {
        return $this->move;
    }

    public function getHmac(): string
    {
        return $this->hmac;
    }
}
