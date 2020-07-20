<?php
if (isset($_POST['submit'])) {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
        header("Location: ../index.html?error-form");
        exit();
    } else {
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

        /*Sólo para probar en local*/
        $message = "
        <html>
        <body>
            <h3>New message recived</h3>
            <p><strong>Name: </strong>".$info['name']."</p>
            <p><strong>Email: </strong>".$info['email']."</p>
            <p><strong>Phone: </strong>".$info['phone']."</p>
            <p><strong>Message: </strong>".$info['message']."</p>
            <br />
            <p><strong>IP: ".$info['ip']."</strong></p>
            <p><strong>Date: ".$info['fecha']."</strong></p>
        </body>
        </html>
        ";

        /*Envia el email*/
        $to = "carlosbcn169@gmail.com";
        $from = $info['email'];

        //Asunto del correo
        $subject = "Contact Form Responsive Webdesign";

        //Cabecera del correo
        $headers = "From: ".$info['name']." <".$from.">\r\n";
        $headers.= "MIME-Version: 1.0\r\n";
        $headers.= "Content-type: text/html; charset=utf-8\r\n";

        //Mensaje del correo

        //Enviando el formulario
        $enviar = mail($to,$subject,$message,$headers);
        if ($enviar) {
            //Si se envia el correo
            header("Location: ../index.html?success");
            exit();
        } else {
            //No se envia el correo
            header("Location: ../index.html?error");
            exit();
        }

    }
} else {
    /**/
    header("Location: ../index.html?error");
}

?>



<br>
<a href="../index.html">Volver</a>
