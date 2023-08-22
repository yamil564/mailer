<?php
//define la url base
const BASE_URL = "https://smartreservices.com/";
const NAME='/';
//const name=''
//datos necesario para la conexion de base de datos
const DB_HOST = "localhost";
const DB_NAME = "mailerdb";
const DB_USER = "user_mailer";
const DB_PASSWORD = "8SFI=]%F1qZ%";
const DB_CHARSET = "charset=utf8";

//delimitares decimal y millar 
const SPD = ".";
const SPM = ",";

//simbolo de moneda
const MONEY = "$.";

//metodo usado y key del encryptado
const METODO = 'AES-256-CBC';
const KEY = 'eurCTHflCl';
const IV = 'qwertyuiopasdfghjklzxcvbnm,./;\\[]=`!@#\$%^&*()_+{}|\":?><0123456789QWERTYUIOPASDFGHJKLZXCVBNM';

//constantes para redireccionamiento
const LOGIN_ADMIN = 'Location:' . BASE_URL . 'Admin/login_admin';
const HOME = 'Location:' . BASE_URL;

//envio de correo
const USERNAME = 'marketing@smartrealtymd.com';
const PASSWORD = 'Smart123';

//const USERNAME = 'yamil.delgado@knd.pe';
//const PASSWORD = '2023@264Y';