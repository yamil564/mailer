<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/*
* funcion para extraer la url base de proyecto
*/

function base_url()
{
    return BASE_URL;
}

/*
* funcion para extraer la url de los archivos de diseño
*/
function media()
{
    return BASE_URL . 'Assets/';
}

/*
* funcion para extraer la cabecera del administrador de
* los archivos de la vista
*/

function head_admin()
{
    $view_nav = "Views/Sections_admin/head.php";
    require_once($view_nav);
}

/*
* funcion para extraer la barra de navegacion del 
* administrador de los archivos de la vista
*/

function nav_admin()
{
    $view_nav = "Views/Sections_admin/nav_bar.php";
    require_once($view_nav);
}

/*
* funcion para extraer el sidebar del administrador de
* los archivos de la vista
*/

function sidebar_admin()
{
    $view_nav = "Views/Sections_admin/side_bar.php";
    require_once($view_nav);
}

/*
* funcion para extraer el footer del administrador de
* los archivos de la vista
*/

function footer_admin()
{
    $view_nav = "Views/Sections_admin/footer.php";
    require_once($view_nav);
}

/*
* funcion para extraer la cabecera del administrador de
* los archivos de la vista
*/

function head_user()
{
    $view_nav = "Views/Sections_user/head.php";
    require_once($view_nav);
}

/*
* funcion para extraer la barra de navegacion del 
* administrador de los archivos de la vista
*/

function nav_user()
{
    $view_nav = "Views/Sections_user/nav_bar.php";
    require_once($view_nav);
}

/*
* funcion para extraer el footer del administrador de
* los archivos de la vista
*/

function footer_user()
{
    $view_nav = "Views/Sections_user/footer.php";
    require_once($view_nav);
}

/*
 * funcion para visualizar los datos en forma de lista
 */
function dep($data)
{
    $format = print_r("<pre>");
    $format .= print_r($data);
    $format .= print_r("</pre>");
    return $format;
}

/* funciona para limpiar cadenas de texto de caracteres o script no
 * deseados.
 */
function strClean($cadena)
{
    $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $cadena);
    $string = trim($string);
    $string = stripslashes($string);
    $string = str_ireplace("<script>", "", $string);
    $string = str_ireplace("</script>", "", $string);
    $string = str_ireplace("<script src>", "", $string);
    $string = str_ireplace("<script type=>", "", $string);
    $string = str_ireplace("SELECT * FROM", "", $string);
    $string = str_ireplace("DELETE FROM", "", $string);
    $string = str_ireplace("INSERT INTO", "", $string);
    $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
    $string = str_ireplace("DROP TABLE", "", $string);
    $string = str_ireplace("OR '1'='1", "", $string);
    $string = str_ireplace('OR "1"="1"', "", $string);
    $string = str_ireplace('OR ´1´=´1´', "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("LIKE '", "", $string);
    $string = str_ireplace('LIKE "', "", $string);
    $string = str_ireplace("LIKE ´", "", $string);
    $string = str_ireplace("OR 'a'='a", "", $string);
    $string = str_ireplace('OR "a"="a"', "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("--", "", $string);
    $string = str_ireplace("^", "", $string);
    $string = str_ireplace("[", "", $string);
    $string = str_ireplace("]", "", $string);
    $string = str_ireplace("==", "", $string);
    return $string;
}

/* 
 * funcion para generar contraseñas aleatorias con con un maximo de 10 
 * caracteres.
 */
function passGenerator($length = 10)
{
    $pass = "";
    $longitudpass = $length;
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $longitudcadena = strlen($cadena);
    for ($i = 1; $i <= $longitudpass; $i++) {
        $pos = rand(0, $longitudcadena - 1);
        $pass .= substr($cadena, $pos, 1);
    }
    return $pass;
}

/*
 * funcion de creación de un toquen usando 4 valores aleatorios con un 
 * tamaño de 10 caracteres por valor
 */
function token()
{
    $r1 = bin2hex(random_bytes(10));
    $r2 = bin2hex(random_bytes(10));
    $r3 = bin2hex(random_bytes(10));
    $r4 = bin2hex(random_bytes(10));
    return $r1 . "-" . $r2 . "-" . $r3 . "-" . $r4;
}

/*
 * funcion para setear una cantidad a un formato de moneda donde 
 * formatMoney recibe(el valor, la cantida de decimales, caracter
 * a utilizar,caracter a reemplazar).
 */
function formatMoney($cantidad)
{
    $cantidad = number_format($cantidad, 2, SPD, SPM);
    return $cantidad;
}

function formatAccount($accountNumber)
{
    return sprintf("%'.07d\n", $accountNumber);
}

function formatEnterTextArea($cadena)
{
    return str_replace(array("\r\n", "\r", "\n"), "<br />", $cadena);
}

function formatOutTextArea($cadena)
{
    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $cadena);
}

