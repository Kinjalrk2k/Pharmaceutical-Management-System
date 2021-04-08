<?php
include("./include/connection.php");
include("./include/header.php");

$query = "select * from medicines where forSale='1'";
$result = mysqli_query($con, $query);

@session_start();
$isCustomer = isset($_SESSION['NAME']) && isset($_SESSION['EMAIL']) && $_SESSION['USER'] == "customer";
?>

<div class="container">
  <h1>Medicines Available</h1>

  <div class="row">
    <?php while ($fetch = mysqli_fetch_object($result)) { ?>
      <div class="col s12 m4">
        <div class="card">
          <div class="card-image">
            <img src="./uploads/<?php echo $fetch->image ?>">
            <!-- <span class="card-title"></span> -->
          </div>
          <div class="card-content">
            <h4><?php echo $fetch->name ?></h4>
            <h5>₹ <?php echo $fetch->price ?></h5>
            <p>Available Quatity: <?php echo $fetch->qty ?> units</p>
          </div>
          <?php if ($isCustomer) { ?>
            <div class="card-action">
              <div class="row">
                <div class="col s7">
                  <p class="range-field">
                    <input type="range" class="range" min="1" max="<?php echo $fetch->qty ?>" default="1" />
                  </p>
                </div>
                <div class="col s3">
                  <button class="waves-effect waves-light btn-small">Buy&nbsp;1</button>
                </div>
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
      console.log(range)
      range.addEventListener("change", (e) => {
        console.log(e);
        // console.log(e.target.parentElement.parentElement.nextElementSibling.children[0])
        e.target.parentElement.parentElement.nextElementSibling.children[0].innerHTML = `Buy&nbsp;${e.target.value}`
      })
    })
  })
</script>
</body>