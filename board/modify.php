<?php
    require_once("tools.php");
    require_once("BoardDao.php");

    // 전달된 값 저장
    $num = requestValue("num");
    $page = requestValue("page");
    
    $writer = requestValue("writer");
    $title = requestValue("title");
    $content = requestValue("content");

    //빈 칸 없이 모든 값이 전달 되었으면 update

    if($writer && $title && $content) {
        $dao = new BoardDao();
        $dao->updateMsg($num, $writer, $title, $content);

        //글 목록 페이지로 복귀
        goNow(bdUrl("board.php", 0, $page)); 
    } else {
        errorBack("모든 항목이 빈칸이 없이 입력되어야 합니다.");
    }
?>