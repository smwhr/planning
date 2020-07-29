<?php
namespace Concrete;

class Cost implements \Cost{
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

  // as a Sum of Cost
  public function total(){
    return $this->number;
  }

  public function sumWith(\RightSumable $next):\Sum{
    $sum = new \Literal\SumOfNumber(... [
        $this->number,
        $next->number((fn($n) => $n))
    ]);
    return new static($sum);
  }
}