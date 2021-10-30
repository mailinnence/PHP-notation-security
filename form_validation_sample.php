<!DOCTYPE html>
<html>
<head>
    <style>
        .error {
            color:red;
        }
    </style>
</head>
<body>
<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = $upfile_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["website"])) {
        $website = "";
    } else {
        $website = test_input($_POST["website"]);
    }

    if (empty($_POST["comment"])) {
        $comment = "";
    } else {
        $comment = test_input($_POST["comment"]);
    }

    if (!empty($_FILES['upload']['name'])) {
        $upfile_name = $_FILES['upload']['name'];
        $upfile_name =file_upload_validation($upfile_name);
    }
}
function test_input($data) {
    // $data ?? '';
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function file_upload_validation($upload_file){
	$file_dir = "C:/xampp/htdocs/7-1(보안)/";
	$file_path = $file_dir.$_FILES["upload"]["name"];

    //금지할 확장자
    $ban_ext = array('php', 'php3', 'html', 'htm', 'cgi', 'pl');

    //확장자를 이용하여 업로드 가능한 파일인지 체크한다.
    $fname = explode(".", $_FILES['upload']['name']);

    //배열의 마지막 원소, 즉 확장자를 소문자로 가져온다.
    $ext = strtolower($fname[sizeof($fname) - 1]);

    if (in_array($ext, $ban_ext)) {
        echo "업로드가 불가능한 확장자입니다.";
    }
    else {
        if (move_uploaded_file($_FILES['upload']['tmp_name'], $file_path)) {
//            $img_path = "data/" . $_FILES["upload"]["name"];
              $img_path = $_FILES["upload"]["name"];
            return $img_path;

        }
        else {
            echo "파일 업로드 오류가 발생했습니다!!!";
        }
    }

}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form name="fm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
      onsubmit="return FormCheck()" enctype="multipart/form-data">

    이름: <input type="text" name="name">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    성별:
    <input type="radio" name="gender" value="female">Female
    <input type="radio" name="gender" value="male">Male
    <input type="radio" name="gender" value="other">Other
    <span class="error" style="color:red">* <?php echo $genderErr;?></span>
    <br><br>
    이메일: <input type="email" name="email">
    <span class="error" >* <?php echo $emailErr;?></span>
    <br><br>
    홈페이지: <input type="text" name="website">
    <span class="error"><?php echo $websiteErr;?></span>
    <br><br>
    남기는 말: <textarea name="comment" rows="5" cols="40"></textarea>
    <br><br>
    파일: <input type="file" name="upload">
    <br><br>
    <input type="submit" name="submit" value="확인">
</form>

<script>
    function FormCheck(){
        if (!fm.name.value) {
            alert("이름을 입력하세요.");
            fm.name.focus();
            return false;
        }
        if (!fm.gender.value) {
            alert("성별을 입력하세요.");
            fm.gender.focus();
            return false;
        }
        if (!fm.email.value) {
            alert("이메일을 입력하세요.");
            fm.email.focus();
            return false;
        }
    }
</script>

<?php
    echo "<h2>Your Input:</h2>";
    if (isset($name)) {
        echo "이름: " .$name."<br>";
    }
    if (isset($gender)) {
        echo "성별: ". $gender."<br>";
    }
        if (isset($email)) {
        echo "이메일: ".$email."<br>";
    }
    if (isset($website)) {
        echo "홈페이지: ".$website."<br>";
    }
    if (isset($comment)) {
        echo "남기는 말: ". $comment."<br>";
    }
    if (isset($upfile_name)) {
        echo "업로드 파일: ".$upfile_name."<br>";
        echo "업로드 파일: "."<img src='<?php echo $upfile_name; ?>' "."<br>";
        //echo "<img src=''>";
    }
?>
</body>
</html>
