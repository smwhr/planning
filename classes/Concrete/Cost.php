<?php
namespace Concrete;

class Cost implements \Cost{
  private $number;

  public function __construct(... $args){

    \polymorph_check([
      ["has_1", \Literal\Numeric::class],
      ["all_are", \Literal\Numeric::class],
    ], ... $args);

    array_walk($args, function($arg){
      switch(true){
        case $arg instanceof \Literal\Name:
          $this->number = $arg;
          break;
      }
    });
  }

  public function number():\Literal\Numeric{
    return $this->number;
  }
}