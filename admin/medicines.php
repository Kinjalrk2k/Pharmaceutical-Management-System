<?php
include("./include/connection.php");
include("./include/header.php");

$query = "select * from medicines";
$result = mysqli_query($con, $query);

if (isset($_REQUEST["edit"])) {
  $query2 = "select * from medicines where id='" . $_REQUEST["edit"] . "'";
  $result2 = mysqli_query($con, $query2);
  $modify = mysqli_fetch_object($result2);
}

if (isset($_REQUEST["delete"])) {
  $query2 = "delete from medicines where id='" . $_REQUEST["delete"] . "'";
  $result2 = mysqli_query($con, $query2);
  $query3 = "delete from composition where mid='" . $_REQUEST["delete"] . "'";
  $result3 = mysqli_query($con, $query3);
  header("location:./medicines.php");
}
?>

<link rel="stylesheet" href="./styles/styles.css">


<div class="container">
  <h1>Medicines</h1>
  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3">
          <a class="<?php echo (isset($_REQUEST["edit"])) ? "" : "active" ?>" href="#list">
            Medicine Listing
          </a>
        </li>
        <li class="tab col s3"><a href="#add">Add medicine</a></li>
        <li class="tab col s3 <?php echo (isset($_REQUEST["edit"])) ? "" : "disabled" ?>">
          <a href="#modify" class="<?php echo (isset($_REQUEST["edit"])) ? "active" : "" ?>">
            Modify medicine
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
            <th>Medicine Name</th>
            <th>Price</th>
            <th>Available Quantity</th>
            <th>For Sale?</th>
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
              <td><?php echo $fetch->price ?></td>
              <td><?php echo $fetch->qty ?></td>
              <td>
                <div class="switch">
                  <form action="./medicines/toggleSale.php" method="POST">
                    <input type="text" name="id" value="<?php echo $fetch->id ?>" hidden>
                    <label>
                      No
                      <input type="checkbox" name="forSale" value="<?php echo $fetch->id ?>" <?php echo ($fetch->forSale == "1") ? "checked" : "" ?> onchange="this.form.submit()">
                      <span class="lever"></span>
                      Yes
                    </label>
                  </form>
                </div>
              </td>
              <td>
                <a class="btn-floating blue" href="./medicines.php?edit=<?php echo $fetch->id ?>">
                  <i class="material-icons">edit</i>
                </a>
              </td>
              <td>
                <a class="btn-floating red" href="./medicines.php?delete=<?php echo $fetch->id ?>">
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
        <form action="./medicines/medicineAdd.php" method="POST" class="col s12" enctype="multipart/form-data">
          <div class="row">
            <div class="input-field col s6">
              <input name="name" id="name" type="text" class="validate" required autocomplete="off">
              <label for="name">Medicine Name</label>
            </div>
            <div class="file-field input-field col s6">
              <div class="btn">
                <span>Upload Image</span>
                <input name="image" type="file">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
          </div>
          <div class="flex-center">
            <button type="submit" class="waves-effect waves-light btn">
              <i class="material-icons left">add</i>
              Add Medicine
            </button>
          </div>
        </form>
      </div>
    </div>

    <div id="modify" class="col s12 tab-row">
      <div class="row">
        <form action="./medicines/medicineEdit.php" method="POST" class="col s12" enctype="multipart/form-data">
          <input name="id" type="text" value="<?php echo $modify->id ?>" hidden>
          <div class="row">
            <div class="col s2">
              Old Image
              <img src="../uploads/<?php echo $modify->image ?>" width="100px">
            </div>
            <div class="input-field col s6">
              <input name="name" id="name" type="text" value="<?php echo $modify->name ?>" class="validate" required autocomplete="off">
              <label for="name">Medicine Name</label>
            </div>
            <div class="file-field input-field col s4">
              <div class="btn">
                <span>Upload Image</span>
                <input name="image" type="file">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
          </div>
          <div class="flex-center">
            <button type="submit" class="waves-effect waves-light btn">
              <i class="material-icons left">add</i>
              Update Medicine
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