<?php

interface Project extends Estimable{
  public function name():\Literal\Name;
  public function steps():\Date;
  public function end():\Date;


  public function brutDuration():\Literal\Numeric;
  public function brutCost():\Cost;
}