function formatDate($date)
{
    $date = date_create($date);
    return date_format($date, "d/m/Y H:i:s");
}



function emailAlert($idOrder, $idLimitedAccount, $idCurrentAccount, $fullname, $subtotal, $total, $dateOrder)
{
    
    $client = $_SESSION['client'];
    
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Port = 587;
    $mail->Host = "smtp.gmail.com";
    $mail->Username = "yamil.delgado@knd.pe";
    $mail->Password = "2023@264Y";
    
    $mail->From = 'marketing2@smartrealtymd.com';
    $mail->FromName = 'smartreservices.com';
    $mail->addAddress('marketing@smartrealtymd.com');
    $mail->addAddress('luisponce@smartrealtymd.com');
    $mail->addAddress($client['email']);
    $mail->addAddress('luz.cabrejos@knd.pe');
    $mail->Subject = "New Order N.-" . formatAccount($idOrder);
    $mail->WordWrap = 80;

    $mail->Body = $html_msg;
    $mail->AltBody = $alt_msg;
    $body = "
    <!DOCTYPE html>
    <html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='x-apple-disable-message-reformatting'>
        <title>Document</title>
        <!--[if mso]>
    <noscript>
    <xml>
        <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    </noscript>
    <![endif]-->
        <style>
            table,td,div,h1,p {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>
    <body style='margin:0;padding:0;'>
        <table role='presentation' style='max-width: 1140px;width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;'>
            <tr>
                <td style='padding:25px 0; background: linear-gradient(104.19deg, rgba(37, 1, 83, 0) 39.91%, #3b0388 77.15%), linear-gradient(96.54deg, rgba(6, 189, 196, 0.78) 13.14%, rgba(2, 214, 215, 0) 57.93%), #440496;'>
                    <img src='" . media() . "logo/logo-sr.svg' width='200' style='height:auto;display:block;' alt='Logo'>
                </td>
            </tr>
            <tr>
                <td style='padding:3em;'>
                    <h2 style='margin:0;text-align:center;font-size: 2rem;line-height: 1.2;'>Order N° - " . formatAccount($idOrder) . "</h2>
                    <hr style='height:2px;margin: 1rem 0;border: 0;background: #000;'>
                    <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                        <tbody style='font-size: 1.5em; font-weight: 300;'>
                            <tr>
                                <td style='padding:0;'>
                                    <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                                        <tr>
                                            <td style='width:260px;padding:1em 0em;vertical-align:top;'>
                                                <strong>Limited Account N°:</strong>
                                            </td>
                                            <td style='width:260px;padding:1em 0em;vertical-align:top;text-align:right;'>
                                                <strong>" . formatAccount($idLimitedAccount) . "</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='padding:0;'>
                                    <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                                        <tr>
                                            <td style='width:260px;padding:1em 0em;vertical-align:top;'>
                                                <strong>Current Account N°:</strong>
                                            </td>
                                            <td style='width:260px;padding:1em 0em;vertical-align:top;text-align:right;'>
                                                <strong>" . formatAccount($idCurrentAccount) . "</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='padding:0;'>
                                    <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                                        <tr>
                                            <td style='width:260px;padding:1em 0em;vertical-align:top;'>
                                                <strong>User:</strong>
                                            </td>
                                            <td style='width:260px;padding:1em 0em;vertical-align:top;text-align:right;'>
                                                <strong>" . $fullname . "</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='padding:0;'>
                                    <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                                        <tr>
                                            <td style='width:260px;padding:1em 0em;vertical-align:top;'>
                                                <strong>Order date:</strong>
                                            </td>
                                            <td style='width:260px;padding:1em 0em;vertical-align:top;text-align:right;'>
                                                <strong>" . formatDate($dateOrder) . "</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='padding:0;'>
                                    <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                                        <tr>
                                            <td style='width:260px;padding:1em 0em;vertical-align:top;'>
                                                <strong>Subtotal:</strong>
                                            </td>
                                            <td style='width:260px;padding:1em 0em;vertical-align:top;text-align:right;'>
                                                <strong>$" . $subtotal . "</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr style='height:2px;margin: 1rem 0;border: 0;background: #000;'>
                    <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                        <tbody style='font-size: 1.5em; font-weight: 300;'>
                            <tr>
                                <td style='padding:0;'>
                                    <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                                        <tr>
                                            <td style='width:260px;padding:1em 0em;vertical-align:top;'>
                                                <strong>Total:</strong>
                                            </td>
                                            <td style='width:260px;padding:1em 0em;vertical-align:top;text-align:right;'>
                                                <strong>$" . $total . "</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>";
    $mail->MsgHTML($body);
    $mail->IsHTML(true);
    $mail->Send();
    //indico destinatario
    //$mail->AddAddress('yamil.delgado@knd.pe', 'Yamil Delgado');
    // $mail->AddAddress('keysi.ato@knd.pe', 'Keysi Ato');
    if (!$mail->send()) {
        return 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        return true;
    }
}

function email($var)
{
    
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'luz.cabrejos@knd.pe';
        $mail->Password = '2023@264L';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Detalles del correo
        $mail->setFrom('luz.cabrejos@knd.pe', 'Antonella');
        $mail->addAddress('luz.cabrejos@knd.pe', 'Destinatario');
        $mail->Subject = 'Asunto del correo';
        $mail->Body = 'Hola';

        // Envío del correo
        $mail->send();
        echo 'El correo fue enviado correctamente.';
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
    if (!$mail->send()) {
        return 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        return true;
    }
}
function email2(array $arrvalues)
{
    
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'luz.cabrejos@knd.pe';
        $mail->Password = '2023@264L';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Detalles del correo
        $mail->setFrom('luz.cabrejos@knd.pe', 'Antonella');
        $mail->addAddress('luz.cabrejos@knd.pe', 'Destinatario');
        $mail->Subject = 'Asunto del correo';
        $cadena = implode(";", $arrvalues);
        $mail->Body = $cadena;

        // Envío del correo
        $mail->send();
        echo 'El correo fue enviado correctamente.';
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
    if (!$mail->send()) {
        return 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        return true;
    }
}

function change_key($array, $old_key, $new_key)
{
    if (!array_key_exists($old_key, $array)) {
        return $array;
    }
    $keys = array_keys($array);
    $keys[array_search($old_key, $keys)] = $new_key;
    return array_combine($keys, $array);
}

/*
 * funcion para subir una archivo a una carpeta donde upload_file recibe 
 * (los datos del rachivo, nombre de la carpeta donde se va a subir )
 */
function upload_file($img, $file)
{
    $ext_per = [
        'jpg', 'jpeg', 'png', 'webp', 'PNG', 'JPG', 'JPEG', 'WEBP', 'avi', 'mov', 'flv', 'rm', 'rmvb', 'mp4', 'AVI', 'MOV', 'FLV', 'RM', 'RMVB', 'MP4', 'pdf', 'xls', 'xlsx', 'csv'
    ];
    $name_file = explode('.', $img['name']);
    $ext_file = end($name_file);
    $name_md5 = md5($img['name'] . microtime()) . '.' . $ext_file;
    $name_tmp = $img['tmp_name'];
    $rut_db = "images/uploads/$file/" . $name_md5;
    $rut_img = $_SERVER['DOCUMENT_ROOT'] . NAME . "Assets/images/uploads/$file/";
    // chmod($rut_img, 0777);
    if (in_array($ext_file, $ext_per) && file_exists($rut_img) && copy($name_tmp, $rut_img . $name_md5)) {
        unlink($name_tmp);
        return $rut_db;
    }
}

/*
 * funcion para eliminar el archivo correspondiente del servidor
 */
function delete_old_file($img_old)
{
    unlink($_SERVER['DOCUMENT_ROOT'] . NAME .  "/Assets/" . $img_old);
}

/*
 * funcion para convertir el lin común de youtube a embed
 */
function format_link($link)
{
    $regExp = '/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|shorts\/|\&v=)([^#\&\?]*).*/';
    preg_match($regExp, $link, $matches);
    return "https://www.youtube.com/embed/$matches[2]";
}

function formatSold($value)
{
    $value = explode('-', $value);
    if ($value[0] > 1) {
        $value[0] = $value[0] . 'M';
    } else {
        $value[0] = $value[0] . 'K';
    }
    if ($value[1] > 1) {
        $value[1] = $value[1] . 'M';
    } else {
        $value[1] = $value[1] . 'K';
    }
    $value = implode('-', $value);
    return $value;
}

/*
 * funcion para encriptar un dato mediando un algoritmo sha256.
 */
function encrypted($string)
{
    $key = hash('sha256', KEY); /* hash */
    $iv = substr(hash('sha256', IV), 0, 16); /* iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning */
    return base64_encode(openssl_encrypt($string, METODO, $key, 0, $iv));
}

/*
 * funcion para desencriptar un dato mediando un algoritmo sha256.
 */
function decrypted($string)
{
    $key = hash('sha256', KEY);
    $iv = substr(hash('sha256', IV), 0, 16);
    return openssl_decrypt(base64_decode($string), METODO, $key, 0, $iv);
}
