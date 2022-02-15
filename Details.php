<!DOCTYPE html>
<html>

<head>
  <title>Transfer Money</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Gabriela&display=swap" rel="stylesheet">
  
<style>
      body{
        background-image: url(background\ images/bank2.jpg);
        background-attachment: fixed;
        background-repeat:no-repeat;
        background-size: cover;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      color: black;

      font-size: 25px;
      text-align: left;
    }

    th {
      background: #863544;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }

    #sideNav{
    display:flex;
    width: 250px;
    height: 100vh;
    position: fixed;
    right: -250px;
    top:0px;
    background: black;
    opacity: 0.8;
    z-index: 1;
    transition: 0.5s;
    margin: left -250px;
}

    nav ul li {
      list-style: none;
      margin: 50px 20px;
    }

    nav ul li a {
      text-decoration: none;
      color: #fff;
    }
    a:hover {
  color: orangered;
}

    #menuBtn {
      width: 50px;
      position: fixed;
      right: 65px;
      top: 35px;
      z-index: 2;
      cursor: pointer;
    }


    .card {
      /* Add shadows to create the "card" effect */
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      transition: 0.3s;
      text-align: -webkit-center;
    }
    }

    /* On mouse-over, add a deeper shadow */
    .card:hover {
      box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    /* Add some padding inside the card container */
    .container {
      padding: 20px;
      width : 40%;
      margin-left : 450px ;
      
      background: orange;
      font-size : 25px;

    }
  </style>
</head>

<body>


  <table>
    <tr>
      <th>Account Number</th>
      <th>Name</th>
      <th>Email</th>
      <th>Gender</th>
      <th>Current Balance</th>

    </tr>


    <?php
    session_start();
    $server = "localhost";
    $username = "root";
    $password = "";
    // $database="anirudha"
    $conn = mysqli_connect($server, $username, $password, "anirudha");
    if (!$conn) {
      die("Connection failed");
    }

    $_SESSION['user'] = $_GET['user'];
    $_SESSION['sender'] = $_SESSION['user'];


    ?>
    <?php
    if (isset($_SESSION['user'])) {
      $user = $_SESSION['user'];

      $sql = "SELECT * FROM users WHERE Name='$user'";
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";

        echo "<td>" . $row["Acc_Number"] . "</td><td>" . $row["Name"] . "</td>
              <td>" . $row["Email_Id"] . "</td><td>" . $row["Gender"] . "</td><td>" . $row["Balance"] . "</td>";

        echo "</tr>";
      }
    }
    ?>
    <div style="font-family: 'Times New Roman', Times, serif;   font-size: 40px;
    text-align: center;
    margin: 20px;
}">
      <h3>Transfer Money</h3>
    </div>
    <div class="card container">
      <?php
      if ($_GET['message'] == 'success') {
        echo "<h3><p style='color:green;' class='messagehide'>Transaction was completed successfully</p></h3>";
      }
      if ($_GET['message'] == 'transactionDenied') {
        echo "<h3><p style='color:red;' class='messagehide'>Transaction Failed </p></h3>";
      }
      ?>
      <form action="transfer.php" method="POST">
        <!-- Make Transcation -->

        <b>Receiver's Name</b>&nbsp&nbsp:&nbsp&nbsp&nbsp&nbsp&nbsp
        <select name="reciever" id="dropdown" class="textbox" required>
          <option>Select Recipient</option>
          <?php
          $db = mysqli_connect("localhost", "root", "", "anirudha");
          $res = mysqli_query($db, "SELECT * FROM users WHERE name!='$user'");
          while ($row = mysqli_fetch_array($res)) {
            echo ("<option> " . "  " . $row['Name'] . "</option>");
          }
          ?>
        </select>
        <br><br>
        <b> Sender's Name</b>&nbsp&nbsp&nbsp&nbsp :&nbsp&nbsp <span style="font-size:1.2em;"><input id="myinput" name="sender" class="textbox" disabled type="text" value='<?php echo "$user"; ?>'></input></span>
        <br><br>


        <b>Amount &nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&#8377;</b>
        <input name="amount" type="number" min="100" class="textbox" required>
        <br><br>
        <a href="transfer.php"><button id="transfer" name="transfer" ;>Transfer</button></a>
      </form>
    </div>

    <div style="font-family: 'Times New Roman', Times, serif;   font-size: 40px;
    text-align: center;
    margin: 20px;
}">
      <h3>Customer Details</h3>
    </div>


    <nav id="sideNav">
      <ul>
        <li><a href="home.html">➤HOME</a></li>
        <li><a href="Register.php">➤ADD NEW USER</a></li>
        <li><a href="userss.php">➤CUSTOMERS INFO</a></li>
        <li><a href="users.php">➤TRANSFER MONEY</a></li>
        <li><a href="history.php">➤TRANSACTION HISTORY</a></li>
</ul>
    </nav>
    <div id="hojaplz">
      <img src="images/menu.png" id="menuBtn">
    </div>




    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script>
      let menuBtn = document.querySelector('#hojaplz');
      let sideNav = document.querySelector('#sideNav')

      let condition = true;

      menuBtn.addEventListener('click', function() {
        if (condition) {
          sideNav.style.right = '0px';
          condition = false;
        } else {
          sideNav.style.right = '-250px';
          condition = true;
        }
      })


      $(function() {
        setTimeout(function() {
          $('.messagehide').fadeOut('slow');
        }, 3000);
      });
    </script>