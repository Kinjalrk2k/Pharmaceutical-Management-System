<?php
include("./include/connection.php");
include("./include/header.php");

$query = "select id, name from medicines";
$medicines = mysqli_query($con, $query);

if (isset($_REQUEST["units"])) {
  $units = $_REQUEST["units"];
} else {
  $units = 1;
}

if (isset($_REQUEST["med"])) {
  $query = "select * from medicines where id='" . $_REQUEST["med"] . "'";
  $result = mysqli_query($con, $query);
  $medicine = mysqli_fetch_object($result);

  $queryView = "create or replace view manufatureView as select *, composition.c_qty*" . $units . " as req_qty, chemicals.qty-(composition.c_qty*" . $units . ") as left_qty from composition, chemicals where mid='" . $_REQUEST["med"] . "'  and composition.cid=chemicals.id";
  $resultView = mysqli_query($con, $queryView);

  // $query2 = "select *, composition.c_qty*" . $units . " as req_qty, chemicals.qty-(composition.c_qty*" . $units . ") as left_qty from composition, chemicals where mid='" . $_REQUEST["med"] . "'  and composition.cid=chemicals.id";
  $query2 = "select * from manufatureView";
  $compositions = mysqli_query($con, $query2);

  $query3 = "select count(*) as count from manufatureView where left_qty < 0";
  $resultCount = mysqli_query($con, $query3);
  $fetchCount = mysqli_fetch_object($resultCount)->count;
  $isManufacturable = $fetchCount > 0 ? 0 : 1;
}


?>

<link rel="stylesheet" href="./styles/styles.css">


<div class="container">
  <h1>Manufacture</h1>

  <form action="">
    <div class="row" style="margin-top: 50px; margin-bottom: 50px">
      <div class="input-field col s10">
        <select name="med">
          <option value="" disabled selected>Medicine</option>
          <?php while ($fetch = mysqli_fetch_object($medicines)) { ?>
            <option value="<?php echo $fetch->id ?>"><?php echo $fetch->name ?></option>
          <?php } ?>
        </select>
        <label>Choose a Medicine</label>
      </div>
      <div class="s2">
        <button type="submit" class="waves-effect waves-light btn-large">Go</button>
      </div>
    </div>
  </form>

  <hr>

  <?php if (isset($_REQUEST["med"])) { ?>
    <h3><?php echo $medicine->name ?></h3>

    <div class="row">
      <form action="" method="POST" class="col s3">
        <input type="text" name="med" value="<?php echo $medicine->id ?>" hidden>
        <div class="input-field col s9">
          <input id="units" name="units" type="number" step="any" min="1" value="<?php echo $units ?>" class="validate" required onchange="this.form.submit()">
          <label for="units">Units</label>
        </div>
      </form>
      <div class="col s6">
        <form action="./manufacture/produce.php" action="POST">
          <input type="text" name="med" value="<?php echo $medicine->id ?>" hidden>
          <input type="text" name="units" value="<?php echo $units ?>" hidden>
          <button type="submit" class="waves-effect waves-light btn-large" <?php echo ($isManufacturable) ? "" : "disabled" ?>>Manufacture</button>
        </form>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col s9">
        <table>
          <thead>
            <tr>
              <th>Composition #</th>
              <th>Chemical Name</th>
              <th>Required / Available Quantity</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($fetch = mysqli_fetch_object($compositions)) { ?>
              <tr>
                <td><?php echo $fetch->comp_id ?></td>
                <td><?php echo $fetch->name ?></td>
                <td class="<?php echo ($fetch->left_qty < 0) ? "insufficient" : "" ?>">
                  <?php echo $fetch->req_qty ?> / <?php echo $fetch->qty ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

  <?php } ?>

</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
  });
</script>

<?php include("./include/footer.php") ?>