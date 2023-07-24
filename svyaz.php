<?php require 'connect.php'; ?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="images/icon.png">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#send").click(function(){
                var author = $("#author").val();
                var message = $("#message").val();
                $.ajax({
                    type: "POST",
                    url: "sendMessage.php",
                    data: {"author": author, "message": message},
                    cache: false,
                    success: function(response){
                        var messageResp = new Array('Ваше сообщение отправлено','Сообщение не отправлено Ошибка базы данных','Нельзя отправлять пустые сообщения');
                        var resultStat = messageResp[Number(response)];
                        if(response == 0){
                            $("#author").val("");
                            $("#message").val("");
                            $("#commentBlock").append("<div class='comment'>Автор: <strong>"+author+"</strong><br>"+message+"</div>");}
                        $("#resp").text(resultStat).show().delay(1).fadeOut(800);}});return false;});});
    </script>
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Обратная связь</title>
    <style>


        textarea {
            resize: none;
        }

        .clear {
            margin-top: 50px;
        }

        #author {
            width: 100%;
            height: 4%;
            font-size: 1.8em;
        }

        .is-h {
            font-size: 1.4em;
            font-weight: bold;
            font-family: cursive;
            margin-top: 2%;
        }

        #message {
            width: 100%;
            font-size: 1.5em;
        }

        .is-button {
            cursor: pointer;
            color: white;
            background-color: green;
            width: 25%;
            height: 50px;
            margin-top: 1%;
            outline: none; /* Убираем линию вокруг кнопки при нажатии */
            font-weight: bold;
            font-family: cursive;
            font-size: 1.8em;
            border: none;
            transition: all 0.3s ease-out;
        }

        .is-button:hover {
            color: black;
            background: rgb(48, 184, 66);
        }





        .recipe img {
            margin-top: 20px;
        }


        .button {
            margin-top: 30px;
        }

        .button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: white;
            color: black;
            border: 2px solid black;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
        }

    </style>
</head>
<body>
<div id="container">
    <div id="menu">
        <ul>
            <li class="current"><a href="index.html"><b>Главная</b></a></li>
            <li><a href="#"><b>Закуски</b></a></li>
            <li><a href="#"><b>Супы</b></a></li>
            <li><a href="#"><b>Вторые блюда</b></a></li>
            <li><a href="#"><b>Десерты</b></a></li>
            <li><a href="#"><b>Выпечка</b></a></li>
            <li><a href="#"><b>Салаты</b></a></li>
            <li><a href="#"><b>Напитки</b></a></li>
        </ul>
    </div>
    <div class="button">
        <a href="index.html" class="back-button">Назад</a>
    </div>



    <form action="sendMessage.php" method="post" name="form">
        <p class="is-h">Автор:<br> <input name="author" type="text" class="is-input" id="author"></p>
        <p class="is-h">Текст сообщения:<br><textarea name="message" rows="5" cols="50" id="message"></textarea></p>
        <input name="js" type="hidden" value="no" id="js">
        <button type="submit" id='click' name="button" class="is-button">Отправить</button>
    </form>
    <div class="clear">

    </div>

    <h1><p>Комментарии</p></h1>

    <div id="commentBlock">
        <?php
        $result = $mysql->query("SELECT * FROM `messages`");
        $comment = $result->fetch_assoc();
        do{echo "<div class='comment' style='border: 1px solid gray; margin-top: 1%; border-radius: 5px; padding: 0.5%;'>Автор: <strong>".$comment['author']."</strong><br>".$comment['message']."</div>";
        }while($comment = $result->fetch_assoc());
        ?>
    </div>



    <div id="footer">
        by <a title="" target="_parent">Ruslan Zaripov AA-22-08</a></div>
</div>
</body>
</html>
