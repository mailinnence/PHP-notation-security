<!--
여기서 upload 는 form 에서 type="file"의  name의 값이다
$_FILES["upload"]["name"]	 	// 전송된 파일의 실제 이름 값
$_FILES["upload"]["type"]	  	// 전송된 파일의 형식(type)
$_FILES["upload"]["size"])	 	// 전송된 파일의 용량(기본 byte 값)
$_FILES["upload"]["tmp"] 	//서버에 저장된 임시 복사본의 이름

$_FILES["file"]["error"] 	// 에러가 있으면 어떤 에러인지 출력함
---------------------------------------------------------------------------------------------------------
UPLOAD_ERR_OK	값: 0;
    오류 없이 파일 업로드가 성공했습니다
UPLOAD_ERR_INI_SIZE	값: 1;
    업로드한 파일이 php.ini upload_max_filesize 지시어보다 큽니다
UPLOAD_ERR_FORM_SIZE	값: 2;
    업로드한 파일이 HTML 폼에서 지정한 MAX_FILE_SIZE 보다 큽니다.
UPLOAD_ERR_PARTIAL	값: 3;
    파일이 일부분만 전송되었습니다
UPLOAD_ERR_NO_FILE	값: 4;
    파일이 전송되지 않았습니다
UPLOAD_ERR_NO_TMP_DIR	값: 6;
    임시 폴더가 없습니다. PHP 4.3.10과 PHP 5.0.3에서 추가.
UPLOAD_ERR_CANT_WRITE	값: 7;
    디스크에 파일 쓰기를 실패했습니다. PHP 5.1.0에서 추가
UPLOAD_ERR_EXTENSION	값: 8;
    확장에 의해 파일 업로드가 중지되었습니다.
    PHP 5.2.0에서 추가.
---------------------------------------------------------------------------------------------------------

if (file_exists("upload/" . $_FILES["upload"]["name"])) {   // 같은 이름의 파일이 존재하는지 체크를 함
echo $_FILES["file"]["name"] . " 동일한 파일이 있습니다. ";    // 같은 파일이 있다면 "동일한 파일이 있습니다"를 출력
} else {    //  동일한 파일이 없다면
move_uploaded_file($_FILES["upload"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);

// upload 폴더에 파일을 저장시킴
echo "Stored in: " . "upload/" . $_FILES["upload"]["name"];   // upload 폴더에 저장된 파일의 내용
}

-->







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
    $file_dir = "C:\\xampp\\htdocs\\7-1(보안)\\";
    $file_path = $file_dir . $_FILES["upload"]["name"];
//금지할 확장자
    $ban_ext = array('php', 'php3', 'html', 'htm', 'cgi', 'pl');
//확장자를 이용하여 업로드 가능한 파일인지 체크한다.
    $fname = explode(".", $_FILES['upload']['name']);
//배열의 마지막 원소, 즉 확장자를 소문자로 가져온다.
    $ext = strtolower($fname[sizeof($fname) - 1]);
    //fname[1] 필요하기 때문
    if (in_array($ext, $ban_ext)) {
        echo "업로드가 불가능한 확장자입니다.";
    } else {
        if (move_uploaded_file($_FILES["upload"]["tmp_name"], $file_path)) {
            $img_path = $file_path;
            return $_FILES["upload"]["name"];
        } else {
            echo "파일 업로드 오류가 발생했습니다!!!";
        }
    }
}
?>


<form name="k" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"
      onsubmit="return FormCheck()" enctype="multipart/form-data">
    <!-- 이렇게 함으로써 전체에다가 htmlspecialchars 를 적용 시킨다-->
    <!-- onsubmit="return FormCheck()"는 submit을 클릭했을때 함수로 리턴 시키는 자바스크립트 기능이다-->
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



