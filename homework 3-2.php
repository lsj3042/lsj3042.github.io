<!DOCTYPE html>
<html>
<head>
    <title>난수 생성 및 정렬</title>
</head>
<body>
    <h2>10 이상 100 이하의 정수를 입력하세요</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        개수: <input type="text" name="count">
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    function generateAndSort($count) {
        $numbers = [];
        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(1, 100); 
        }

        echo "생성된 숫자: " . implode(", ", $numbers) . "<br>";

        sort($numbers);

        echo "오름차순 정렬 결과: " . implode(", ", $numbers) . "<br>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["count"]) && is_numeric($_POST["count"])) {
            $count = intval($_POST["count"]);
            if ($count >= 10 && $count <= 100) {
                generateAndSort($count);
            } else {
                echo "10 이상 100 이하의 정수를 입력하세요.";
            }
        } else {
            echo "10 이상 100 이하의 정수를 입력하세요.";
        }
    }
    ?>

</body>
</html>