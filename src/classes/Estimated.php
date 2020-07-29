<?php

interface Estimated{
  public function estimate(\Closure $cb):\Estimate;
  public function object(\Closure $cb):\Estimable;
  
}



