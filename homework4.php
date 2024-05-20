<!DOCTYPE html>
<html>
<head>
    <title>티켓 주문</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
        }
        .warning {
            color: red;
        }
    </style>
    <script>
        function validateForm() {
            var customerName = document.getElementById("customer_name").value;
            if (customerName === "") {
                document.getElementById("warning_message").innerText = "고객성명을 입력해주세요.";
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <form method="post" action="" onsubmit="return validateForm()">
        <label for="customer_name">고객성명:</label>
        <input type="text" id="customer_name" name="customer_name" required>
        <span id="warning_message" class="warning"></span>
        <br><br>
        <table>
            <tr>
                <th>No</th>
                <th>구분</th>
                <th colspan="2">어린이</th>
                <th colspan="2">어른</th>
                <th>비고</th>
            </tr>
            <tr>
                <td>1</td>
                <td>입장권</td>
                <td>7,000</td>
                <td><select name="children_0">
                    <?php for ($i = 0; $i <= 5; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                    </select>
                    </p></td>
                <td>10,000</td>
                <td><select name="adults_0">
                    <?php for ($i = 0; $i <= 5; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                    </select>
                    </p></td>
                <td>입장</td>
            </tr>
            <tr>
                <td>2</td>
                <td>BIG3</td>
                <td>12,000</td>
                <td><select name="children_1">
                    <?php for ($i = 0; $i <= 5; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                    </select>
                    </p></td>
                <td>16,000</td>
                <td><select name="adults_1">
                    <?php for ($i = 0; $i <= 5; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                    </select>
                    </p></td>
                <td>입장+놀이3종</td>
            </tr> 
            <tr>
                <td>3</td>
                <td>자유이용권</td>
                <td>21,000</td>
                <td><select name="children_2">
                    <?php for ($i = 0; $i <= 5; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                    </select>
                    </p></td>
                <td>26,000</td>
                <td><select name="adults_2">
                    <?php for ($i = 0; $i <= 5; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                    </select>
                    </p></td>
                <td>입장+놀이자유</td>
            </tr>
            <tr>
                <td>4</td>
                <td>연간이용권</td>
                <td>70,000</td>
                <td><select name="children_3">
                    <?php for ($i = 0; $i <= 5; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                    </select>
                    </p></td>
                <td>90,000</td>
                <td><select name="adults_3">
                    <?php for ($i = 0; $i <= 5; $i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                    </select>
                    </p></td>
                <td>입장+놀이자유</td>
            </tr>
            <!-- 다른 티켓에 대한 행 추가 -->
        </table>
        <br>
        <input type="submit" name="calculate" value="합계">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['calculate'])) {
        if (!isset($_POST['customer_name']) || empty(trim($_POST['customer_name']))) {
            echo '<script>document.getElementById("warning_message").innerText = "고객성명을 입력해주세요.";</script>';
        } else {
            $customer_name = htmlspecialchars($_POST['customer_name']);
            $total_price = 0;

            echo "<br><br>";
            echo "$customer_name 고객님 감사합니다 <br>";

            // 티켓 가격 정보
            $ticket_prices = [
                [7000, 10000, "입장권"],
                [12000, 16000, "BIG3"],
                [21000, 26000, "자유이용권"],
                [70000, 90000, "연간이용권"]             
            ];

            // 각 티켓별 가격과 수량을 고려하여 총 합계 계산
            for ($index = 0; $index < count($ticket_prices); $index++) {
                $children_count = isset($_POST["children_$index"]) ? (int)$_POST["children_$index"] : 0;
                $adults_count = isset($_POST["adults_$index"]) ? (int)$_POST["adults_$index"] : 0;
                
                $children_price = $children_count * $ticket_prices[$index][0];
                $adults_price = $adults_count * $ticket_prices[$index][1];
                
                $total_price += $children_price + $adults_price;

                if ($children_count > 0) {
                    echo "어린이 " . $ticket_prices[$index][2] . " 티켓: " . $children_count . "매<br>";
                }
                if ($adults_count > 0) {
                    echo "어른 " . $ticket_prices[$index][2] . " 티켓: " . $adults_count . "매<br>";
                }
            }
            
            echo "총 합계: {$total_price}원<br>";

            // 현재 시간 출력
            date_default_timezone_set('Asia/Seoul');
            $current_time = date('Y년 m월 d일 H:i');
            echo "현재 시간: $current_time";
        }
    }
    ?>
</body>
</html>