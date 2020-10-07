<?php
    require_once("tools.php");
    require_once("BoardDao.php");
        
    // 전달된 값 저장
    $num = requestValue("num");
    $page = requestValue("page");
    
    
    // $num번 게시글 데이터 읽기
    $dao = new BoardDao();
    $row = $dao->getMsg($num);
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
        <form method="post" action="<?= bdUrl("modify.php", $num, $page) ?>">
            <table>
                <tr>
                    <th>제목</th>
                    <td><input type="text" name="title" maxlength="80" value="<?= $row["title"] ?>" class="msg-text"></td>
                </tr>
                <tr>
                    <th class="msg-header">작성자</th>
                    <td><input type="text" name="writer" maxlength="20" value="<?= $row["writer"] ?>" class="msg-text"></td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td>
                        <textarea name="content" wrap="virtual" rows="10" class="msg-text"><?= $row["content"] ?></textarea>
                    </td>
                </tr>
            </table>
            <br>
            <div class="left">
                <input type="submit" value="적용">
                <input type="button" value="목록보기" onclick="location.href='<?=bdUrl("board.php", 0, $page)?>'">
            </div>
        </form>
    </div>
</body>
</html>