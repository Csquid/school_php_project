<?php
define("MAIN_PAGE", "/site/index.php");
define("MEMBER_PATH", "/site/member");

//게시물 묘듈의 URL을 반환하는 함수 
function bdUrl($file, $num, $page)
{
    $join = "?";
    if ($num) {
        $file .= $join."num=$num";
        $join = "&";
    }
    if ($page) {
        $file.= $join."page=$page";
    }

    return $file;
}

//세션이 시작되지 않았을 경우 세션을 시작하는 함수
function session_start_if_none()
{
    //SESSION STATUS//
    /*
     * PHP_SESSION_STATUS
     * PHP_SESSION_NONE: 1
     * PHP_SESSION_ACTIVE: 2
     */
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

// GET/POST로 전달된 값을 읽어 반환하는 함수
// 해당 값이 정의되지 않았으면 빈 문자열을 반환
function sessionVar($name)
{
    return isset($_SESSION[$name]) ? $_SESSION[$name] : "";
}

function requestValue($name)
{
    return isset($_REQUEST[$name]) ? $_REQUEST[$name] : "";
}

//지시된 URL로 이동하는 함수
//이 함수 호출 뒤에 있는 코드는 실행되지 않음
function goNow($url)
{
    header("Location: $url");
    exit();
}

function errorBack($msg)
{
    echo "<script> 
            alert('$msg'); 
            history.back(); 
          </script>";
}

function okGo($msg, $url)
{
    echo "<script> 
            alert('$msg'); 
            location.href = $url; 
          </script>";
}

function checkScript() {
    echo "<script> 
        alert('test');
    </script>";
}