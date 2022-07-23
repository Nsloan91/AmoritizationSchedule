<?php 
	/**
	 * AMORTIZATION CALCULATOR
	 */
	class CalculatePayment
	{
        var $amount; //amount of the loan
        var $rate; //percentage rate of the loan
        var $years; //number of years of the loan
        var $npmts; //number of payments of the loan
        var $mrate; //monthly interest rate
        var $tpmnt; //total amount paid on the loan
        var $tint; //total interest paid on the loan
        var $pmnt; //monthly payment of the loan
        var $HOI;
        var $Taxes;

        function calculateHOI($HomeownersInsurance=0)
        {
          $this->HOI = $HomeownersInsurance/12;
        }

        function calculateTaxes($PropertyTaxes=0)
        {
            $this->Taxes = $PropertyTaxes/12;
        }

        function amort($amount=0,$rate=0,$years=0){
            $this->amount=$amount; //amount of the loan
            $this->rate=$rate; //yearly interest rate in percent
            $this->years=$years; //length of loan in years
           if($amount*$rate*$years > 0)
           {
            $this->npmts=$years*12; //number of payments (12 per year)
            $this->mrate=$rate/1200; //monthly interest rate
            $this->pmnt=$amount*($this->mrate/(1-pow(1+$this->mrate,-$this->npmts))); //monthly payment
            $this->tpmnt=$this->pmnt * $this->npmts; //total amount paid at end of loan
            $this->tint=$this->tpmnt-$amount; //total amount of interest paid at end of loan
           }
           else
           {
            $this->pmnt=0;
            $this->npmts=0;
            $this->mrate=0;
            $this->tpmnt=0;
            $this->tint=0;
           }
        }
function GetHOI(){
    include_once "payment.php";
}
//displays the form to enter amount, rate and length of loan in years
function showForm(){
    print "<h1 align='center'>Amortization Schedule</h1>";
    print "<p align='center'> </p>";
    print "<form method='GET' name='amort'>";
    print "<table border='1' width='100%' height='40'>";
    print "<tr><td width='33%' align='center' height='35'>";
    print "<dl><dt>Amount of Loan</dt><dt>(in dollars, no commas)</dt>";
    print "<dt><input type='text' name='amount' value='$this->amount' align='top' maxlength='6' size='20'>";
    print "</dt></dl></td>";
    print "<td width='33%' height='35' align='center'>";
    print "<dl><dt>Annual Interest Rate</dt><dt>(in percent)</dt>";
    print "<dt><h1 align='center'>$this->rate</h1>";
    print "</dt></dl></td>";
    print "<td width='34%' height='35' align='center'>";
    print "<dl><dt>Length of Loan</dt><dt>(in years)</dt>";
    print "<dt><input type='text' name='years' value='$this->years' align='top' maxlength='2' size='20'>";
    print "</dt></dl></td></tr></table>";
    print "<td width='34%' height='35' align='center'>";
    print "<dl><dt>Homeowners Insurance</dt><dt>(in years)</dt>";
    print "<dt><input type='text' name='years' value='$this->years' align='top' maxlength='2' size='20'>";
    print "</dt></dl></td></tr></table>";
    print "<p><input type='submit' value='Click to submit.' align='middle'></form>";
    }
    
    //if $show is false:
    // displays:
    // monthly payment
    // number of payments in the loan
    // total paid at end of loan
    // total interest paid at end of loan
    //if $show is true:
    // displays: everything for false case plus the amortization table
    
    function showTable($show){      
    print "<table border='1' width='100%'>";
        print "<td width='25%' align='center'><dt>Total Payments</dt>";
          print "<dt>";
           print sprintf("$%01.2f",$this->tpmnt);
             print "</dt></td>";
        print "<td width='25%' align='center'><dt>Total Interest</dt>";
          print "<dt>";
           print sprintf("$%01.2f",$this->tint);
             print "</dt></td>";
    //print "</tr></table>";
    //print "<table border='1' width='100%'>";
    // print "<tr>";
    // print "<td width='33%' align='center'><dt>Monthly Interest Rate</dt>";
    // print "<dt>";
    // print sprintf("$%01.2f",$this->mrate*100);
    // print "</dt></td>";
    
        print "<td width='25%' align='center'><dt>Number of Monthly Payments</dt>";
          print "<dt>";
           print $this->npmts;
             print "</dt></td>";
    
        print "<td width='25%' align='center'><dt>Monthly Payment</dt>";
          print "<dt>";
          print sprintf("$%01.2f",$this->pmnt);
             print "</dt>";
        print "<td width='25%' align='center'><dt>Monthly Insurance</dt>";
         print "<dt>";
            print sprintf("$%01.2f",$this->HOI);
                print "</dt>";     
        print "<td width='25%' align='center'><dt>Monthly Property Taxes</dt>";
            print "<dt>";
              print sprintf("$%01.2f",$this->Taxes);
                print "</dt>";    
      print "</td></tr>";
    if($show){
      print "</table>";
      print "<table border='1' width='100%'><tr>";
      print "<td width='14%' align='center'>Payment Number</td>";
      print "<td width='14%' align='center'>Beginning Balance</td>";
      print "<td width='14%' align='center'>Interest Payment</td>";
      print "<td width='14%' align='center'>Principal Payment</td>";
      print "<td width='14%' align='center'>Ending Balance</td>";
      print "<td width='14%' align='center'>Cumulative Interest</td>";
      print "<td width='14%' align='center'>Cumulative Payments</td>";
     print "</tr>";
    
    $ebal = $this->amount;
    $ccint =0.0;
    $cpmnt = 0.0;
    
    for ($pnum = 1; $pnum <= $this->npmts; $pnum++){
      print "<tr>";
      print "<td width='14%' align='center'>$pnum</td>";
      $bbal = $ebal;
      print "<td width='14%' align='right'>$". sprintf("%01.2f",$bbal) . "</td>";
      $ipmnt = $bbal * $this->mrate;
      print "<td width='14%' align='right'>$" . sprintf("%01.2f",$ipmnt) . "</td>";
      $ppmnt = $this->pmnt - $ipmnt;
      print "<td width='14%' align='right'>$" . sprintf("%01.2f",$ppmnt) . "</td>";
      $ebal = $bbal - $ppmnt;
      print "<td width='14%' align='right'>$" . sprintf("%01.2f",$ebal) . "</td>";
      $ccint = $ccint + $ipmnt;
      print "<td width='14%' align='right'>$" . sprintf("%01.2f",$ccint) . "</td>";
      $cpmnt = $cpmnt + $this->pmnt;
      print "<td width='14%' align='right'>$" . sprintf("%01.2f",$cpmnt) . "</td>";
      print "</tr>";
     }
     print "</table>";
     }
    }

    }
?>