<?php
namespace Literal;

class Day{
  public function __construct($date){
    $this->date = $date;
  }

  public function asString(){
    return (new DateTimeImmutable($this->date))->format("Y-m-d H:i:s");
  }
  
}