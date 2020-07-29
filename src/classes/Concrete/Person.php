<?php
namespace Concrete;

class Person implements \Person{
  private $name;
  private $cost;

  public function __construct(... $args){
    \Polymorph\check([
      ["has_1", \Literal\Name::class],
      ["has_1", \Cost::class],
      ["has_atmost1", \Deadline::class]
    ], ... $args);

    array_walk($args, function($arg){
      switch(true){
        case $arg instanceof \Literal\Name:
          $this->name = $arg;
          break;

      }
    });
  }

  public function name():\Literal\Name{
    return $this->name;
  }
  public function cost():\Cost{
    return $this->cost;
  }

  public function do(Estimated $task):Cost{

  }

}