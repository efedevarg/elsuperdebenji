<?php
if (!isset($_POST)) {
    die('NO AUTHORIZED');
}

//Función para trabajar las respuestas
function jsonOutput($status = 200, $msg = 'OK', $data = []) {
    echo json_encode(['status' => $status, 'msg' => $msg, 'data' => $data]);
    die;
}

if (empty($_POST['name'])) {
    jsonOutput(400, 'The name is required.');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    jsonOutput(400, 'The email is not correct.');
}
if (empty($_POST['message']) || strlen($_POST['message']) < 5) {
    jsonOutput(400, 'The message has to be more than 5 characters.');
}

//DATOS FORMULARIO A ENVIAR
$info['name'] = $_POST['name'];
$info['email'] = $_POST['email'];
if (empty($_POST['phone'])) {
    $info['phone'] = "No phone number ";
} else {
    $info['phone'] = $_POST['phone'];
}
$info['message'] = $_POST['message'];
$info['ip'] = $_SERVER['REMOTE_ADDR'];
$info['fecha'] = date("d M Y H:i:s");

//Mensaje del correo
$message = "
<html>
<body>
    <h3>New message recived</h3>
    <p><strong>Name: </strong>".$info['name']."</p>
    <p><strong>Email: </strong>".$info['email']."</p>
    <p><strong>Phone: </strong>".$info['phone']."</p>
    <p><strong>Message: </strong>".$info['message']."</p>
    <br />
    <p><strong>".$info['ip']."</strong></p>
    <p><strong>".$info['fecha']."</strong></p>
</body>
</html>
";

/*Destinatario*/
$to = "carlosbcn169@gmail.com";

//Remitente
$from = $info['email'];

//Asunto del correo
$subject = "Contact Form Responsive Webdesign";

//Cabecera del correo
$headers = "From: ".$info['name']." <".$from.">\r\n";
$headers.= "MIME-Version: 1.0\r\n";
$headers.= "Content-type: text/html; charset=utf-8\r\n";



//Enviando el formulario
$enviar = mail($to,$subject,$message,$headers);
if (!$enviar) {
    jsonOutput(400, 'The message could not has sent.');
}

jsonOutput(200, 'The message has sent successfully.', $message);
