<?php include("../include/header.php") ?>

<!-- <h1>Medicines</h1> -->

<div class="row">
  <div class="col s12">
    <ul class="tabs">
      <li class="tab col s3"><a href="#test1">Medicine Listing</a></li>
      <li class="tab col s3"><a class="active" href="#test2">Add</a></li>
    </ul>
  </div>
  <div id="test1" class="col s12">Medicine Listing</div>
  <div id="test2" class="col s12">Add</div>
</div>

<script>
  var instance = M.Tabs.init(document.querySelector(".tabs"));
</script>

<?php include("../include/footer.php") ?>