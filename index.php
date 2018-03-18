<?php
  include_once 'header.php'
?>

    <section class="main-container">
      <div class="main-wrapper">
        <h2>Home</h2>
        <?php
            if (isset($_SESSION['u_id'])) {
                echo "<br> Hello ";
                echo $_SESSION['u_username'];
                echo "<br> You are logged in!";
            }
        ?>
      </div>
    </section>

  <?php
  include_once 'footer.php';
  ?>
