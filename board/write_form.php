<?php
require_once("tools.php");

//전달된 값 전달
$page = requestValue("page");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="board.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <form method="post" action="write.php">
            <table class="msg">
                <tr>
                    <th>제목</th>
                    <td><input type="text" name="title" maxlength="80" class="msg-text"></td>
                </tr>
                <tr>
                    <th class="msg-header">작성자</th>
                    <td><input type="text" name="writer" maxlength="20" class="msg-text"></td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td><textArea name="content" wrap="virtual" rows="10" class="msg-text"></textArea></td>
                </tr>
            </table>
            <div class="left">
                <input type="submit" value="글 등록">
                <input type="button" value="목록 보기" onclick="location.href='<?= bdUrl("board.php", 0, $page) ?>'">
            </div>
        </form>
    </div>
    <br>


</body>

</html>