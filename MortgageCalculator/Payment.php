<?php 
    class PaymentCalculator {

        public function CaluclatePandI($MortgageAmount, $InterestRate, $DownPayment, $MortgageTerm)
        {
            $Rate = $InterestRate/100;
            $LoanAmount = $MortgageAmount - $DownPayment;
            
            $PandI =  $LoanAmount * (1+ $Rate * $MortgageTerm);
            $TotalTerm = $MortgageTerm * 12;
         
            return $PandI = number_format($PandI / $TotalTerm, 2);

        }
        public function CaluclatePITI($PandI, $HomeownersInsurance, $PropertyTaxes)
        {
            return $PITI = number_format($PandI + $HomeownersInsurance + $PropertyTaxes, 2);
        }
        public function CaluclateHOI($HomeownersInsurance)
        {
            return $HomeownersInsurance = $HomeownersInsurance/12;
        }     
        public function CaluclatePropertyTaxes($PropertyTaxes)
        {
           return $PropertyTaxes = $PropertyTaxes /12;
        } 

    }
?>