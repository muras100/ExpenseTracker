<?php
include('header.php');
check();
include('nav.php');
$id = 0;
$pass = '';

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $_SESSION['tem'] = getSafeValue($_GET['id']);
    $id = $_SESSION['tem'];
    $res = mysqli_query($con, "select * from users where id=$id");
    $row = mysqli_fetch_assoc($res);
    $pass = $row['pass'];
}
?>

<style>
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 5rem;
    }

    td {
        width: 30rem;
        font-size: 3rem;
        font-weight: 700;
        padding-top: 1.5rem;
        padding-right: 1.5rem;
    }

    td input,
    select {
        height: 4rem;
        width: 30rem;
        font-size: 2.5rem;
        border-radius: 1rem;
        padding-left: 1.5rem;
    }

    .submit {
        width: 20rem;
        height: 4rem;
        border-radius: 1rem;
        font-weight: 650;
        font-size: 2rem;
        background-color: #22ccfc;
        color: #f2f7f5;
        margin-top: -5rem;
    }

    .submit:active {
        background-color: #04bef1;
        color: #aab9bd;
    }

    @media screen and (max-width:450px) {
        .form {
            margin-top: 15rem;
        }
    }
</style>

<form method="post" class="center">
    <table>
        <tr>
            <td>User Password : </td>
            <td><input type="text" name="pass" required value="<?php echo $pass ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="submit" required class="submit"></td>
        </tr>
        <?php
        if (isset($_POST['submit'])) {
            $pass = getSafeValue($_POST['pass']);
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $id = $_SESSION['tem'];
            mysqli_query($con, "UPDATE `users` SET  `pass` = '$pass' WHERE `users`.`id` = '$id';");
            //redirect('userExpense.php');
        }

        ?>
    </table>
</form>