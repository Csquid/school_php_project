<?php
    require_once("../tools.php");
    require_once("MemberDao.php");             //파일의 소스를 1회 포함
    $mdao = new MemberDao();                   //객체 생성
    $member = $mdao->getMember("admin");   //원하는 메서드 호출

    $id = requestValue("id");
    $pw = requestValue("pw");

    if($member && $member["pw"] == $pw) {
        session_start_if_none();
        $_SESSION["uid"] = $member["id"];
        $_SESSION["uname"] = $member["name"];
        goNow(MAIN_PAGE);
    }
    else {
        errorBack("아이디 또는 비닐번호가 잘못 입력되었습니다.");
    }