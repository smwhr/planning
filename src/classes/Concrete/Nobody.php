<?php
namespace Concrete;

class Nobody implements \Person{

  public function name():\Literal\Name{
    return new \Literal\Name("Anonymous");
  }
  public function cost():\Cost{
    return new Cost(\Literal\Number(0));
  }
}