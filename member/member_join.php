<?php
    require_once("../tools.php");
    require_once("MemberDao.php");

    $id = requestValue("id");
    $pw = requestValue("pw");
    $name = requestValue("name");

    $mdao = new MemberDao();

    if($id && $pw && $name) {
        #만약 값이 있으면 배열 형태로 return 된다.
        if ($mdao->getMember($id)) {
            errorBack("이미 아이디가 사용중입니다.");
        } else {
            $mdao->insertMember($id, $pw, $name);

            okGo("가입이 완료되었습니다.", MAIN_PAGE);
        }
    } else {
        errorBack("빈칸을 모두 채워주세요.");
    }