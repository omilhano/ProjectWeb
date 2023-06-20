<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/guides.css">
    <style>
    .background-image{
        background-color: rgba(128, 128, 128, 1);
        background-image: url('../img/paper-bg.jpg');
        background-blend-mode: multiply;
        background-size: cover;
        background-repeat: no-repeat;
        height: auto;
        min-height: 100vh;
        /*Se height tiver apenas 100vh, a imagem limita-se só ao tamanho do ecrã (sem scroll)*/
      }
    </style>
</head>
<body class = "background-image"> 
    <?php include '../php/guides_select.php'?>  
</body>
</html>