<?php
namespace Literal;

class SumOfNumber implements Numeric, \Sum{
  private $operands = [];
  
  public function __construct(...$args){
    \Polymorph\check([
      ["all_are", \Literal\Numeric::class],
    ], ... $args);

    $this->operands = $args;
  }
  public function asFloat():float{
    return $this->total()->asFloat();
  }

  public function asString():string{
    return $this->total()->asString();
  }
  public function asInt():int{
    return $this->total()->asInt();
  }

  public function total(){
    return
    new \Literal\Number(array_reduce($this->operands, function($carry, $operand){
      return $carry + $operand->asFloat();
    }, 0));
  }
  
}