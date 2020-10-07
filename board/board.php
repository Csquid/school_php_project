<?php
    require_once("../tools.php");
    require_once("BoardDao.php");

    //전달된 페이지 번호 저장
    $page = requestValue("page");

    //화면 구성에 관련된 상수 정의
    define("NUM_LINES",      5);    //게시글 리스트의 줄 수
    define("NUM_PAGE_LINKS", 3);    //화면에 표시될 페이지 링크의 수

    // 게시판의 전체 게시글 수 구하기
    $dao = new BoardDao();
    $numMsgs = $dao->getNumMsgs();

    //만약 레코드가 1보다 적다면 즉 없다면
    if($numMsgs > 0) {
        //전체 페이지 수 구하기
        $numPages = ceil($numMsgs / NUM_LINES);
        
        //현제 페이지 번호가 (1 ~ 전체 페이지 수)를 벗어나면 보정       범위제한
        //page 값이 1보다 작다면 page는 1이됨. 맨처음 페이지가 시작될때 1로 셋팅이 자동으로 됨 --> 테스트 확인.
        if($page < 1 ) {
            $page = 1;
        }
        if($page > $numPages) {
            $page = $numPages;
        }

        //리스트에 보일 게시글 데이터 읽기
        $start = ($page - 1) * NUM_LINES;
        $msgs = $dao->getManyMsgs($start, NUM_LINES);

        //페이지네이션 컨트롤의 처음 / 마지막 페이지 링크 번호 계산
        $firstLink = floor(($page - 1) / NUM_PAGE_LINKS) * NUM_PAGE_LINKS + 1; 
        $lastLink = $firstLink + NUM_PAGE_LINKS - 1;

        if($lastLink > $numPages) {
            $lastLink = $numPages;
        }
    }
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
        <?php if($numMsgs > 0) : ?>
            <table class = "list">
                <thead>
                <tr>
                    <th class="list-num">번호</th>
                    <th class="list-title">제목</th>
                    <th class="list-writer">작성자</th>
                    <th class="list-regtime">작성일시</th>
                    <th>조회수</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($msgs as $row) : ?>
                <tr>
                    <td><?= $row["num"]?></td>
                    <td class="left">
                        <a href="<?= bdUrl("view.php", $row["num"], $page) ?>"> <?= $row["title"]?></a>
                    </td>
                    <td> <?= $row["writer"]?> </td>
                    <td> <?= $row["regtime"]?> </td>
                    <td> <?= $row["hits"]?> </td>
                </tr>
                <?php endforeach ?>
                </tbody>
            </table>
            <br>
            <!-- firstLink가 1보다 크다는것은 다음 칸으로 넘어간다는 의미 -->
            <?php if($firstLink > 1) : ?>
                <a href="<?= bdUrl("board.php", 0, $page - NUM_PAGE_LINKS) ?>"> < </a> &nbsp;
            <?php endif?>    

            <?php for($i = $firstLink; $i <= $lastLink; $i++) :?>
                <?php if ($i == $page) : ?>
                    <a href="<?= bdUrl("board.php", 0, $i)?>"> <b><?= $i ?></b></a>

                <?php else :?>
                    <a href="<?= bdUrl("board.php", 0, $i)?>"> <?= $i ?></a>
                <?php endif ?>
            <?php endfor?>

            <?php if ($lastLink < $numPages) : ?>
                <a href="<?= bdUrl("board.php", 0, $page + NUM_PAGE_LINKS) ?>"> > </a>
            <?php endif ?>
        <?php endif ?>

        <br><br>
        <div class="right">
            <input type="button" value="글쓰기" onclick="location.href = '<?= bdURL("write_form.php", 0, $page)?>'">
        </div> 
    </div>

</body>

</html>