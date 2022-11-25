<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    hai {{ $content['nama'] }} terima kasih telah daftar di kampus Politeknik Nasional Denpasar, berikut ini akun untuk mengakses iQampuz kami di <a href="https://polnas.pmb.iQampuz.com">https://polnas.pmb.iQampuz.com</a><br>
    <table>
        <tr>
            <td>Email</td>
            <td>: {{ $content['email'] }}</td>
        </tr>
        <tr>
            <td>Password</td>
            <td>: {{ $content['password'] }}</td>
        </tr>
    </table>
</body>
</html>