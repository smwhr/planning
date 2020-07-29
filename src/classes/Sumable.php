<?php

interface Sumable{
  public function sumWith(RightSumable $next):\Sum;
}