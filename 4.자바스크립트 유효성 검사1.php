<!DOCTYPE html>
<html>
<head>
    <script>
        function validateForm() {
            var x = document.forms["myForm"]["fname"].value; //
            if (x == "") {
                alert("이름을 채워주세요");
                return false; //ture 로 하면 전송 된다
            }
        }
    </script>
</head>
<body>

<form name="myForm" action="/action.php" onsubmit="return validateForm()" method="post">
    Name: <input type="text" name="fname">
    <input type="submit" value="Submit">
</form>



</body>
</html>