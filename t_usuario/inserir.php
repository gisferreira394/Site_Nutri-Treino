<?php 
include "../includes/conexao.php";


// IMPORTA PHPMailer
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';


// DADOS DO FORMULÁRIO
$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

// 👇 DEPOIS verifica se já existe
$sql_check = "SELECT * FROM usuarios WHERE email='$email'";
$res_check = mysqli_query($conexao, $sql_check);

if (mysqli_num_rows($res_check) > 0) {
    header("Location: novo.php?erro=email");
    exit;
}

// GERA CÓDIGO
$codigo = rand(100000, 999999);

// SALVA NO BANCO (AINDA NÃO VERIFICADO)
$sql = "INSERT INTO usuarios (nome,email,senha,codigo_verificacao,verificado)
        VALUES ('$nome','$email','$senha','$codigo',0)";

mysqli_query($conexao,$sql);

// ===== ENVIO DE EMAIL =====
$mail = new \PHPMailer\PHPMailer\PHPMailer(true);

$mail->CharSet = 'UTF-8';

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ggguicamaro@gmail.com'; // seu gmail
    $mail->Password = 'fkajxrbpwmirgibw'; // senha de app (sem espaços)
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('ggguicamaro@gmail.com', 'NutriTreino');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Código de verificação';
    $mail->Body = "Seu código de verificação é: <b>$codigo</b>";

    $mail->send();

} catch (Exception $e) {
    echo "Erro ao enviar email: {$mail->ErrorInfo}";
}

// FECHA CONEXÃO
mysqli_close($conexao);

// REDIRECIONA
header("Location: verificar.php?email=$email");
exit;
?>
