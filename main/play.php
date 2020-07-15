<?php
declare(strict_types=1);
assert_options(ASSERT_BAIL,     true);

require_once("vendor/autoload.php");
require_once("functions/functions.php");

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

$spinter_steps = [
  new \Concrete\Step(new Literal\Name("Mise à niveau")),
  new \Concrete\Step(new Literal\Name("Stock de consignation")),
  new \Concrete\Step(new Literal\Name("Stock conjoint")),
  new \Concrete\Step(new Literal\Name("Transfert FIFO")),
  new \Concrete\Step(new Literal\Name("Étiquettes")),
  new \Concrete\Step(new Literal\Name("Relance facture")),
  new \Concrete\Step(new Literal\Name("Listes de prix")),
  new \Concrete\Step(new Literal\Name("Admin restreint")),
  new \Concrete\Step(new Literal\Name("Substitutions de commande")),
  new \Concrete\Step(new Literal\Name("Maquettes PDF")),
  new \Concrete\Step(new Literal\Name("CAPTCHA inscription")),
  new \Concrete\Step(new Literal\Name("Paiement CB Mon Compte")),
  new \Concrete\Step(new Literal\Name("Price override usurpation")),
  new \Concrete\Step(new Literal\Name("Mail compta")),
  new \Concrete\Step(new Literal\Name("Dashboard Admin")),
  new \Concrete\Step(new Literal\Name("Maintenance/Correctifs")),
  new \Concrete\Step(new Literal\Name("Mise-en-ligne")),
];

$spinter_estimates = [
  new \Concrete\Estimate(new Literal\Number(2)),
  new \Concrete\Estimate(new Literal\Number(6)),
  new \Concrete\Estimate(new Literal\Number(3)),
  new \Concrete\Estimate(new Literal\Number(0.5)),
  new \Concrete\Estimate(new Literal\Number(1)),
  new \Concrete\Estimate(new Literal\Number(1)),
  new \Concrete\Estimate(new Literal\Number(0.5)),
  new \Concrete\Estimate(new Literal\Number(1)),
  new \Concrete\Estimate(new Literal\Number(2)),
  new \Concrete\Estimate(new Literal\Number(1)),
  new \Concrete\Estimate(new Literal\Number(0.5)),
  new \Concrete\Estimate(new Literal\Number(1)),
  new \Concrete\Estimate(new Literal\Number(0.5)),
  new \Concrete\Estimate(new Literal\Number(0.5)),
  new \Concrete\Estimate(new Literal\Number(0.25)),
  new \Concrete\Estimate(new Literal\Number(1)),
  new \Concrete\Estimate(new Literal\Number(1)),
];

$spinter_assignTo = [
  $zamor,
  $zamor,
  $zamor,
  $zamor,
  $zamor,
  $zamor,
  $zamor,
  new \Concrete\Nobody(),
  $zamor,
  $zamor,
  $zamor,
  $zamor,
  $zamor,
  $zamor,
  $zamor,
  $zamor,
  new \Concrete\Nobody()
];

$spinter_estimatedsteps = array_map(function($step, $estimate){
  return new \Concrete\Estimated($estimate, $step);
}, $spinter_steps, $spinter_estimates);

$spinter_assignedsteps = array_map(function($step, $person){
  return new \Concrete\Assigned($person, $step);
}, $spinter_steps, $spinter_assignTo);

$sprinter = new Concrete\Project(
                          new Literal\Name("Sprinter V4"), 
                          new Concrete\Deadline("2020-10-15"),
                          ... $spinter_steps,
                          ... $spinter_estimatedsteps,
                          ... $spinter_assignedsteps
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


