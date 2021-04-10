<?php
include("./include/connection.php");
include("./include/header.php");

$queryV = "create or replace view ctView as SELECT users.name, users.email, customertransactions.qty, medicines.name as medName, medicines.price, customertransactions.qty*medicines.price as amt FROM customertransactions, medicines, users WHERE customertransactions.mid = medicines.id AND customertransactions.cid = users.id";
$resultQ = mysqli_query($con, $queryV);

$query = "select * from ctView";
$result = mysqli_query($con, $query);

$query1 = "select sum(amt) as total from ctView";
$result1 = mysqli_query($con, $query1);
$totalAmt = mysqli_fetch_object($result1)->total;
?>

<link rel="stylesheet" href="./styles/styles.css">

<div class="container">
  <h1>Customer Transactions</h1>

  <table>
    <thead>
      <tr>
        <th>Cutomer Name</th>
        <th>Cutomer Email</th>
        <th>Medicine Name</th>
        <th>Medicine Price</th>
        <th>Quantity</th>
        <th>Amount</th>
      </tr>
    </thead>

    <tbody>
      <?php while ($fetch = mysqli_fetch_object($result)) { ?>
        <tr>
          <td><?php echo $fetch->name ?></td>
          <td><?php echo $fetch->email ?></td>
          <td><?php echo $fetch->medName ?></td>
          <td><?php echo $fetch->price ?></td>
          <td><?php echo $fetch->qty ?></td>
          <td><?php echo $fetch->amt ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <h4 style="text-align: end; font-weight: 600; color: green">Total Credit: <?php echo $totalAmt ?></h4>

</div>

<?php include("./include/footer.php") ?>