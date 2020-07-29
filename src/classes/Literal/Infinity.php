<?php

namespace Literal;

class Infinity implements Numeric{
  private $number;

  public function __construct(){
    $this->number = INF;
  }

  public function asString():string{
    return "Infinity";
  }

  public function asInt():int{
    return INF;
  }
  public function asFloat():float{
    return floatval($this->number);
  }
}