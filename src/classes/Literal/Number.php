<?php

namespace Literal;

class Number implements Numeric{
  private $number;

  public function __construct($number){
    $this->number = $number;
  }

  public function asString():string{
    return strval($this->number);
  }

  public function asInt():int{
    return intval($this->number);
  }
  public function asFloat():float{
    return floatval($this->number);
  }
}