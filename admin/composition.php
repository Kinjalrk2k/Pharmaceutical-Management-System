<?php
include("./include/header.php");
include("./include/connection.php");

$query = "select id, name from medicines";
$medicines = mysqli_query($con, $query);

$query3 = "select id, name from chemicals";
$chemicals = mysqli_query($con, $query3);

if (isset($_REQUEST["med"])) {
  $query = "select * from medicines where id='" . $_REQUEST["med"] . "'";
  $result = mysqli_query($con, $query);
  $medicine = mysqli_fetch_object($result);

  $query2 = "select * from composition, chemicals where mid='" . $_REQUEST["med"] . "'  and composition.cid=chemicals.id";
  $compositions = mysqli_query($con, $query2);
}

if (isset($_REQUEST["delete"])) {
  $query4 = "delete from composition where comp_id='" . $_REQUEST["delete"] . "'";
  $result4 = mysqli_query($con, $query4);
  header("location:./composition.php?med=" . $_REQUEST['med'] . "");
}
?>

<link rel="stylesheet" href="./styles/styles.css">


<div class="container">
  <h1>Compositions</h1>

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
    <hr>

    <div class="row">
      <div class="col s9">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Chemical Name</th>
              <th>Chemical Quantity (in Kgs)</th>
              <th>Total Chemical Cost</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $totalCosts = 0;
            while ($fetch = mysqli_fetch_object($compositions)) {
              $totalCosts += $fetch->rate * $fetch->c_qty;  ?>
              <tr>
                <td><?php echo $fetch->comp_id ?></td>
                <td><?php echo $fetch->name ?></td>
                <td><?php echo $fetch->c_qty ?></td>
                <td><?php echo $fetch->rate * $fetch->c_qty ?></td>
                <td>
                  <a class="btn-floating blue" href="./composition.php?med=<?php echo $medicine->id ?>&edit=<?php echo $fetch->comp_id ?>">
                    <i class="material-icons">edit</i>
                  </a>
                </td>
                <td>
                  <a class="btn-floating red" href="./composition.php?med=<?php echo $medicine->id ?>&delete=<?php echo $fetch->comp_id ?>">
                    <i class="material-icons">delete</i>
                  </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

        <div class="row" style="margin-top: 30px;">
          <div class="col s6">
            <h5>Total Chemical costing: <?php echo $totalCosts ?></h5>
          </div>
          <form action="./medicines/setprice.php" method="POST" class="col s6">
            <input type="text" name="id" value="<?php echo $medicine->id ?>" hidden>
            <div class="input-field col s9">
              <input id="price" name="price" type="number" step="any" value="<?php echo $medicine->price ?>" class="validate" required>
              <label for="price">Price</label>
            </div>
            <button type="submit" class="waves-effect waves-light btn col s3">
              Set Price
            </button>
          </form>
        </div>
      </div>

      <div class="col s3">
        <?php if (isset($_REQUEST["edit"])) {
          $query = "select * from composition where comp_id='" . $_REQUEST["edit"] . "'";
          $result = mysqli_query($con, $query);
          $composition = mysqli_fetch_object($result); ?>
          <h5>Edit Composition</h5>
          <form action="./composition/compoEdit.php" method="POST">
            <input type="text" name="comp_id" value="<?php echo $composition->comp_id ?>" hidden>
            <input type="text" name="mid" value="<?php echo $medicine->id ?>" hidden>
            <div class="row">
              <div class="input-field col s12">
                <select name="cid">
                  <option value="" disabled selected>Chemical</option>
                  <?php while ($fetch = mysqli_fetch_object($chemicals)) { ?>
                    <option value="<?php echo $fetch->id ?>" <?php echo $fetch->id == ($composition->cid) ? "selected" : "" ?>><?php echo $fetch->name ?></option>
                  <?php } ?>
                </select>
                <label>Choose a Chemical</label>
              </div>
              <div class="input-field col s12">
                <input name="c_qty" id="c_qty" type="number" value="<?php echo $composition->c_qty ?>" class="validate" step="any" required>
                <label for="c_qty">Quantity</label>
              </div>
            </div>
            <div class="flex-center">
              <button type="submit" class="waves-effect waves-light btn">
                <i class="material-icons left">add</i>
                Edit
              </button>
            </div>
          </form>

        <?php } else {  ?>
          <h5>Add Composition</h5>
          <form action="./composition/compoAdd.php" method="POST">
            <input type="text" name="mid" value="<?php echo $medicine->id ?>" hidden>
            <div class="row">
              <div class="input-field col s12">
                <select name="cid">
                  <option value="" disabled selected>Chemical</option>
                  <?php while ($fetch = mysqli_fetch_object($chemicals)) { ?>
                    <option value="<?php echo $fetch->id ?>"><?php echo $fetch->name ?></option>
                  <?php } ?>
                </select>
                <label>Choose a Chemical</label>
              </div>
              <div class="input-field col s12">
                <input name="c_qty" id="c_qty" type="number" class="validate" step="any" required>
                <label for="c_qty">Quantity</label>
              </div>
            </div>
            <div class="flex-center">
              <button type="submit" class="waves-effect waves-light btn">
                <i class="material-icons left">add</i>
                Add
              </button>
            </div>
          </form>
        <?php }  ?>

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