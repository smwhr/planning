<?php

namespace TypeClass;

class SumOf implements \Sum, \Sumable{

  private $concrete_type;

  public function __construct($concrete_type, ... $args){
      $this->concrete_type = $concrete_type;
      \Polymorph\check([
        ["all_are", $this->concrete_type],
        ["tails_all_are", \RightSumable::class],
      ], ... $args);

      $this->operands = $args;
  }

  public function total(){
    $ops = $this->operands;
    $head = array_shift($ops);

    return array_reduce($ops,function($carry, $next){
      return $carry->sumWith($next);
    }, $head);
  }

  public function sumWith(\RightSumable $next):\Sum{
    return new static($this->concrete_type, 
                      ... [... $this->operands, $next]
                     );
  }
}