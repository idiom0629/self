<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>register.php</title>
</head>

<body>

  <?php session_start();
  error_reporting(0);
  /* 資料庫連線*/
  $mysqli = mysqli_connect("127.0.0.1", "root", "good");
  $mysqli->select_db("test");
  mysqli_set_charset($mysqli, "utf8");
  /* 資料庫連線*/

  /* 前後端連接*/
  $name = $_POST['name'];
  $pswd = $_POST['password'];
  $pswd2 = $_POST['password2'];
  /* 前後端連接*/

  if (isset($_POST['submit'])) {    /* 點擊submit開始*/
    $sql = "SELECT * FROM gogo";
    $result = $mysqli->query($sql);  /* 搜尋資料庫*/
    $row = $result->fetch_array();
    if ($row['name'] == $name) {  /* 搜尋資料庫帳號*/
      echo "帳號已被使用";
    } else if ($pswd == $pswd2) {  /* 判斷密碼是否一致*/

      /* 編號 */
      mysqli_free_result($result);
      $sql = "SELECT number FROM gogo  order by number DESC limit 1";
      $result = mysqli_query($mysqli, $sql);
      $row = mysqli_fetch_array($result);
      $number = 1 + $row['number']; /* 讓這筆資料No是上一筆資料的+1 */
      /* 編號*/

      /* 輸入無誤 新增進資料庫*/
      $insert = "INSERT INTO test.gogo (number,name,password) Values ('{$number}','{$name}','{$pswd}')";
      $mysqli->query($insert) or die($mysqli->error);
      echo '<script>alert("註冊成功")</script>';
      /* 輸入無誤 新增進資料庫*/
    } else {
      echo '<script>alert("密碼不一致")</script>';
    }
    mysqli_free_result($result);
  }

  mysqli_close($mysqli)
  ?>
  <form action="register.php" method="post">
    <table align="center" style="width:235px;height:100px;">
      <!-- 表格置中 -->
      <td>
        <div style="text-align:left">
          <label for="name">帳號:</label>
          <input size=21 type="text" name="name" id="name" required autofocus />
          <p></p>
          <label for="password">密碼:</label>
          <input size=21 type="password" name="password" id="password" required />
          <p></p>
          <label for="password">確認密碼:</label>
          <input size=17.5 type="password" name="password2" id="password2" required />
          <p></p>
        </div>
        <div style="text-align: center;">
          <input type="submit" name="submit" value="確認" />
          <input type="button" name="button " value="返回" onclick="location.href='info.php'" />
        </div>

      </td>
    </table>

  </form>
</body>
<style>


</style>

</html>
