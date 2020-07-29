<?php

interface Project extends Estimable, Assignable{
  public function name():\Literal\Name;
  public function steps():\Literal\Date;
  public function end():\Literal\Date;


  public function brutDuration():\Literal\Numeric;
  public function brutCost():\Cost;
}