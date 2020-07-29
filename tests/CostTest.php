<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;


final class CostTest extends TestCase{

    public function testCanCreateCost():void
    {
        $literal_cost = new \Literal\Number(5);

        $this->assertInstanceOf(
          Cost::class, (new \Concrete\Cost($literal_cost))
        );
    }

    public function testCanSumTwoCost():void
    {
        $literal_cost1 = new \Literal\Number(2); 
        $literal_cost2 = new \Literal\Number(3);    
        $cost1 = new \Concrete\Cost($literal_cost1);
        $cost2 = new \Concrete\Cost($literal_cost2);

        // add 2 cost
        $sum2 = $cost1->sumWith($cost2);

        //expected result
        $literal_total2 = new \Literal\Number(5); 
        $expected2 = new \Concrete\Cost($literal_total2);
        
        // sum of costs is a cost
        $this->assertInstanceOf(
          Cost::class, $sum2
        );

        // should match value of expected sum
        $this->assertEquals(
          $sum2->total()->asInt(), 
          $expected2->total()->asInt()
        );

        $literal_cost3 = new \Literal\Number(4);
        $cost3 = new \Concrete\Cost($literal_cost3);

        // add new cost to sum
        $sum3 = $sum2->sumWith($cost3);

        $literal_total3 = new \Literal\Number(9); 
        $expected3 = new \Concrete\Cost($literal_total3);

        // sum + cost = cost
        $this->assertInstanceOf(
          Cost::class, $sum3
        );

        // should match value of expected sum
        $this->assertEquals(
          $sum3->total()->asInt(), 
          $expected3->total()->asInt()
        );

    }


    public function testCanSumMultipleCost():void
    {
        $literal_cost1 = new \Literal\Number(2); 
        $literal_cost2 = new \Literal\Number(3);   
        $literal_cost3 = new \Literal\Number(4);    
        $cost1 = new \Concrete\Cost($literal_cost1);
        $cost2 = new \Concrete\Cost($literal_cost2);
        $cost3 = new \Concrete\Cost($literal_cost3);

        $sumof = new \TypeClass\SumOf(\Concrete\Cost::class, $cost1, $cost2, $cost3);

        echo "\====== before total =======\n";

        $costs = $sumof->total(); //extract concrete type total

        echo "\====== after total =======\n";
        $this->assertInstanceOf(
          Cost::class, $costs
        );

        echo "\====== before compute =======\n";
        $number = $costs->total()->asInt();
        var_dump($number);
        // $this->assertEquals(
        //   $costs->total()->asInt(), 
        //   9
        // );
        echo "\====== after compute =======\n";
    }
}