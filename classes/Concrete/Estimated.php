<?php
namespace Concrete;

class Estimated implements \Estimated{
  
  private $object;
  private $estimate;

  public function __construct(... $args){
    \polymorph_check([
      ["has_1", \Estimate::class],
      ["has_1", \Estimable::class]
    ], ... $args);

    array_walk($args, function($arg){
      switch(true){
        case $arg instanceof \Estimable:
          $this->object = $arg;
          break;
        case $arg instanceof \Estimate:
          $this->estimate = $arg;
          break;
      }
    });
  }

  public function number():\Literal\Number{
    return $this->estimate->number();
  }

  public function estimate():\Estimate{
    return $this->estimate;
  }

  public function object():\Estimable{
    return $this->object;
  }
}