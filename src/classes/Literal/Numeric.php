<?php

namespace Literal;

interface Numeric extends \RightSumable{
  public function asString():string;
  public function asInt():int;
  public function asFloat():float;

}