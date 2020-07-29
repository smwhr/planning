<?php
namespace Concrete;

class Assigned implements \Assigned{
  
  private $object;
  private $person;

  public function __construct(... $args){
    \Polymorph\check([
      ["has_1", \Person::class],
      ["has_1", \Assignable::class]
    ], ... $args);

    array_walk($args, function($arg){
      switch(true){
        case $arg instanceof \Assignable:
          $this->object = $arg;
          break;
        case $arg instanceof \Person:
          $this->person = $arg;
          break;
      }
    });
  }


  public function object(\Closure $cb){
    return $cb->bind($this)($this->_object());
  }
  public function person(\Closure $cb){
    return $cb->bind($this)($this->_person());
  }

  private function _person():\Person{
    return $this->person;
  }

  private function _object():\Estimable{
    return $this->object;
  }
}