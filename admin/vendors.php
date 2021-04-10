<?php
include("./include/connection.php");
include("./include/header.php");

$queryV = "create or replace view vtView as SELECT users.name, users.email, vendortransactions.qty, chemicals.name as chemName, chemicals.rate, vendortransactions.qty*chemicals.rate as amt FROM vendortransactions, chemicals, users WHERE vendortransactions.cid = chemicals.id AND vendortransactions.vid = users.id";
$resultQ = mysqli_query($con, $queryV);

$query = "select * from vtView";
$result = mysqli_query($con, $query);

$query1 = "select sum(amt) as total from vtView";
$result1 = mysqli_query($con, $query1);
$totalAmt = mysqli_fetch_object($result1)->total;
?>

<link rel="stylesheet" href="./styles/styles.css">

<div class="container">
  <h1>Vendor Transactions</h1>

  <table>
    <thead>
      <tr>
        <th>Vendor Name</th>
        <th>Vendor Email</th>
        <th>Chemical Name</th>
        <th>Chemical Rate</th>
        <th>Quantity</th>
        <th>Amount</th>
      </tr>
    </thead>

    <tbody>
      <?php while ($fetch = mysqli_fetch_object($result)) { ?>
        <tr>
          <td><?php echo $fetch->name ?></td>
          <td><?php echo $fetch->email ?></td>
          <td><?php echo $fetch->chemName ?></td>
          <td><?php echo $fetch->rate ?></td>
          <td><?php echo $fetch->qty ?></td>
          <td><?php echo $fetch->amt ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <h4 style="text-align: end; font-weight: 600; color: red">Total Debit: <?php echo $totalAmt ?></h4>

</div>

<?php include("./include/footer.php") ?>