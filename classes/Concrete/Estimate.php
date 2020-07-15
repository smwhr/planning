<?php
namespace Concrete;

class Estimate implements \Estimate{
  private $number;

  public function __construct(... $args){

    \polymorph_check([
      ["has_1", \Literal\Numeric::class],
      ["all_are", \Literal\Numeric::class],
    ], ... $args);

    array_walk($args, function($arg){
      switch(true){
        case $arg instanceof \Literal\Numeric:
          $this->number = $arg;
          break;
      }
    });
  }

  public function number():\Literal\Numeric{
    return $this->number;
  }
}