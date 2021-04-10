<?php
include("./include/connection.php");
include("./include/header.php");

$query = "select * from chemicals";
$result = mysqli_query($con, $query);

@session_start();
$isVendor = isset($_SESSION['ID']) && isset($_SESSION['NAME']) && isset($_SESSION['EMAIL']) && $_SESSION['USER'] == "vendor";
if (!$isVendor) {
  header("location:./auth/login.php");
}

if (isset($_POST["sell"])) {
  $query1 = "update chemicals set qty = qty+" . $_POST["qty"] . " where id='" . $_POST["chem"] . "'";
  $result1 = mysqli_query($con, $query1);
  header("refresh:0");
}
?>

<div class="container">
  <h1>Chemicals Required</h1>

  <div class="row">
    <?php while ($fetch = mysqli_fetch_object($result)) { ?>
      <div class="col s12 m4">
        <div class="card">
          <div class="card-image">
            <img src="./uploads/<?php echo $fetch->image ?>">
            <!-- <span class="card-title"></span> -->
          </div>
          <div class="card-content">
            <h4 style="overflow: hidden; text-overflow: ellipsis;"><?php echo $fetch->name ?></h4>
            <h5>₹ <?php echo $fetch->rate ?></h5>
            <p>Available Quatity: <?php echo $fetch->qty ?> units</p>
          </div>
          <?php if ($isVendor) { ?>
            <div class="card-action">
              <div class="row">
                <form action="" method="POST">
                  <input type="text" name="chem" value="<?php echo $fetch->id ?>" hidden>
                  <div class="col s7">
                    <p class="range-field">
                      <input type="range" name="qty" class="range" min="1" max="10" default="1" />
                    </p>
                  </div>
                  <div class="col s3">
                    <button type="submit" name="sell" class="waves-effect waves-light btn-small">Sell&nbsp;1</button>
                  </div>
                </form>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>

</div>

<script>
  window.addEventListener("load", () => {
    var elems = document.querySelectorAll("input[type=range]");
    M.Range.init(elems);

    document.querySelectorAll(".range").forEach(range => {
      range.value = 1;
      range.addEventListener("change", (e) => {
        e.target.parentElement.parentElement.nextElementSibling.children[0].innerHTML = `Sell&nbsp;${e.target.value}`
      })
    })
  })
</script>
</body>