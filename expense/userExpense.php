<?php
include('header.php');
check();
adminArea();
$res = mysqli_query($con, "SELECT COUNT(expense.id) as noOfE,users.userName,users.ram,users.id as userId FROM expense,users WHERE expense.userId=users.id GROUP BY userName ORDER by noOfE ASC");
?>

<body>
    <?php
    include('nav.php');
    ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron&display=swap');
        @media screen and (max-width:450px) {
            html {
                font-size: 25%;
            }

            .dis2 {
                height: 120rem;
            }

            .record div {
                width: 20rem;
            }

            .sdiv {
                margin-bottom: 3rem;
                margin-top: 1rem;
            }
        }
        .record {
            grid-template-columns: auto auto auto auto auto;
            padding: 1rem;
        }
    </style>
<div class="regDiv">
    <div class="welcomeTag">
      <?php 
        echo "Welcome " . $_SESSION['name']." 😁";
      ?>
    </div>
  </div>
    

    <div class="dis2">
        <div class="record rNav">
            <div>No Of Expense</div>
            <div>User Name</div>
            <div>MARK</div>
            <div>Details</div>
            <div>Change Password</div>
        
            
        </div>
        <hr>
        <?php
        if (!mysqli_num_rows($res) > 0) {
            echo "no data found !";
        } else {
            while ($row = mysqli_fetch_assoc($res)) {
        ?>
                <div class="record sdiv">
                    <div><?php echo $row['noOfE']; ?></div>
                    <div><?php echo $row['userName'] ?></div>
                    <div><?php echo $row['ram'] ?></div>
                    <div class="detial"><a href="userExpenseDetail.php?userId=<?php echo $row['userId'];?>">Detail</a></div>
                    <div class="detial"><a href="changePassword.php?id=<?php echo $row['userId'];?>">Change Password</a></div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</body>

<?php
include('footer.php');
?>