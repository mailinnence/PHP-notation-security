<!DOCTYPE HTML>
<html>
<head>

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
$nameErr = $emailErr  = $upfile_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $upfile_name = $_FILES['upload']['name'];
    $upfile_name =file_upload_validation($upfile_name);
}


function test_input($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}




function file_upload_validation($upfile_name)
{
    $file_dir = "C:\\xampp\\htdocs\\2.7-1(보안)\\";
    $file_path = $file_dir.$_FILES["upload"]["name"];
    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $file_path)) {
        $img_path = $file_path;
        return $_FILES["upload"]["name"];
    } else {
        echo "파일 업로드 오류가 발생했습니다!!!";
    }


}


?>
<!--이렇게 하면 이미지 말고 악성파일도 올릴수 있기 때문에 방지를 해야 한다.... -->


<form name="k" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"
      onsubmit="return FormCheck()" enctype="multipart/form-data">
    <!-- 이렇게 함으로써 전체에다가 htmlspecialchars 를 적용시킨다-->
    <!-- onsubmit="return FormCheck()"는 submit을 클릭했을때 함수로 리턴 시키는 자바스크립트 기능이다-->
<!--    enctype 속성은 폼을 제출할 때 사용할 콘텐츠-형식(content-type) 을 지정합니다.  -->
<!--    "multipart/form-data" 는 업로드할 파일의 내용처럼, 폼이 이진데이터를 요구할 때 사용됩니다.-->
    Name: <input type="text" name="name"><br><br>
    E-mail: <input type="text" name="email"><br><br>
    이미지 업로드 : <input type="file" name="upload"><br><br>
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
if (isset($upfile_name)) {
    echo "업로드 파일: "."<img src='<?php echo $upfile_name'?>"."<br>";   //모르겠음 그리고 된다해도 이미지가 나오지 않는 이유???

}

?>



