<?php
namespace Concrete;

class KickOff implements \Literal\Date{
  private $start;

  public function __construct($start){
    $this->start = $start;
  }

  public function asString(){
    return (new ImmutableDateTime($this->start))->format("Y-m-d");
  }
}