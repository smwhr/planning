<?php

interface Cost extends Sum, Sumable, RightSumable{
  public function number(\Closure $cb);
  public function estimated(\Estimate $estimate);
}