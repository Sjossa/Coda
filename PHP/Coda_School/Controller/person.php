<?php
/**
* @var PDO $pdo
 */
require './Model/Person.php';

if(isset($_GET['action']) &&
    $_GET['action'] == 'edit' &&
    isset($_GET['id']) && is_numeric($_GET['id']))
{
    $id = cleanCodeString($_GET['id']);
    $res = getPerson($pdo, $id);
    if(!is_array($res)) {
        $errors[] = $res;
    }
}

if(!empty($_SERVER['HTTP_X_REQUESTED_WIDTH']) &&
    $_SERVER['HTTP_X_REQUESTED_WIDTH'] === 'XMLHttpRequest'
) {
    switch($_GET['action']) {
        case 'new':
            $last_name = isset($_POST['last_name']) ? cleanCodeString($_POST['last_name']) : null;
            $first_name = isset($_POST['first_name']) ? cleanCodeString($_POST['first_name']) : null;
            $address = isset($_POST['address']) ? cleanCodeString($_POST['address']) : null;
            $city = isset($_POST['city']) ? cleanCodeString($_POST['city']) : null;
            $zip_code = isset($_POST['zip_code']) ? cleanCodeString($_POST['zip_code']) : null;
            $phone = isset($_POST['phone']) ? cleanCodeString($_POST['phone']) : null;
            $type = isset($_POST['type']) ? intval(cleanCodeString($_POST['type'])) : null;

            if(($last_name && $first_name && $address && $city && $zip_code && $phone && $type) !== null) {
                $res = setPerson($pdo, $last_name, $first_name, $address, $city, $zip_code, $phone, $type);
                header('Content-type: application/json');
                if($res === true) {
                    echo json_encode(['success' => true]);
                    exit();
                } else {
                    echo json_encode(['success' => false, 'error' => $res]);
                    exit();
                }
            }

            break;
        case 'edit':
            $last_name = isset($_POST['last_name']) ? cleanCodeString($_POST['last_name']) : null;
            $first_name = isset($_POST['first_name']) ? cleanCodeString($_POST['first_name']) : null;
            $address = isset($_POST['address']) ? cleanCodeString($_POST['address']) : null;
            $city = isset($_POST['city']) ? cleanCodeString($_POST['city']) : null;
            $zip_code = isset($_POST['zip_code']) ? cleanCodeString($_POST['zip_code']) : null;
            $phone = isset($_POST['phone']) ? cleanCodeString($_POST['phone']) : null;
            $type = isset($_POST['type']) ? intval(cleanCodeString($_POST['type'])) : null;
            $id = isset($_GET['id']) ? intval(cleanCodeString($_GET['id'])) : null;

            if(($last_name && $first_name && $address && $city && $zip_code && $phone && $type) !== null) {
                $res = updatePerson($pdo, $last_name, $first_name, $address, $city, $zip_code, $phone, $type, $id);
                if($res === true) {
                    header('Content-type: application/json');
                    echo json_encode(['success' => true]);
                    exit();
                } else {
                    header('Content-type: application/json');
                    echo json_encode(['success' => false, 'error' => $res]);
                    exit();
                }
            }
            break;
    }
}

require './View/Person.php';