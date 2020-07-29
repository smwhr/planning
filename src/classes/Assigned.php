<?php

interface Assigned{
  public function person(\Closure $cb);
  public function object(\Closure $cb);
}



