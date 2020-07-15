<?php
namespace Literal;

class SumOfNumber implements Numeric{
  private $operands = [];
  
  public function __construct(...$args){
    \polymorph_check([
      ["all_are", \Literal\Numeric::class],
    ], ... $args);

    $this->operands = $args;
  }
  public function asFloat():float{
    return
    array_reduce($this->operands, function($carry, $operand){
      return $carry + $operand->asFloat();
    }, 0);
  }

  public function asString():string{
    return strval($this->asFloat());
  }
  public function asInt():int{
    return intval($this->asFloat());
  }
  
}