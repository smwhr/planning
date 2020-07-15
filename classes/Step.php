<?php

interface Step extends Estimable, Assignable{
  public function name():\Literal\Name;
}

