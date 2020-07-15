<?php 
namespace Concrete;

class Step implements \Step{

  private $name;

  public function __construct(... $args){
    
    \polymorph_check([
      ["has_1", \Literal\Name::class]
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
    return $this->name();
  }
}