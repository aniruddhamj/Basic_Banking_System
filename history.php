<!DOCTYPE html>
<html>
<head>
<title>Transaction history</title>
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
            color:black;
            font-size: 25px;
            text-align: left;
        }
        th {
            background-color:black;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2}

        #sideNav{
            width: 250px;
            height: 100vh;
            position: fixed;
            right: -250px;
            top:0;
            background:black;
            opacity: 0.7;
            z-index: 2;
            transition: .5s;
        }
        nav ul li{
            list-style: none;
            margin: 55px -20px;
        }
        nav ul li a{
            text-decoration: none;
            color: #fff;
        }
        a:hover {
  color: orangered;
}

        #menuBtn{
            width: 50px;
            position: fixed;
            right: 65px;
            top: 25px;
            z-index: 2;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div style="font-family: 'Times New Roman', Times, serif;;   font-size: 40px;
        text-align: center;
        margin: 20px;
    }"><b>Transaction Hiorsty</b></div>
    <table>
    <tr>
    <th>Sender's Name</th>
    <th>Sender's Account No.</th>
    <th>Reciever's Name</th>
    <th>Reciever's Account No.</th>
    <th>Amount</th>
    <th>Date and Time</th>
    </tr>

    <?php
        // Connecting to the Database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "anirudha";

        // Create a connection
        $conn = mysqli_connect($servername, $username, $password, $database);
        // Die if connection was not successful
        if (!$conn){
            die("Sorry we failed to connect: ". mysqli_connect_error());
        }


        $sql = "SELECT * FROM `transfer`";
        $result = mysqli_query($conn, $sql);

        // Find the number of records returned
        $num = mysqli_num_rows($result);

        // Display the rows returned by the sql query
        if($num> 0){
            

            // We can fetch in a better way using the while loop
            while($row = mysqli_fetch_assoc($result)){
                // echo var_dump($row);
                echo "<tr>";
                echo "<td>" . $row["s_name"]. "</td><td>" . $row["s_acc_no"] . "</td>
                <td>" . $row["r_name"] . "</td><td>" . $row["r_acc_no"] . "</td><td>" . $row["amount"] . "</td><td>" . $row["date_time"] . "</td>";
                 echo "</tr>";
        }
        echo "</table>";
        }
    ?>


    <nav id="sideNav">
        <ul><b>
           <li><a href="home.html">➤HOME</a></li>
            <li><a href="Register.php">➤ADD NEW USER</a></li>
            <li><a href="userss.php">➤CUSTOMERS INFO</a></li>
            <li><a href="users.php">➤TRANSFER MONEY</a></li>
            <li><a href="history.php">➤TRANSACTION HISTORY</a></li>
    </b>
        </ul>
    </nav>
    <div id="hojaplz">
        <img src="images/menu.png" id="menuBtn">
    </div>

    <script>
        let menuBtn = document.querySelector('#hojaplz');
        let sideNav = document.querySelector('#sideNav')
        let condition = true;
        menuBtn.addEventListener('click',function(){
            if(condition){
                 sideNav.style.right = '0px';
                 condition = false;
            }
            else{
                sideNav.style.right = '-250px';
                condition = true;
            }
            })
    </script>
    </table>
    </body>
</html>