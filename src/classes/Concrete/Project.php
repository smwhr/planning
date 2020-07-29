<?php
namespace Concrete;

class Project{

  private $name;
  private $start;
  private $end;
  private $steps = [];
  private $estimates = [];
  private $assignments = [];

  public function __construct(... $args){

    \Polymorph\check([
      ["has_atmost1", \Literal\Name::class],
      ["has_atmost1", \KickOff::class],
      ["has_atmost1", \Deadline::class]
    ], ... $args);

    array_walk($args, function($arg){
      switch(true){
        case $arg instanceof \Literal\Name:
          $this->name = $arg;
          break;
        case $arg instanceof \KickOff:
          $this->start = $arg;
          break;
        case $arg instanceof \Deadline:
          $this->end = $arg;
          break;
        case $arg instanceof \Step:
          $this->steps[] = $arg;
          break;
        case $arg instanceof \Estimated:
          assert(in_array($arg->object(), $this->steps, true));
          $this->estimates[] = $arg;
          break;
        case $arg instanceof \Assigned:
          assert(in_array($arg->object(), $this->steps, true));
          $this->assignments[] = $arg;
          break;
      }

    });
  }

  public function brutDuration():\Literal\Numeric{
    return new \Literal\SumOfNumber(... array_map(function(Estimated $estimate){
      return $estimate->number();
    }, $this->estimates));
  }

  public function brutCost():\Cost{
    return new \Concrete\Cost(
                new \Literal\SumOfNumber(
                  ... array_map(
                        function(Estimated $estimate, Assigned $assignment):\Literal\Number{
                          return $estimate->number((fn($x) => $x));
                        }, $this->estimates, $this->assignments)
                )
              );
  }

}