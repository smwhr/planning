<?php declare(strict_types=1);
assert_options(ASSERT_BAIL,     true);

require_once("vendor/autoload.php");

$zamor =   new \Concrete\Person(
                      new \Literal\Name("Julien Z"),
                      new \Concrete\Cost(new \Literal\Number(4542.95)),
                     );
$desgris = new \Concrete\Person(
                      new \Literal\Name("Pauline D"),
                      new \Concrete\Cost(new \Literal\Number(4899.84)),
                     );
$droulez = new \Concrete\Person(
                      new \Literal\Name("Julien D"),
                      new \Concrete\Cost(new \Literal\Number(3879.73)),
                     );
$pellan =  new \Concrete\Person(
                      new \Literal\Name("Thomas P"),
                      new \Concrete\Cost(new \Literal\Number(4255.15)),
                     );

$sprinter_quote_lines = [
  [
    new Literal\Name("Mise à niveau"),
    new Literal\Number(2),
    $zamor
  ],
  [
    new Literal\Name("Stock de consignation"),
    new Literal\Number(6),
    $pellan
  ],
  [
    new Literal\Name("Stock conjoint"),
    new Literal\Number(3),
    $pellan
  ],
  [
    new Literal\Name("Transfert FIFO"),
    new Literal\Number(0.5),
    $droulez
  ],
  [
    new Literal\Name("Étiquettes"),
    new Literal\Number(1),
    $pellan
  ],
  [
    new Literal\Name("Relance facture"),
    new Literal\Number(1),
    $pellan
  ],
  [
    new Literal\Name("Listes de prix"),
    new Literal\Number(0.5),
    $pellan
  ],
  [
    new Literal\Name("Admin restreint"),
    new Literal\Number(1),
    $droulez
  ],
  [
    new Literal\Name("Substitutions de commande"),
    new Literal\Number(2),
    $pellan
  ],
  [
    new Literal\Name("Maquettes PDF"),
    new Literal\Number(1),
    $droulez
  ],
  [
    new Literal\Name("CAPTCHA inscription"),
    new Literal\Number(0.5),
    $droulez
  ],
  [
    new Literal\Name("Paiement CB Mon Compte"),
    new Literal\Number(1),
    $zamor
  ],
  [
    new Literal\Name("Price override usurpation"),
    new Literal\Number(0.5),
    $pellan
  ],
  [
    new Literal\Name("Mail compta"),
    new Literal\Number(0.5),
    $pellan
  ],
  [
    new Literal\Name("Dashboard Admin"),
    new Literal\Number(0.25),
    $droulez
  ],
  [
    new Literal\Name("Maintenance/Correctifs"),
    new Literal\Number(1),
    $droulez
  ],
  [
    new Literal\Name("Mise-en-ligne"),
    new Literal\Number(1),
    $zamor
  ],
];


$spinter_quote = array_map(function($quote_line){
  [$tep_name, $estimate_number, $assignee] = $quote_line;
  $estimate = new \Concrete\Estimate($estimate_number);
  $step     = new \Concrete\Step($tep_name);
  return 
  [
    "step"           => $step,
    "estimatedstep" => new \Concrete\Estimated($estimate, $step),
    "assignedstep"  => new \Concrete\Assigned($assignee, $step)
  ];
 
}, $sprinter_quote_lines);


$sprinter = new Concrete\Project(
                          new Literal\Name("Sprinter V4"), 
                          new Concrete\Deadline("2020-10-15"),
                          ... array_column($spinter_quote, "step"),
                          ... array_column($spinter_quote, "estimatedstep"),
                          ... array_column($spinter_quote, "assignedstep"),
                        );
$duration = $sprinter->brutDuration();
echo $duration->asFloat();
echo  PHP_EOL;

$cost = $sprinter->brutCost();
echo $cost->number()->asFloat();
echo  PHP_EOL;

$nikon = new Concrete\Project(
                        new Literal\Name("Nikon"), 
                        new Concrete\KickOff("2020-10-15")
                    );


