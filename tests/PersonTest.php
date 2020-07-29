<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;


final class PersonTest extends TestCase{

    public function testCanCreatePerson():void
    {
        $literal_name = new \Literal\Name("Jojo");
        $literal_cost = new \Literal\Number(2000);

        $person_cost = new \Concrete\Cost($literal_cost);

        $this->assertInstanceOf(
            Person::class, 
            (new \Concrete\Person($literal_name, 
                                  $person_cost
                                 )
            )
        );
    }
}