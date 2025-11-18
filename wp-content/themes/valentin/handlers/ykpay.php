<?php 

	$arr=array();
	$arr=$_POST;
	foreach ($arr as $key => $value) {
	${$key}=$value;
	
$file = 'data_string.txt';
$current = file_get_contents($file);
$current .= "$key=$value\n";
file_put_contents($file, $current);	
/**/	
	};







//print_r(__DIR__);

require __DIR__ . '/lib/autoload.php'; 


    //use YandexCheckout\Client;
	use YooKassa\Client;

$client = new Client();
    $client->setAuth('812330', 'live_njErnuAzM6s2_XVUhvD4G69Z_4ReUvh1BrxUzk4f_wA');
    $payment = $client->createPayment(
        array(
            'amount' => array(
                'value' => $sum,
                'currency' => 'RUB',
            ),
			 'receipt' => array(
				'customer' => array(
                    'email' => $email,
               
				
                ),
                "items" => array(
                    array(
                        "description" => "Диплом с сайта deti-svet.ru",
                        "quantity" => "1.00",
                        "amount" => array(
                            "value" => $sum,
                            "currency" => "RUB"
                        ),
                        "vat_code" => "1",
                        "payment_mode" => "full_prepayment",
                        "payment_subject" => "commodity"
                    )
                )
            ),
            'confirmation' => array(
                'type' => 'redirect',
                'return_url' => 'https://deti-svet.ru/skachat-diplom/',
            ),
            'capture' => true,
            'description' => $label,
        ),
        uniqid('', true)
    );
	//wp_redirect( 'https://example.com/some/page' );
	echo($payment->confirmation->confirmation_url);
	//wp_redirect($payment->confirmation->confirmation_url);
	
	echo  ''
?>

	

