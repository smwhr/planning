<?php
namespace Concrete;

class Estimate implements \Estimate{
  private $number;

  public function __construct(... $args){

    \Polymorph\check([
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

  public function number(\Closure $cb){
    return $cb->bindTo(null, $this->number)($this->number);
  }

}