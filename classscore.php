<?php
$link = mysqli_connect("localhost", 'root', '','classscore');
$_GET['order'] = isset($order) ? $_GET['order'] : null;
?>
<html>
<head>
    <meta charset="utf-8">
    <title>classscore</title>
    <style>
        .input-wrap {
            width: 960px;
            margin: 0 auto;
        }
        h1 { text-align: center; }
        th, td { text-align: center; }
        table {
            border: 1px solid #000;
            margin: 0 auto;
        }
        td, th {
            border: 1px solid #ccc;
        }
        a { text-decoration: none; }
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
<body onload="startTime()">
    <div class="input-wrap">
    <form action="classscore.php" method="POST">
        <label for="customer_name">고객성명:</label>
        <input type="text" id="customer_name" name="customer_name" required>
        <span id="warning_message" class="warning"></span>
        <br><br>
        <input type="submit" name="submit" value="계산">
            <table>
                <thead>
                    <tr>
                    <th>No</th>
                    <th>구분</th>
                    <th colspan="2">어린이</th>
                    <th colspan="2">어른</th>
                    <th>비고</th>
                    </tr>
                </thead>
                <tr>
                    <td>1</td>
                    <td>입장권</td>
                    <td>7,000</td>
                    <td><select name="children_0">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
                        </p></td>
                    <td>10,000</td>
                    <td><select name="adults_0">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
                        </select>
                        </p></td>
                    <td>입장</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>BIG3</td>
                    <td>12,000</td>
                    <td><select name="children_1">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
                        </select>
                        </p></td>
                    <td>16,000</td>
                    <td><select name="adults_1">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
                        </select>
                        </p></td>
                    <td>입장+놀이3종</td>
                </tr> 
                <tr>
                    <td>3</td>
                    <td>자유이용권</td>
                    <td>21,000</td>
                    <td><select name="children_2">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
                        </select>
                        </p></td>
                    <td>26,000</td>
                    <td><select name="adults_2">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
                        </select>
                        </p></td>
                    <td>입장+놀이자유</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>연간이용권</td>
                    <td>70,000</td>
                    <td><select name="children_3">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
                        </select>
                        </p></td>
                    <td>90,000</td>
                    <td><select name="adults_3">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
                        </select>
                        </p></td>
                    <td>입장+놀이자유</td>
                </tr>
                </tbody>
            </table>
       </form>
       <div id="txt"></div>
       <?php echo date("Y년 m월 d일 H:i"); ?>


        <h1>Classscore</h1>
        <table>
            <thead>
                <tr>
                    <th>customer_name</th>
                    <th>children_0</th>
                    <th>adults_0</th>
                    <th>children_1</th>
                    <th>adults_1</th>
                    <th>children_2</th>
                    <th>adults_2</th>
                    <th>children_3</th>
                    <th>adults_3</th>
                    <th>sum</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($_POST['customer_name']) && strlen($_POST['customer_name']) > 0) {
                        if (isset($_POST['submit']) && $_POST['submit'] == "계산" ) { // 수정: 버튼 이름 일치
                            $sum = 7000 * $_POST['children_0'] + 10000 * $_POST['adults_0'] + 12000 * $_POST['children_1'] + 16000 * $_POST['adults_1'] + 21000 * $_POST['children_2'] + 26000 * $_POST['adults_2'] + 70000 * $_POST['children_3'] + 90000 * $_POST['adults_3'];
                            /* insert */
                            $sql=" INSERT INTO  `scores` ".     
                            "(`customer_name` , `children_0` , `adults_0` , `children_1` , `adults_1` , `children_2`, `adults_2`, `children_3`, `adults_3`, `sum`)". // 수정: sum 추가
                            "VALUES ('$_POST[customer_name]',  '$_POST[children_0]',  '$_POST[adults_0]',  '$_POST[children_1]',  '$_POST[adults_1]', '$_POST[children_2]',  '$_POST[adults_2]', '$_POST[children_3]',  '$_POST[adults_3]', '$sum')"; // 수정: 컬럼명 수정

                            mysqli_query($link,$sql);
                        }
                    }


                    if(isset($_GET['sorting'])) {
                        if ( $_GET['sorting'] == 'children_0' ) {
                            $query = 'SELECT * FROM scores ORDER BY children_0 DESC';
                        }
                        else if ( $_GET['sorting'] == "adults_0") {
                            $query = 'SELECT * FROM scores ORDER BY adults_0 DESC';
                        }
                        else if ( $_GET['sorting'] == "children_1") {
                            $query = 'SELECT * FROM scores ORDER BY children_1 DESC';
                        }
                        else if ( $_GET['sorting'] == "adults_1") {
                            $query = 'SELECT * FROM scores ORDER BY english DESC';
                        }
                        else if ( $_GET['sorting'] == "children_2") {
                            $query = 'SELECT * FROM scores ORDER BY mean DESC';
                        }
                        else if ( $_GET['sorting'] == "adults_2") {
                            $query = 'SELECT * FROM scores ORDER BY english DESC';
                        }
                        else if ( $_GET['sorting'] == "children_3") {
                            $query = 'SELECT * FROM scores ORDER BY mean DESC';
                        }
                        else if ( $_GET['sorting'] == "adults_3") {
                            $query = 'SELECT * FROM scores ORDER BY english DESC';
                        }
                        else if ( $_GET['sorting'] == "sum") {
                            $query = 'SELECT * FROM scores ORDER BY sum DESC';
                        }
                        else {
                            $query = 'SELECT * FROM scores ORDER BY sum DESC';
                        }                        
                    }
                    else {
                        $query = 'SELECT * FROM scores ORDER BY sum DESC';
                    }


                    $result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error());
                        while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                        echo "<tr>";
                        foreach ($line as $col_value) {
                            echo "<td>$col_value</td>";
                        }
                        echo "</tr>";
                    }
                    mysqli_free_result($result);
                    mysqli_close($link);

                    date_default_timezone_set('Asia/Seoul');
                    $current_time = date('Y년 m월 d일 H:i');
                    echo "현재 시간: $current_time";
                    
                ?>
            </tbody>
        </table>
    </div>
    <script>
    function startTime() {
    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
    setTimeout(startTime, 1000);
    }

    function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
    }
    </script>
</body>
</html>