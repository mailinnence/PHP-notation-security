<!DOCTYPE HTML>
<html>
<body>

<?php
$name = $email = "";
$nameErr = $emailErr = "";           //받아줄 변수를 만든다

if ($_SERVER["REQUEST_METHOD"] == "POST") {        //$_SERVER["REQUEST_METHOD"] 웹브라우저가 어떤 http 메소드를 요청했는지 나타내는 함수
        $name = test_input($_POST["name"]);       //이렇게 받으면 post 방식의 변수를 받고 보안성 까지 갖출 수 있다.
        $email = test_input($_POST["email"]);

}


function test_input($data) {

    $data = trim($data);
                    //함수가 받은 변수의 문자열의 양쪽에서 공백 및 기타 미리 정의 된 문자를 제거합니다 ex)echo trim($str); >>의 공백 제거
                    // ,echo trim($str,"특정문자");  정의 된 특정문자를 제거
    $data = stripslashes($data);  // '\'(백슬래쉬)를 제거합니다
    $data = htmlspecialchars($data);  //특수문자를 자바스크립트 언어로 작동하지 않도록 문자화 시키는 함수
    return $data;
}

//<script>alert('그대는 아름답습니다')</script>
//위와 같은 방식으로 변수의 문자열을 처리하지 않으면 command injection 공격에 취약할 수 빆에 없다


?>



<form name="k" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" >
    Name: <input type="text" name="name"><br>
    E-mail: <input type="text" name="email"><br>
    <input type="submit">
</form>

<?php

//if (isset($email)) {
//    echo "이름: " .$_POST["email"]."<br>";
//}
//     요렇게 부르면 post로 받기전에는 오류가 뜨므로 옳은 방법이 아니다

echo "<br>";

if (isset($name)) {    //PHP 함수 중 하나인 isset 함수는 변수가 설정되었는지 확인해주는 함수입니다.
    echo "이름: " .$name."<br>";
}

if (isset($email)) {
    echo "이름: " .$email."<br>";
}

?>



</body>
</html>