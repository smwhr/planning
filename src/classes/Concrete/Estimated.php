<?php
namespace Concrete;

class Estimated implements \Estimated{
  
  private $object;
  private $estimate;

  public function __construct(... $args){
    \Polymorph\check([
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

  public function object(\Closure $cb){
    return $cb->bind(null, $this->_object())($this->_object());
  }
  public function estimate(\Closure $cb){
    return $cb->bind(null, $this->_estimate())($this->_estimate());
  }

  private function _estimate():\Estimate{
    return $this->estimate;
  }

  private function _object():\Estimable{
    return $this->object;
  }
}