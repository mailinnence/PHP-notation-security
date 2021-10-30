<!DOCTYPE HTML>
<html>
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

<form name="k" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
<!--   $_SERVER["PHP_SELF"]== 자기자신 -->
<!--    //이렇게 함으로써 전체에다가 htmlspecialchars 를 적용 시킨다-->
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