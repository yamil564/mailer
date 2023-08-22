<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of prueba
 *
 * @author User
 */

use Square\SquareClient;
use Square\Models\Money;
use Square\Models\CreatePaymentRequest;
use Square\Exceptions\ApiException;
use Ramsey\Uuid\Uuid;

class Order extends Controllers
{
    public function seeAllOrder()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $lstOrder = $this->model->listOrder();
                $this->views->getView($this, "seeAllOrder", $lstOrder);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function viewOrder()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $idSearchOrder = decrypted(end($url));
                $lstOrder = $this->model->searchOrder($idSearchOrder);
                $designCamp = $lstOrder['id_postcard'] != '' ? 'id_postcard' : 'id_model';
                $idDesign = $lstOrder['id_postcard'] != '' ? $lstOrder['id_postcard'] : $lstOrder['id_model'];
                $lstBaseFields = $this->model->searchBaseFields($designCamp, $idDesign);
                $lstCustomBaseFields = $this->model->searchCustomBaseFields($idSearchOrder);
                $lstMultimediaFiles = $this->model->searchMultimediaFiles($designCamp, $idDesign);
                foreach ($lstMultimediaFiles as $multimedia) {
                    $lstContentfields[] = $this->model->searchContentFields($multimedia['id_multimedia']);
                }
                $lstTargeting = $this->model->searchTargeting($idSearchOrder);
                $lstCustomContentFields = $this->model->searchCustomContentFields($idSearchOrder);
                $lstCustomMultimediaFiles = $this->model->searchCustomMultimedia($idSearchOrder);
                $this->views->getView($this, "viewOrder", [
                    'order' => $lstOrder, 'baseFields' => $lstBaseFields, 'customBaseFields' => $lstCustomBaseFields, 'multimediaFiles' => $lstMultimediaFiles,
                    'contentFields' => $lstContentfields, 'customContentFields' => $lstCustomContentFields, 'CustomMultimediaFiles' => $lstCustomMultimediaFiles,
                    'targeting' => $lstTargeting
                ]);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function deleteOrder()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST) || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $idOrder = decrypted($_POST['order']);
                $multimediaFiles = $this->model->searchCustomMultimedia($idOrder);
                if (!empty($multimediaFiles)) {
                    foreach ($multimediaFiles as $multimediaFile) {
                        if ($this->model->deleteMultimedia($multimediaFile['id_order_multimedia'])) {
                            delete_old_file($multimediaFile['url']);
                        }
                    }
                    echo 'Successfully removed';
                } else {
                    echo 'Files have already been deleted or no files have been uploaded by the user';
                }
            }
        } catch (Exception $ex) {
            echo 'Unexpected error, Contact administrator';
        }
    }

    public function orderModel()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_SESSION['client'])) {
                header(HOME);
                exit();
            } else {
                $cboSize = strClean($_POST['cboSize']);
                $idModel = decrypted($_POST['model']);
                $model = $this->model->searchModel($idModel);
                $instruccionsFields = $this->model->searchInstruccionsFields('id_model', $idModel);
                $baseFields = $this->model->searchBaseFields('id_model', $idModel);
                $multimediaFiles = $this->model->searchMultimediaFiles('id_model', $idModel);
                foreach ($multimediaFiles as $multimedia) {
                    $contentFields[] = $this->model->searchContentFields($multimedia['id_multimedia']);
                }

                $this->views->getView($this, 'custom_order', [
                    'model' => $model, 'instruccionsFields' => $instruccionsFields, 'baseFields' => $baseFields,
                    'multimediaFiles' => $multimediaFiles, 'contentFields' => $contentFields, 'cboSize' => $cboSize
                ]);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function orderPostcard()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_SESSION['client'])) {
                header(HOME);
                exit();
            } else {
                $cboSize = strClean($_POST['cboSize']);
                $idPostcard = decrypted($_POST['postcard']);
                $lstPostcard = $this->model->searchPostcard($idPostcard);
                $instruccionsFields = $this->model->searchInstruccionsFields('id_postcard', $idPostcard);
                $baseFields = $this->model->searchBaseFields('id_postcard', $idPostcard);
                $multimediaFiles = $this->model->searchMultimediaFiles('id_postcard', $idPostcard);
                foreach ($multimediaFiles as $multimedia) {
                    $contentFields[] = $this->model->searchContentFields($multimedia['id_multimedia']);
                }
                $this->views->getView($this, 'postcard_order', [
                    'postcard' => $lstPostcard, 'instruccionsFields' => $instruccionsFields, 'baseFields' => $baseFields,
                    'multimediaFiles' => $multimediaFiles, 'contentFields' => $contentFields, 'cboSize' => $cboSize
                ]);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function orderModelOverview()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_SESSION['client'])) {
                header(HOME);
                exit();
            } else {
                $_POST['order'] = unserialize(decrypted($_POST['order']));
                $design = $this->model->searchProduct($_POST['order']['model']['id_subsection']);
                $_POST = change_key($_POST, 'order', 'ModelData');
                $idSizeField = strClean($_POST['ModelData']['cboSize']);
                $price = $this->model->searchSizeFields($idSizeField);
                foreach ($_FILES as $temporal) {
                    (!empty($temporal['tmp_name'])) ? move_uploaded_file($temporal['tmp_name'], $temporal['tmp_name']) : "";
                }
                $this->views->getView($this, "summary_custom_order", ['design' => $design, 'modelCustomDesign' => $_POST, 'modelFiles' => $_FILES, 'price' => $price[0]['price']]);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function selectLocationsOnMap()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST) || empty($_SESSION['client'])) {
                header(HOME);
                exit();
            } else {
                $_POST['postcard'] = unserialize(decrypted($_POST['postcard']));
                $_POST = change_key($_POST, 'postcard', 'PostcardData');
                foreach ($_FILES as $copyFile) {
                    (!empty($copyFile['tmp_name'])) ? move_uploaded_file($copyFile['tmp_name'], $copyFile['tmp_name']) : "";
                }
                $idSizeField = strClean(array_column($_POST, 'cboSize')[0]);
                $price = $this->model->searchSizeFields($idSizeField);
                $this->views->getView($this, "targeting", ['postcardCustomDesign' => $_POST, 'customFiles' => $_FILES, 'price' => $price[0]['price']]);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function orderPostcardOverview()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST) || empty($_SESSION['client'])) {
                header(HOME);
                exit();
            } else {
                !empty($_FILES['file_direction']['name']) ? move_uploaded_file($_FILES['file_direction']['tmp_name'], $_FILES['file_direction']['tmp_name']) : "";
                $_POST['order'] = unserialize(decrypted($_POST['order']));
                $_POST = change_key($_POST, 'order', 'PostcardFiles');
                $design = $this->model->searchProduct($_POST['PostcardFiles']['postcardCustomDesign']['PostcardData']['postcard']['id_subsection']);
                $idSizeField = strClean(array_column($_POST['PostcardFiles']['postcardCustomDesign'], 'cboSize')[0]);
                $price = $this->model->searchSizeFields($idSizeField);
                $this->views->getView($this, "summary_postcard_order", ['design' => $design, 'LocationsOnMap' => $_POST, 'listExcel' => $_FILES['file_direction'], 'price' => $price[0]]);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function confirmModelOverview()
    {
        try {
            echo "<script>document.querySelector('input[type=submit]').setAttribute('disabled', true);</script>";
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_SESSION['client'])) {
                header(HOME);
                exit();
            } else {
                $typeOrder = strClean($_POST['typeOrder']);
                $_POST['summary'] = unserialize(decrypted(strClean($_POST['summary'])));
                $salesTax = strClean($_POST['salesTax']);
                $idPromotionalCode = '';
                if (!empty($_POST['txtCode'])) {
                    $idPromotionalCode = $this->model->searchPromotionalCode($_POST['txtCode'])['id_promotional_code'];
                }
                $subtotal = strClean($_POST['subtotal']);
                $total = strClean($_POST['total']);
                $duetoday = strClean($_POST['duetoday']);
                $accountLimit = strClean($_POST['limit']);
                $accountCurrent = strClean($_POST['current']);
                if ($duetoday > 0) {
                    $this->views->getView($this, "payment", [
                        'type' => 'model', 'summary' => $_POST['summary'], 'salesTax' => $salesTax,
                        'promotionalCode' => $idPromotionalCode, 'subtotal' => $subtotal, 'total' => $total,
                        'duetoday' => $duetoday, 'accountLimit' => $accountLimit, 'accountCurrent' => $accountCurrent
                    ]);
                } else {
                    $resultOrder = $this->addModelOrder($_POST['summary'], $salesTax, $idPromotionalCode, $subtotal, $total, $duetoday);
                    if ($resultOrder) {
                        $resultBaseFields = $this->addOrderBaseFields($typeOrder, $resultOrder, $_POST['summary']);
                        $resultMultimediaFiles = $this->addOrderMultimediaFiles($typeOrder, $resultOrder, $_POST['summary']);
                        $resultContentFields = $this->addOrderContentFields($typeOrder, $resultOrder, $_POST['summary']);
                        $resultMovements = $this->addMovements($resultOrder, $total, $accountLimit, $accountCurrent);
                        if ($resultBaseFields && $resultMultimediaFiles && $resultContentFields && $resultMovements) {
                            $dateOrder = $this->model->getOrderDate($resultOrder);
                            emailAlert($resultOrder, $_SESSION['client']['id_limited_account'], $_SESSION['client']['id_current_account'], $_SESSION['client']['first_name'] . ' ' . $_SESSION['client']['last_name'], $subtotal, $total, $dateOrder['order_date']);
                            $data = ['message' => 'Successfully Order', 'route' => base_url()];
                        }
                    } else {
                        $data = ['message' => 'Unsuccessful Order (Contact with administrator)'];
                    }
                    echo json_encode($data);
                }
            }
        } catch (Exception $ex) {
            $data = ['message' => 'Unexpected error, Contact administrator'];
            echo json_encode($data);
        }
    }

    public function confirmPostcardOverview()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_SESSION['client'])) {
                header(HOME);
                exit();
            } else {
                $typeOrder = strClean($_POST['typeOrder']);
                $_POST['summary'] = unserialize(decrypted(strClean($_POST['summary'])));
                $salesTax = strClean($_POST['salesTax']);
                $idPromotionalCode = '';
                if (!empty($_POST['txtCode'])) {
                    $idPromotionalCode = $this->model->searchPromotionalCode($_POST['txtCode'])['id_promotional_code'];
                }
                $subtotal = strClean($_POST['subtotal']);
                $total = strClean($_POST['total']);
                $duetoday = strClean($_POST['duetoday']);
                $accountLimit = strClean($_POST['limit']);
                $accountCurrent = strClean($_POST['current']);
                if ($duetoday > 0) {
                    $this->views->getView($this, "payment", [
                        'type' => 'postcard', 'summary' => $_POST['summary'], 'salesTax' => $salesTax,
                        'promotionalCode' => $idPromotionalCode, 'subtotal' => $subtotal, 'total' => $total,
                        'duetoday' => $duetoday, 'accountLimit' => $accountLimit, 'accountCurrent' => $accountCurrent
                    ]);
                } else {
                    $resultOrder = $this->addPostcardOrder($_POST['summary'], $salesTax, $idPromotionalCode, $subtotal, $total, $duetoday);
                    if ($resultOrder) {
                        $resultBaseFields = $this->addOrderBaseFields($typeOrder, $resultOrder, $_POST['summary']);
                        $resultMultimediaFiles = $this->addOrderMultimediaFiles($typeOrder, $resultOrder, $_POST['summary']);
                        $resultContentFields = $this->addOrderContentFields($typeOrder, $resultOrder, $_POST['summary']);
                        $resultTargetFields = $this->addTargetFields($resultOrder, $_POST['summary']);
                        $resultMovements = $this->addMovements($resultOrder, $total, $accountLimit, $accountCurrent);
                        if ($resultBaseFields && $resultMultimediaFiles && $resultContentFields && $resultTargetFields && $resultMovements) {
                            $dateOrder = $this->model->getOrderDate($resultOrder);
                            emailAlert($resultOrder, $_SESSION['client']['id_limited_account'], $_SESSION['client']['id_current_account'], $_SESSION['client']['first_name'] . ' ' . $_SESSION['client']['last_name'], $subtotal, $total, $dateOrder['order_date']);
                            $data = ['message' => 'Successfully Order', 'route' => base_url()];
                        }
                    } else {
                        $data = ['message' => 'Unsuccessful Order (Contact with administrator)'];
                    }
                    echo json_encode($data);
                }
            }
        } catch (Exception $ex) {
            $data = ['message' => 'Unexpected error, Contact administrator'];
            echo json_encode($data);
        }
    }

    public function process_payment()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_SESSION['client'])) {
            http_response_code(405);
            header(HOME);
            exit();
        } else {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $token = $data->token;
            $type = decrypted($data->type);
            $summary = unserialize(decrypted($data->summary));
            $salesTax = $data->salesTax;
            $promotionalCode = $data->promotionalCode;
            $subtotal = $data->subtotal;
            $total = $data->total;
            $duetoday = $data->duetoday;
            $accountLimit = $data->accountLimit;
            $accountCurrent = $data->accountCurrent;
            $square_client = new SquareClient([
                'accessToken' => getenv('SQUARE_ACCESS_TOKEN'),
                'environment' => getenv('ENVIRONMENT')
            ]);
            $payments_api = $square_client->getPaymentsApi();
            $money = new Money();
            $money->setAmount(floatval($duetoday) * 100);
            //$money->setAmount(1);
            $money->setCurrency($GLOBALS['location_info']->getCurrency());
            try {
                $create_payment_request = new CreatePaymentRequest($token, Uuid::uuid4(), $money);
                $response = $payments_api->createPayment($create_payment_request);
                if ($response->isSuccess()) {
                    if ($type == 'model') {
                        $resultOrder = $this->addModelOrder($summary, $salesTax, $promotionalCode, $subtotal, $total, $duetoday);
                        if ($resultOrder) {
                            $resultBaseFields = $this->addOrderBaseFields($type, $resultOrder, $summary);
                            $resultMultimediaFiles = $this->addOrderMultimediaFiles($type, $resultOrder, $summary);
                            $resultContentFields = $this->addOrderContentFields($type, $resultOrder, $summary);
                            $resultMovements = $this->addMovements($resultOrder, $total, $accountLimit, $accountCurrent);
                            if ($resultBaseFields && $resultMultimediaFiles && $resultContentFields && $resultMovements) {
                                $dateOrder = $this->model->getOrderDate($resultOrder);
                                emailAlert($resultOrder, $_SESSION['client']['id_limited_account'], $_SESSION['client']['id_current_account'], $_SESSION['client']['first_name'] . ' ' . $_SESSION['client']['last_name'], $subtotal, $total, $dateOrder['order_date']);
                                $data = ['message' => 'Successfully Order', 'route' => base_url() ];
                            }
                        } else {
                            $data = ['message' => 'Unsuccessful Order (Contact with administrator)'];
                        }
                    }else {
                        $resultOrder = $this->addPostcardOrder($summary, $salesTax, $promotionalCode, $subtotal, $total, $duetoday);
                        if ($resultOrder) {
                            $resultBaseFields = $this->addOrderBaseFields($type, $resultOrder, $summary);
                            $resultMultimediaFiles = $this->addOrderMultimediaFiles($type, $resultOrder, $summary);
                            $resultContentFields = $this->addOrderContentFields($type, $resultOrder, $summary);
                            $resultTargetFields = $this->addTargetFields($resultOrder, $summary);
                            $resultMovements = $this->addMovements($resultOrder, $total, $accountLimit, $accountCurrent);
                            if ($resultBaseFields && $resultMultimediaFiles && $resultContentFields && $resultTargetFields && $resultMovements) {
                                $dateOrder = $this->model->getOrderDate($resultOrder);
                                emailAlert($resultOrder, $_SESSION['client']['id_limited_account'], $_SESSION['client']['id_current_account'], $_SESSION['client']['first_name'] . ' ' . $_SESSION['client']['last_name'], $subtotal, $total, $dateOrder['order_date']);
                                $data = ['message' => 'Successfully Order', 'route' => base_url() ];
                            }
                        } else {
                            $data = ['message' => 'Unsuccessful Order (Contact with administrator)'];
                        }
                    }
                    echo json_encode($data);
                } else {
                    echo json_encode(array('errors' => $response->getErrors()));
                }
            } catch (ApiException $ex) {
                echo json_encode(array('errors' => $ex));
            }
        }
    }

    public function addModelOrder($summary, $salesTax, $idPromotionalCode, $subtotal, $total, $duetoday)
    {
        try {
            if (empty($_SESSION['client'])) {
                return false;
            } else {
                $client = $_SESSION['client'];
                $idModel = strClean(array_column($summary['modelCustomDesign']['ModelData'], 'id_model')[0]);
                $mls = isset($summary['modelCustomDesign']['txtMlsId']) ? $summary['modelCustomDesign']['txtMlsId'] : '';
                $request = strClean($summary['modelCustomDesign']['Request']);
                $agent = isset($summary['modelCustomDesign']['validateAgent']) ? $summary['modelCustomDesign']['validateAgent'] : '';
                return $this->model->addNewOrder($client['id_client'], 'id_model', $idModel, $mls, $request, $salesTax, '', 0, $idPromotionalCode, $subtotal, $total, $duetoday, $agent, date("Y-m-d H:i:s"));
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function addPostcardOrder($summary, $salesTax, $idPromotionalCode, $subtotal, $total, $duetoday)
    {
        try {
            if (empty($_SESSION['client'])) {
                return false;
            } else {
                $client = $_SESSION['client'];
                $idPostcard = strClean(array_column($summary['LocationsOnMap']['PostcardFiles']['postcardCustomDesign']['PostcardData'], 'id_postcard')[0]);
                $mls = isset(array_column($summary['LocationsOnMap']['PostcardFiles'], 'txtMlsId')[0]) ? array_column($summary['LocationsOnMap']['PostcardFiles'], 'txtMlsId')[0] : '';
                $request = strClean(array_column($summary['LocationsOnMap']['PostcardFiles'], 'Request')[0]);
                $agent = isset(array_column($summary['LocationsOnMap']['PostcardFiles'], 'validateAgent')[0]) ? array_column($summary['LocationsOnMap']['PostcardFiles'], 'validateAgent')[0] : '';
                return $this->model->addNewOrder($client['id_client'], 'id_postcard', $idPostcard, $mls, $request, $salesTax, 'First Class', 0, $idPromotionalCode, $subtotal, $total, $duetoday, $agent, date("Y-m-d H:i:s"));
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function addMovements($idOrder, $total, $accountLimit, $accountCurrent)
    {
        try {
            if (empty($_SESSION['client'])) {
                return false;
            } else {
                $client = $_SESSION['client'];
                // Si el total es menor al saldo disponible de la cuenta limite
                if ($total <= $accountLimit) {
                    $idLimitedAccount = $client['id_limited_account'];
                    // balance limite
                    $limitedBalance = $client['limit_balance'];
                    // balance usado
                    $balanceUsed = $client['used_balance'];
                    //nuevo balance usado
                    $currentBalanceUsed = $balanceUsed + $total;
                    $idMovementLa = $this->model->addMovementsLa($idLimitedAccount, $idOrder, $total, $limitedBalance, $balanceUsed, $currentBalanceUsed, date("Y-m-d H:i:s"));
                    if ($idMovementLa) {
                        $resultLimitedAccount = $this->model->updateLimitedAccount($currentBalanceUsed, $idLimitedAccount);
                        $_SESSION['client'] = $this->model->updateSessionClient($client['id_client']);
                        if ($resultLimitedAccount && $_SESSION['client']) {
                            return true;
                        }
                    }
                    //si el total es mayor menor que la resta del sando de la cuenta corriente menos el balance limite
                } elseif ($accountCurrent >= ($total - $accountLimit) + $client['limit_balance']) {
                    $idLimitedAccount = $client['id_limited_account'];
                    // limite de la cuenta limite
                    $limitedBalance = $client['limit_balance'];
                    // balance usado de la cuenta limite
                    $balanceUsed = $client['used_balance'];
                    // balance disponible de la cuenta limite
                    $balanceAvailable = $limitedBalance - $balanceUsed;

                    $idCurrentAccount = $client['id_current_account'];
                    //saldo disponible de la cuenta corriente
                    $currentBalance = $client['current_balance'];
                    //nuevo saldo disponible de la cuenta corriente es igual al balance menos el total del pedido
                    $newCurrentBalance = $currentBalance - (($total - $balanceAvailable) + $limitedBalance);
                    $idMovementLa = $this->model->addMovementsLa($idLimitedAccount, $idOrder, $total, $limitedBalance, $balanceUsed, $balanceAvailable, date("Y-m-d H:i:s"));
                    $idMovementCa = $this->model->addMovementsCa($idCurrentAccount, $idOrder, $total, $currentBalance, $newCurrentBalance, date("Y-m-d H:i:s"));
                    if ($idMovementCa) {
                        $resultLimitedAccount = $this->model->updateLimitedAccount(0, $idLimitedAccount);
                        $resultCurrentAccount = $this->model->updateCurrentAccount($newCurrentBalance, $idCurrentAccount);
                        $_SESSION['client'] = $this->model->updateSessionClient($client['id_client']);
                        if ($resultCurrentAccount && $_SESSION['client']) {
                            return true;
                        }
                    }
                    // si el total es mayor que ambas cuentas
                } else {
                    $idLimitedAccount = $client['id_limited_account'];
                    $limitedBalance = $client['limit_balance'];
                    $balanceUsed = $client['used_balance'];
                    $idCurrentAccount = $client['id_current_account'];
                    $currentBalance = $client['current_balance'];
                    // balance disponible de la cuenta limite
                    $balanceAvailable = $limitedBalance - $balanceUsed;
                    $idMovementLa = $this->model->addMovementsLa($idLimitedAccount, $idOrder, $total, $limitedBalance, $balanceUsed, $balanceAvailable, date("Y-m-d H:i:s"));
                    $idMovementCa = $this->model->addMovementsCa($idCurrentAccount, $idOrder, $total, $currentBalance, 0, date("Y-m-d H:i:s"));
                    if ($idMovementLa && $idMovementCa) {
                        $resultLimitedAccount = $this->model->updateLimitedAccount(0, $idLimitedAccount);
                        $resultCurrentAccount = $this->model->updateCurrentAccount(0, $idCurrentAccount);
                        $_SESSION['client'] = $this->model->updateSessionClient($client['id_client']);
                        if ($resultLimitedAccount && $resultCurrentAccount && $_SESSION['client']) {
                            return true;
                        }
                    }
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function addOrderBaseFields($typeOrder, $idOrder, $lstPost)
    {
        if ($typeOrder != 'postcard') {
            $lstBaseFields = array_column($lstPost['modelCustomDesign']['ModelData']['baseFields'], 'id_base_fields');
            $lstCustomFields = $lstPost['modelCustomDesign'];
        } else {
            $lstBaseFields = array_column($lstPost['LocationsOnMap']['PostcardFiles']['postcardCustomDesign']['PostcardData']['baseFields'], 'id_base_fields');
            $lstCustomFields = $lstPost['LocationsOnMap']['PostcardFiles']['postcardCustomDesign'];
        }
        foreach ($lstCustomFields as $key => $value) {
            if (strpos($key, 'text_') !== false) {
                $lstCustomBaseFields[] = strClean($value);
            }
        }
        if (!empty($lstBaseFields) && isset($lstCustomBaseFields)) {
            $positionBaseField = 0;
            foreach ($lstBaseFields as $baseFields) {
                $response = $this->model->addOrderBaseFields($idOrder, $baseFields, $lstCustomBaseFields[$positionBaseField]);
                ++$positionBaseField;
            }
        } else {
            $response = true;
        }

        return $response;
    }

    public function addOrderMultimediaFiles($typeOrder, $idOrder, $lstPost)
    {
        if ($typeOrder != 'postcard') {
            $lstMultimediaFiles = $lstPost['modelFiles'];
        } else {
            $lstMultimediaFiles = $lstPost['LocationsOnMap']['PostcardFiles']['customFiles'];
        }
        if (!empty($lstMultimediaFiles)) {
            foreach ($lstMultimediaFiles as $key => $value) {
                if (strpos($key, 'btnFileagent') !== false) {
                    $url = upload_file($value, 'Agents');
                } else {
                    $url = upload_file($value, 'Clients');
                }
                $response = !empty($url) ? $this->model->addOrderMultimediaFiles($idOrder, $url) : true;
            }
        } else {
            $response = true;
        }
        return $response;
    }

    public function addOrderContentFields($typeOrder, $idOrder, $lstPost)
    {
        if ($typeOrder != 'postcard') {
            $lstOrderContent = $lstPost['modelCustomDesign']['ModelData']['contentFields'];
            $lstCustomFields = $lstPost['modelCustomDesign'];
        } else {
            $lstOrderContent = $lstPost['LocationsOnMap']['PostcardFiles']['postcardCustomDesign']['PostcardData']['contentFields'];
            $lstCustomFields = $lstPost['LocationsOnMap']['PostcardFiles']['postcardCustomDesign'];
        }
        foreach ($lstOrderContent as $contentField) {
            foreach ($contentField as $cellContent) {
                $lstContentfields[] = strClean($cellContent['id_content_fields']);
            }
        }
        foreach ($lstCustomFields as $key => $value) {
            if (strpos($key, 'custom_') !== false) {
                $lstCustomContentFields[] = strClean(formatEnterTextArea($value));
            }
        }
        if (!empty($lstOrderContent) && isset($lstContentfields) && isset($lstCustomContentFields)) {
            $positionContentField = 0;
            foreach ($lstContentfields as $contentFields) {
                $response = $this->model->addOrderContentFields($idOrder, $contentFields, $lstCustomContentFields[$positionContentField]);
                ++$positionContentField;
            }
        } else {
            $response = true;
        }
        return $response;
    }

    public function addTargetFields($idOrder, $lstPost)
    {
        $numberTarget = strClean($lstPost['LocationsOnMap']['txtNumber_target']);
        $type = strClean($lstPost['LocationsOnMap']['rbType']);
        $bedrooms = strClean($lstPost['LocationsOnMap']['CrBedrooms_min']) . '-' . strClean($lstPost['LocationsOnMap']['CrBedrooms_max']);
        $squareFootage = strClean($lstPost['LocationsOnMap']['CrSquare_footage_min']) . '-' . strClean($lstPost['LocationsOnMap']['CrSquare_footage_max']);
        $yearBuilt = strClean($lstPost['LocationsOnMap']['CrYear_built_min']) . '-' . strClean($lstPost['LocationsOnMap']['CrYear_built_max']);
        $yearLast = strClean($lstPost['LocationsOnMap']['CrYear_last_min']) . '-' . strClean($lstPost['LocationsOnMap']['CrYear_last_max']);
        $lastSold = strClean($lstPost['LocationsOnMap']['CrLast_sold_min']) . '-' . strClean($lstPost['LocationsOnMap']['CrLast_sold_max']);
        $excelFile = upload_file($lstPost['listExcel'], 'List_directions');
        $location = isset($lstPost['LocationsOnMap']['txtLocation']) ? strClean($lstPost['LocationsOnMap']['txtLocation']) : '';
        $polygon = isset($lstPost['LocationsOnMap']['polygon']) ? strClean($lstPost['LocationsOnMap']['polygon']) : '';
        return $this->model->addTargetFields($idOrder, $numberTarget, $type, $bedrooms, $squareFootage, $yearBuilt, $yearLast, $lastSold, $location, $polygon, $excelFile);
    }
}
