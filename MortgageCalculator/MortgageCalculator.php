<!DOCTYPE html>
<html>
 
 <body>
    <form>
      <input type="number" name="MortgageTerm" placeholder="Mortgage Terms (In Years)"></input>
      <br>
      <input type="number" name="InterestRate" placeholder="Interest Rate"></input>
      <br>
      <input type="number" name="DownPayment" placeholder="Down Payment"></input>
      <br>
      <input type="number" name="MortgageAmount" placeholder="Loan Amount or Purchase Price"></input>
      <br>
      <input type="number" name="HomeownersInsurance" placeholder="Annual Homeowners Insurance"></input>
      <br>
      <input type="number" name="PropertyTaxes" placeholder="Annual Property Taxes"></input>
      <br>
      <button type="sumbit" name="submit" value="submit">Calculate</button>
    </form>

<p style="font-weight: bold">Payment Breakdown: </p>
<?php
  if (isset($_GET['submit'])){
   //Include files
    include_once ('Payment.php');
    include_once ('Amorititzation.php');

   //error handling on these fields
   //Gather user inputs
    number_format($MortgageTerm = $_GET['MortgageTerm'],2);
    number_format($InterestRate = $_GET['InterestRate'], 2 );
    number_format($DownPayment = $_GET['DownPayment'], 2);
    number_format($MortgageAmount = $_GET['MortgageAmount'], 2);
    number_format($HomeownersInsurance = $_GET['HomeownersInsurance'], 2);
    number_format($PropertyTaxes = $_GET['PropertyTaxes'], 2);
    
    //Calculate patments
    /*$PaymentCalc = new PaymentCalculator();
    $PaymentCalc ->CaluclateHOI($HomeownersInsurance);
    $PaymentCalc->CaluclatePropertyTaxes($PropertyTaxes);
    $PandI = $PaymentCalc->CaluclatePandI($MortgageAmount, $InterestRate, $DownPayment, $MortgageTerm );
    $PITI = $PaymentCalc->CaluclatePITI($PandI, $HomeownersInsurance, $PropertyTaxes );

   echo "Your payment with Taxes and Insurance included is $", $PITI, " a month.";
   echo "<br><br>";
   echo "Your principal and interest payment is $", $PandI, " a month."; */

   //Amorititzation Schedule below

  
   // This is an example of how to use class.amort.php class.
   
   include_once "testschedule.php";
   
   /*if (!$amount=$_GET['amount']){ //first time set all to zero
    $amount=0;
   }
   if (!$rate=$_GET['rate']){
    $rate=0;
   }
   if (!$years=$_GET['years']){
    $years=0;
   } */
   $am=new CalculatePayment($MortgageAmount,$InterestRate,$MortgageTerm, $HomeownersInsurance, $PropertyTaxes); //make an instance of amort and set the numbers
   //$am->showForm(); //show the form to get the numbers
   if($MortgageAmount*$InterestRate*$MortgageTerm <>0){
   $am->amort($MortgageAmount,$InterestRate,$MortgageTerm); //if any one is zero, don't show the table
   $am->calculateHOI($HomeownersInsurance);
   $am->calculateTaxes($PropertyTaxes);
   $am->showTable(true); //if true, show table, else don't
   }

    }
?>
 </body>
</html>