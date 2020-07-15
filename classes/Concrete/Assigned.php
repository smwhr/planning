<?php
namespace Concrete;

class Assigned implements \Assigned{
  
  private $object;
  private $person;

  public function __construct(... $args){
    \polymorph_check([
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

  public function person():\Person{
    return $this->person;
  }

  public function object():\Assignable{
    return $this->object;
  }
}