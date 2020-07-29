<?php
namespace Concrete;

class Deadline implements \Literal\Date{
  private $end;

  public function __construct($end){
    $this->end = $end;
  }

  public function asString(){
    return (new ImmutableDateTime($this->end))->format("Y-m-d");
  }

}