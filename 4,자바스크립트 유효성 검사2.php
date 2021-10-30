<!DOCTYPE HTML>
<html>
<head>

    <!--    <script>-->
    <!--        function FormCheck() {-->
    <!--            var x = document.forms["k"]["name"].value; //-->
    <!--            if (x == "") {-->
    <!--                alert("이름을 채워주세요");-->
    <!--                return false;-->
    <!--            }-->
    <!---->
    <!--            var y = document.forms["k"]["email"].value; //-->
    <!--            if (y == "") {-->
    <!--                alert("이름을 채워주세요");-->
    <!--                return false;-->
    <!--            }-->
    <!--        }-->
    <!--    </script>-->

    <script>
        function FormCheck(){
            if (!k.name.value) {
                alert("이름을 입력하세요.");
                k.name.focus();
                return false;
            }
            if (!k.email.value) {
                alert("이메일을 입력하세요.");
                k.email.focus();
                return false;
            }
        }
    </script>
</head>
<body>

<?php
$name = $email = "";
$nameErr = $emailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);

}


function test_input($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>

<form name="k" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return FormCheck()" >
    <!-- 이렇게 함으로써 전체에다가 htmlspecialchars 를 적용 시킨다-->
    <!-- onsubmit="return FormCheck()"는 submit을 클릭했을때 함수로 리턴 시키는 자바스크립트 기능이다-->
    Name: <input type="text" name="name"><br>
    E-mail: <input type="text" name="email"><br>
    <input type="submit">
</form>

<?php


echo "<br>";

if (isset($name)) {
    echo "이름: " .$name."<br>";
}

if (isset($email)) {
    echo "이름: " .$email."<br>";
}

?>


</body>
</html>


