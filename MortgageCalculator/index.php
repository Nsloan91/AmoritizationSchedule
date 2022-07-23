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
    $MortgageTerm = $_GET['MortgageTerm'];
    $InterestRate = $_GET['InterestRate'];
    $DownPayment = $_GET['DownPayment'];
    $MortgageAmount = $_GET['MortgageAmount'];
    $HomeownersInsurance = $_GET['HomeownersInsurance'];
    $PropertyTaxes = $_GET['PropertyTaxes'];
    
    //Calculate patments
    $PaymentCalc = new PaymentCalculator();
    $PaymentCalc ->CaluclateHOI($HomeownersInsurance);
    $PaymentCalc->CaluclatePropertyTaxes($PropertyTaxes);
    $PandI = $PaymentCalc->CaluclatePandI($MortgageAmount, $InterestRate, $DownPayment, $MortgageTerm );
    $PITI = $PaymentCalc->CaluclatePITI($PandI, $HomeownersInsurance, $PropertyTaxes );

   echo "Your payment with Taxes and Insurance included is $", $PITI, " a month.";
   echo "<br><br>";
   echo "Your principal and interest payment is $", $PandI, " a month.";

   //Amorititzation Schedule below

   $data = array(
		'loan_amount' 	=> $MortgageAmount,
		'term_years' 	=> $MortgageTerm ,
		'interest' 		=> $InterestRate,
		'terms' 		=> $MortgageTerm * 12
		);

	$amortization = new Amortization($data);

    }
?>
 </body>
</html>