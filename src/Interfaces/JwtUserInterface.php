<?php


namespace HelloCash\HelloMicroservice\Interfaces;

interface JwtUserInterface
{

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getClaim(string $key);

    /**
     * @return int
     */
    public function getLevel():int;

}
