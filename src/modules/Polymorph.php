<?php
namespace Polymorph{

  class AssertException extends \Exception{
    public function __construct($check_fn, $check_type){

      list($here, $childClass, $caller) = debug_backtrace(false, 3);
      $caller_class = $caller["class"];

      $message = sprintf("Failed assert %s %s in class %s", $check_fn, $check_type, $caller_class);
      parent::__construct($message);  
    }
  }

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

  function tails_all_are($items, $type){
    $head = array_shift($items);
    return count(array_filter($items, function($item) use ($type){
      return !($item instanceof $type);
    })) == 0;
  }

  function check($checklist, ...$args){
    foreach($checklist as $check){
      $check_fn = "\Polymorph\\".array_shift($check);
      $check_type = array_shift($check);
      assert($check_fn($args, $check_type, ...$check), new AssertException($check_fn, $check_type));
    }
  }
}