<?php

function has_count($items, $type, $predicate_fn){
  return $predicate_fn(count(array_filter($items, function($item) use ($type){
      return $item instanceof $type;
    })));
}

function has_atleast1($items, $type){
  return has_count($items, $type, fn($x) => $x >= 1);
}

function has_atmost1($items, $type){
  return has_count($items, $type, fn($x) => $x <= 1);
}

function has_1($items, $type){
  return has_count($items, $type, fn($x) => $x == 1);
}

function all_are($items, $type){
  return count(array_filter($items, function($item) use ($type){
    return !($item instanceof $type);
  })) == 0;
}

function polymorph_check($checklist, ...$args){
  foreach($checklist as $check){
    $check_fn = array_shift($check);
    $check_type = array_shift($check);
    assert($check_fn($args, $check_type, ...$check), new \Exception("Failed assert ".$check_fn." ".$check_type));
  }
}