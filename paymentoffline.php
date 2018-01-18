<?php 
	include 'inc/header.php';
?>
<?php
	$login = Session::get("userlogin");
	if($login == false){
		header("Location:login.php");
	}
?>
<?php
  require 'vendor/autoload.php';

  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;

  define("AUTHORIZENET_LOG_FILE", "phplog");

function chargeCreditCard($amount)
{
    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName("7ZRy8r3t6ub5");
    $merchantAuthentication->setTransactionKey("235JBf4W7v5dxF9K");

    // Set the transaction's refId
    $refId = 'ref' . time();

    // Create the payment data for a credit card
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber("4111111111111111");
    $creditCard->setExpirationDate("2038-12");
    $creditCard->setCardCode("123");

    // Add the payment data to a paymentType object
    $paymentOne = new AnetAPI\PaymentType();
    $paymentOne->setCreditCard($creditCard);

    // Create order information
    $order = new AnetAPI\OrderType();
    $order->setInvoiceNumber("10101");
    $order->setDescription("Golf Shirts");

    // Set the customer's Bill To address
    $customerAddress = new AnetAPI\CustomerAddressType();
    $customerAddress->setFirstName("Ellen");
    $customerAddress->setLastName("Johnson");
    $customerAddress->setCompany("Souveniropolis");
    $customerAddress->setAddress("14 Main Street");
    $customerAddress->setCity("Pecan Springs");
    $customerAddress->setState("TX");
    $customerAddress->setZip("44628");
    $customerAddress->setCountry("USA");

    // Set the customer's identifying information
    $customerData = new AnetAPI\CustomerDataType();
    $customerData->setType("individual");
    $customerData->setId("99999456654");
    $customerData->setEmail("EllenJohnson@example.com");

    // Add values for transaction settings
    $duplicateWindowSetting = new AnetAPI\SettingType();
    $duplicateWindowSetting->setSettingName("duplicateWindow");
    $duplicateWindowSetting->setSettingValue("60");

    // Add some merchant defined fields. These fields won't be stored with the transaction,
    // but will be echoed back in the response.
    $merchantDefinedField1 = new AnetAPI\UserFieldType();
    $merchantDefinedField1->setName("customerLoyaltyNum");
    $merchantDefinedField1->setValue("1128836273");

    $merchantDefinedField2 = new AnetAPI\UserFieldType();
    $merchantDefinedField2->setName("favoriteColor");
    $merchantDefinedField2->setValue("blue");

    // Create a TransactionRequestType object and add the previous objects to it
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType("authCaptureTransaction");
    $transactionRequestType->setAmount($amount);
    $transactionRequestType->setOrder($order);
    $transactionRequestType->setPayment($paymentOne);
    $transactionRequestType->setBillTo($customerAddress);
    $transactionRequestType->setCustomer($customerData);
    $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
    $transactionRequestType->addToUserFields($merchantDefinedField1);
    $transactionRequestType->addToUserFields($merchantDefinedField2);

    // Assemble the complete transaction request
    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setTransactionRequest($transactionRequestType);

    // Create the controller and get the response
    $controller = new AnetController\CreateTransactionController($request);
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);


    if ($response != null) {
        // Check to see if the API request was successfully received and acted upon
        if ($response->getMessages()->getResultCode() == \SampleCode\Constants::RESPONSE_OK) {
            // Since the API request was successful, look for a transaction response
            // and parse it to display the results of authorizing the card
            $tresponse = $response->getTransactionResponse();

            if ($tresponse != null && $tresponse->getMessages() != null) {
                echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
                echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
                echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
                echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
                echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";
            } else {
                echo "Transaction Failed \n";
                if ($tresponse->getErrors() != null) {
                    echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                    echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
                }
            }
            // Or, print errors if the API request wasn't successful
        } else {
            echo "Transaction Failed \n";
            $tresponse = $response->getTransactionResponse();

            if ($tresponse != null && $tresponse->getErrors() != null) {
                echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
            } else {
                echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
                echo " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
            }
        }    } else {
        echo  "No response returned \n";
    }

    return $response;
}
?>
<?php
	
	if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
		$userID = Session::get("userID");
		chargeCreditCard($_GET['amount']);
		$insertOrder = $ct->orderProduct($userID);
		$delData = $ct->delUserCart();
		header("Location:success.php");
	}

