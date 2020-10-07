<?php
    //require("파일명");           //파일의 소스를 포함
    //require_once("파일명")       //파일의 소스를 1회 포함
    require_once("tools.php");
    /*
    echo "<br> ID: ".$member[id];
    echo "<br> PW: ".$member[pw];
    echo "<br> NAME: ".$member[name];
    */

    //세션 정보 확인
    //session_start();
    session_start_if_none();

    $id = sessionVar("uid");
    $name = sessionVar("uname");

    //$id = $_SESSION['uid'];
    //$name = $_SESSION['uname'];
    //세션이 없으면 로그인 환영
    ?>

<!--비지니스 로직-->
<?php if($id): ?>
    환영합니다 <?= $name ?> 님
    <form action="<?=MEMBER_PATH?>/logout.php" method="post">
        <input type="submit" value="로그아웃">
        <input type="button" value="정보수정" onclick="location.href='member_update_form.php'">
    </form>
<?php else: ?>
    <form action=<?=MEMBER_PATH?>/login.php method="post">
        ID: <input type="text" name="id" > <br>
        PW: <input type="password" name="pw" > <br>
        <input type="submit" value="Login"> <br>
        <input type="button" value="회원가입" onclick="location.href='member_join_form.php'"> <br>
    </form>
<?php endif ?>
<!--비지니스 로직-->