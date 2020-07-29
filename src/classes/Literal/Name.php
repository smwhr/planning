<?php

namespace Literal;


class Name{
  private $name;

  public function __construct($name){
    $this->name = $name;
  }

  public function asString(){
    return $this->name;
  }
}