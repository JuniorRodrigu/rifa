<?php

$access_token = "APP_USR-3991797296774206-031222-f217118f51717132e996df82d7046ec0-200617663";

// verificar se há uma notificação de pagamento
if(isset($_POST['type']) && $_POST['type'] == 'payment') {
  
  // obter o ID do pagamento a partir da notificação
  $payment_id = $_POST['data']['id'];
  
  // obter o status do pagamento a partir da notificação
  $status = $_POST['data']['status'];
  
  // verificar se o status é aprovado
  if($status == 'approved') {
    
    // redirecionar para a página desejada
    header('Location: https://www.youtube.com/' . $payment_id);
    exit();
    
  }
  
}

// verificar se o ID do pagamento foi recebido na URL
if(isset($_GET['payment_id'])) {
  
  $payment_id = $_GET['payment_id'];

  include_once 'mercadopago/lib/mercadopago/vendor/autoload.php';

  MercadoPago\SDK::setAccessToken($access_token);

  $payment = MercadoPago\Payment::find_by_id($payment_id);

  // verificar se o pagamento foi aprovado
  if($payment->status == 'approved') {
    // redirecionar para a página desejada
    header('Location: https://seusite.com/pagina-de-agradecimento.php');
    exit();
  }
  
}

// se não houver notificação de pagamento, realizar o pagamento
if(isset($_POST['pix'])){

  if($_POST['pix']){
  
    $valor = $_POST['total']; // atribuir o valor recebido à variável $valor

    include_once 'mercadopago/lib/mercadopago/vendor/autoload.php';

    MercadoPago\SDK::setAccessToken($access_token);

    $payment = new MercadoPago\Payment();
    $payment->description = 'Pagamento Nome';
    $payment->transaction_amount = (double)$valor;
    $payment->payment_method_id = "pix";

    $payment->notification_url   = 'https://seusite.com/notification.php';
    $payment->external_reference = '1520';

    $payment->payer = array(
      "email" => 'emailcliente@gmail.com',
      "first_name" => 'Primeiro nome do cliente',
      "address"=>  array(
        "zip_code" => "06233200",
        "street_name" => "Av. das Nações Unidas",
        "street_number" => "3003",
        "neighborhood" => "Bonfim",
        "city" => "Osasco",
        "federal_unit" => "SP"
      )
    );

    $payment->save();

    echo json_encode($payment->point_of_interaction);

  }else{
    echo json_encode(array(
      'status'  => 'error',
      'message' => 'pix required'
    ));
    exit;
  }

}else{
  echo json_encode(array(
    'status'  => 'error',
    'message' => 'pix not found'
  ));
  exit;
}
