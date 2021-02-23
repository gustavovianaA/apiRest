<?php
$service_url = 'localhost/apirest/api/public_html/api/user';
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$curl_response = curl_exec($curl);
curl_close($curl);
$users = json_decode($curl_response, true);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>API-CRUD-consumo</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <h1>API REST com PHP</h1>
    <h2>Exibindo usuários cadastrados.</h2>
    <p>API URL: <a href="api/public_html/api/user">api/public_html/api/user</a></p>
    <?php
    if ($users['status'] === 'sucess') {
        array_shift($users);
        echo '<table><tr><th>id</th><th>Nome</th><th>E-mail</th></tr>';
        foreach ($users as $user) {
            foreach ($user as $val) {
                echo "<tr><td>{$val['id']}</td><td>{$val['name']}</td><td>{$val['email']}</td></tr>";
            }
        }
        echo '</table>';
    } ?>
    <h2>Cadastrar Usuário</h2>
    <form method="POST" action="api/public_html/api/user">
        <input type="text" placeholder="nome" name="name">
        <input type="email" placeholder="email" name="email">
        <input type="password" placeholder="senha" name="password">
        <input type="submit" value="Cadastrar">
    </form>
</body>

</html>