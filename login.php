<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>info.php</title>
</head>

<body>

  <?php session_start();
  error_reporting(0);
  //* 資料庫連線*/
  $mysqli = mysqli_connect("127.0.0.1", "root", "good");
  $mysqli->select_db("test");
  mysqli_set_charset($mysqli, "utf8");
  /* 資料庫連線*/

  /* 前後端連接*/
  $name = $_POST['name'];
  $pswd = $_POST['password'];
  /* 前後端連接*/

  if (isset($_POST['submit'])) {   /* 點擊submit開始*/
    $sql = "SELECT name,password FROM gogo where name='$name'";
    /* 搜尋資料庫是否有與輸入帳號同樣的帳號*/
    $result = $mysqli->query($sql);
    $row = $result->fetch_array();
    if ($row['name'] != $name) {  /* 搜尋不到*/
      echo "無此使用者名稱";
    } else {
      if ($row['password'] == $pswd) {   /* 搜尋到的帳號 帳號密碼與輸入帳號密碼一致*/
        echo "登入成功";
      } else {
        echo "密碼錯誤";
      }
    }
  }


  ?>
  <form action="info.php" method="post">
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

          <p></p>
        </div>
        <div style="text-align: center;">
          <input type="submit" name="submit" value="確認" />
          <input type="button" name="button " value="註冊" onclick="location.href='register.php'" />
        </div>

      </td>
    </table>

  </form>
</body>
<style>


</style>

</html>