?>
<style>
	.division{width: 50%;float:left;}
	.tblone{width: 550px;margin:0 auto; border:2px solid #ddd;}
	.tblone tr td { text-align: justify; }
	.tbltwo{float:right;text-align:left;width: 50%;border:2px solid #ddd;margin-right: 14px;margin-top: 12px;}
	.tbltwo tr td{text-align: justify;padding:  5px 10px;}
	.ordernow{padding-bottom: 30px;}
	.ordernow a{width: 200px; margin:20px auto 0;text-align: center; padding:5px;font-size:30px;display: block;background: #ff0000;color: #fff;border-radius:3px;}
</style>

	 <div class="main">
    	<div class="content">
    		<div class="section group">
    			<div class="division">
    				<table class="tblone">
							<tr>
								<th >No</th>
								<th >Product</th>
								<th >Price</th>
								<th >Quantity</th>
								<th >Total </th>
							</tr>
							<?php
								$getPro = $ct->getCartProduct();
								$sum = 0;
								$quantityadd = 0;
								if($getPro){
									$i = 0;
									while($result = $getPro->fetch_assoc()){
										$i++;
															
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['product_name']; ?></td>
								<td>$<?php echo $result['price']; ?></td>
								<td><?php echo $result['quantity']; ?></td>
							<td>
								$<?php 
									$total = $result['price'] * $result['quantity']; 
									echo $total;
								?>
									
							</td>
						
							</tr>
							<?php
								$sum = $sum + $total;
								$quantityadd = $quantityadd + $result['quantity'];
								Session::set("sum", $sum);
								Session::set("quantityadd", $quantityadd);
							?>
							<?php 

							 	} 
							 }
							?>		
						</table>
						<table class="tbltwo"  width="40%">
							<tr>
								<td>Sub Total</td>
								<td>:</td>
								<td>$ <?php 
											echo $sum;
									   ?>
								</td>
							</tr>
							<tr>
								<td>VAT : </td>
								<td>:</td>
								<td>10%( $<?php echo $vat = $sum * 0.1; ?>) </td>
							</tr>
							<tr>
								<td>Grand Total :</td>
								<td>:</td>
								<td>
									<?php
										$vat = $sum * 0.1;
										$gtotal = $sum + $vat;
										echo $gtotal;
									?>
								</td>
							</tr>
							<tr>
								<td>Quantity</td>
								<td>:</td>
								<td><?php echo $quantityadd ?></td>
							</tr>
					   </table>
    			</div>
    			<div class="division">
    				<?php 
    				$id = Session::get("userID");
    				$getdata = $user->getUserData($id);
    					if($getdata){
    						while($result = $getdata->fetch_assoc()){
    			?>
				<table class="tblone">
					<tr>
						<td colspan="3"><h2>Your Profile Details</h2></td>
					</tr>
					<tr>
						<td>Name</td>
						<td>:</td>
						<td><?php echo $result['user_name']?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><?php echo $result['user_email']?></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td>:</td>
						<td><?php echo $result['phone']?></td>
					</tr>
					<tr>
						<td>Zipcode</td>
						<td>:</td>
						<td><?php echo $result['zip']?></td>
					</tr>
					<tr>
						<td>Address</td>
						<td>:</td>
						<td><?php echo $result['billing_address']?></td>
					</tr>
					<tr>
						<td>State</td>
						<td>:</td>
						<td><?php echo $result['state']?></td>
					</tr>
					<tr>
						<td>Country</td>
						<td>:</td>
						<td><?php echo $result['country']?></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><a href="editprofile.php">Update Details</a></td>
					</tr>
					
				</table>
				<?php } }?>
    			</div>
 			</div>
 		</div>
 		<div class="ordernow"><a href="?orderid=order&amount=<?php echo $gtotal?>">Order</a></div>
 	</div>
<?php 
	include 'inc/footer.php';
?>

