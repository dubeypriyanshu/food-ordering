<?php
session_start();
$apikey="rzp_test_XdyWGN1pgsXHh5";
$amount=$_SESSION['payment'];   
$amount2=$amount*100;
?>

<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<form action="order.php" method="post">
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $apikey;?>"
    data-amount="<?php echo $amount2;?>"
    data-currency="INR"
    data-id="1001"
    data-buttontext="Pay With Razorpay"
    data-name="wowFood"
    data-description="Online Food ordering"
    data-image=""
    data-prefill.name="Priyanshu Dubey"
    data-prefill.email="dubeyspriyanshu@gmail.com"
    data-prefill.contact="8425824835"
    data-theme.color="#0e90e4">
</script>
<input type="hidden" custom="Hidden Element" name="hidden">
</form>
<style>
    .razorpay-payment-button {display:none;}
</style>
<script>
    $(document).ready(function(){
        $('.razorpay-payment-button').click()
    });
</script>