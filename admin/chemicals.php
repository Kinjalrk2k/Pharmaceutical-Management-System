<?php
include("./include/header.php");
include("./include/connection.php");

$query = "select * from chemicals";
$result = mysqli_query($con, $query);

if (isset($_REQUEST["edit"])) {
  $query2 = "select * from chemicals where id='" . $_REQUEST["edit"] . "'";
  $result2 = mysqli_query($con, $query2);
  $modify = mysqli_fetch_object($result2);
}

if (isset($_REQUEST["delete"])) {
  $query2 = "delete from chemicals where id='" . $_REQUEST["delete"] . "'";
  $result2 = mysqli_query($con, $query2);
  header("location:./chemicals.php");
}
?>

<link rel="stylesheet" href="./styles/styles.css">


<div class="container ">
  <h1>Chemicals</h1>
  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3">
          <a class="<?php echo (isset($_REQUEST["edit"])) ? "" : "active" ?>" href="#list">
            Chemical Listing
          </a>
        </li>
        <li class="tab col s3"><a href="#add">Add chemical</a></li>
        <li class="tab col s3 <?php echo (isset($_REQUEST["edit"])) ? "" : "disabled" ?>">
          <a href="#modify" class="<?php echo (isset($_REQUEST["edit"])) ? "active" : "" ?>">
            Modify chemical
          </a>
        </li>
      </ul>
    </div>

    <div id="list" class="col s12 tab-row">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Chemical Name</th>
            <th>Rate (per Kg)</th>
            <th>Available Quantity (Kg)</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($fetch = mysqli_fetch_object($result)) { ?>
            <tr>
              <td><?php echo $fetch->id ?></td>
              <td>
                <img src="../uploads/<?php echo $fetch->image ?>" width="100px">
              </td>
              <td><?php echo $fetch->name ?></td>
              <td><?php echo $fetch->rate ?></td>
              <td><?php echo $fetch->qty ?></td>
              <td>
                <a class="btn-floating blue" href="./chemicals.php?edit=<?php echo $fetch->id ?>">
                  <i class="material-icons">edit</i>
                </a>
              </td>
              <td>
                <a class="btn-floating red" href="./chemicals.php?delete=<?php echo $fetch->id ?>">
                  <i class=" material-icons">delete</i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <div id="add" class="col s12 tab-row">
      <div class="row">
        <form action="./chemicals/chemAdd.php" method="POST" class="col s12" enctype="multipart/form-data">
          <div class="row">
            <div class="input-field col s9">
              <input name="name" id="name" type="text" class="validate" required autocomplete="off">
              <label for="name">Chemical Name</label>
            </div>
            <div class="input-field col s3">
              <input name="rate" id="rate" type="number" class="validate" required>
              <label for="rate">Rate (per Kg)</label>
            </div>
          </div>
          <div class="file-field input-field">
            <div class="btn">
              <span>Upload Image</span>
              <input name="image" type="file">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
          </div>
          <div class="flex-center">
            <button type="submit" class="waves-effect waves-light btn">
              <i class="material-icons left">add</i>
              Add Chemical
            </button>
          </div>
        </form>
      </div>
    </div>

    <div id="modify" class="col s12 tab-row">
      <div class="row">
        <form action="./chemicals/chemEdit.php" method="POST" class="col s12" enctype="multipart/form-data">
          <input name="id" type="text" value="<?php echo $modify->id ?>" hidden>
          <div class="row">
            <div class="col s2">
              Old Image
              <img src="../uploads/<?php echo $modify->image ?>" width="100px">
            </div>
            <div class="input-field col s7">
              <input name="name" id="name" type="text" value="<?php echo $modify->name ?>" class="validate" required autocomplete="off">
              <label for="name">Chemical Name</label>
            </div>
            <div class="input-field col s3">
              <input name="rate" id="rate" type="number" value="<?php echo $modify->rate ?>" class="validate" required>
              <label for="rate">Rate (per Kg)</label>
            </div>
          </div>
          <div class="file-field input-field">
            <div class="btn">
              <span>Upload Image</span>
              <input name="image" type="file">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
          </div>
          <div class="flex-center">
            <button type="submit" class="waves-effect waves-light btn">
              <i class="material-icons left">add</i>
              Update Chemical
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>


<script>
  var instance = M.Tabs.init(document.querySelector(".tabs"));
</script>

<?php include("./include/footer.php") ?>