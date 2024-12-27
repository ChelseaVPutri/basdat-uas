<?php
include 'connection.php';
include 'function.php';

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

$main_query = "SELECT ukt FROM datamhs ORDER BY ukt ASC";
$main_res = $conn->query($main_query);
$ukt_data = [];
while ($row = $main_res->fetch_assoc()) {
  $ukt_data[] = $row['ukt'];
}

$q1 = getQuartile($ukt_data, 0.25);
$q2 = getQuartile($ukt_data, 0.5);
$q3 = getQuartile($ukt_data, 0.75);
$max = max($ukt_data);
$min = min($ukt_data);
$iqr = $q3 - $q1;
$outtop = $q3 + (1.5 * $iqr);
$outbot = ($q1 - (1.5 * $iqr)) > 0 ? ($q1 - (1.5 * $iqr)) : 0;
$stdev = standarDeviasiSampel($ukt_data);

$main_query_wo_outlier = "SELECT ukt FROM datamhs WHERE ukt >= $outbot AND ukt <= $outtop ORDER BY ukt ASC";
$main_res_woo = $conn->query($main_query_wo_outlier);
$ukt_data_woo = [];
while ($rowwoo = $main_res_woo->fetch_assoc()) {
  $ukt_data_woo[] = $rowwoo["ukt"];
}

$q2_woo = getQuartile($ukt_data_woo, 0.5);


if ($filter == 'max') {
  $query = "SELECT * FROM datamhs WHERE ukt = (SELECT MAX(ukt) FROM datamhs)";
} elseif ($filter === 'min') {
  $query = "SELECT * FROM datamhs WHERE ukt = (SELECT MIN(ukt) FROM datamhs)";
} elseif ($filter == 'sort_asc') {
  $query = "SELECT * FROM datamhs ORDER BY ukt ASC";
} elseif ($filter == 'sort_desc') {
  $query = "SELECT * FROM datamhs ORDER BY ukt DESC";
} elseif ($filter == 'q1') {
  $query = "SELECT * FROM datamhs WHERE ukt <= $q1 ORDER BY ukt ASC";
} elseif ($filter == 'q2') {
  $query = "SELECT * FROM datamhs WHERE ukt >= $q1 AND ukt <= $q2 ORDER BY ukt ASC";
} elseif ($filter == 'q3') {
  $query = "SELECT * FROM datamhs WHERE ukt >= $q3 ORDER BY ukt ASC";
} elseif ($filter == 'outtop') {
  $query = "SELECT * FROM datamhs WHERE ukt >= $outtop ORDER BY ukt ASC";
} elseif ($filter == 'outbot') {
  $query = "SELECT * FROM datamhs WHERE ukt <= $outbot ORDER BY ukt ASC";
} elseif ($filter == 'sort_asc_wo_outlier') {
  $query = "SELECT * FROM datamhs WHERE ukt >= $outbot AND ukt <= $outtop ORDER BY ukt ASC";
} elseif ($filter == 'sort_desc_wo_outlier') {
  $query = "SELECT * FROM datamhs WHERE ukt >= $outbot AND ukt <= $outtop ORDER BY ukt DESC";
} elseif ($filter == 'median_wo_outlier') {
  $query = "SELECT * FROM datamhs WHERE ukt >= $outbot AND ukt <= $outtop ORDER BY nim ASC";
} else {
  $query = "SELECT * FROM datamhs ORDER BY nim ASC";
}

$res = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Mahasiswa</title>
  <link rel="stylesheet" href="view-data-mahasiswa/view_data.css">
  <link rel="icon" href="./photo/UNJ.png">
</head>

<body>
  <header>
    <h1>DATA MAHASISWA</h1>
    <nav>
      <a href="insert-data.php">Insert</a>
      <a href="view-data.php">View</a>
    </nav>
  </header>
  <div class="container">
    <main>
      <div class="buttons">
        <form method="GET" action="view-data.php">
          <button type="submit" name="filter" value="all">ALL</button>
          <button type="submit" name="filter" value="sort_asc">SORT ASC</button>
          <button type="submit" name="filter" value="sort_desc">SORT DESC</button>
          <button type="submit" name="filter" value="max">MAX</button>
          <button type="submit" name="filter" value="min">MIN</button>
          <button type="submit" name="filter" value="median">MEDIAN</button>
          <button type="submit" name="filter" value="median_wo_outlier">MEDIAN W/O OUTLIER</button>
          <button type="submit" name="filter" value="q1">Q1</button>
          <button type="submit" name="filter" value="q2">Q2</button>
          <button type="submit" name="filter" value="q3">Q3</button>
          <button type="submit" name="filter" value="outtop">OUTLIER ATAS</button>
          <button type="submit" name="filter" value="outbot">OUTLIER BAWAH</button>
          <button type="submit" name="filter" value="stdev">STDEV</button>
          <button type="submit" name="filter" value="sort_asc_wo_outlier">SORT ASC W/O OUTLIER</button>
          <button type="submit" name="filter" value="sort_desc_wo_outlier">SORT DESC W/O OUTLIER</button>
        </form>
      </div>
      <?php if ($filter == 'max') { ?>
        <div>MAX = <?php echo number_format($max, 0, ',', '.'); ?></div>
      <?php }
      if ($filter === 'min') { ?>
        <div>MIN = <?php echo number_format($min, 0, ',', '.'); ?></div>
      <?php }
      if ($filter === 'q1') { ?>
        <div>QUARTILE 1 = <?php echo number_format($q1, 0, ',', '.'); ?></div>
      <?php }
      if ($filter === 'q2') { ?>
        <div>QUARTILE 2 = <?php echo number_format($q2, 0, ',', '.'); ?></div>
      <?php }
      if ($filter === 'median') { ?>
        <div>MEDIAN= <?php echo number_format($q2, 0, ',', '.'); ?></div>
      <?php }
      if ($filter === 'median_wo_outlier') { ?>
        <div>MEDIAN W/O OUTLIER= <?php echo number_format($q2_woo, 0, ',', '.'); ?></div>
      <?php }
      if ($filter === 'q3') { ?>
        <div>QUARTILE 3 = <?php echo number_format($q3, 0, ',', '.'); ?></div>
      <?php }
      if ($filter === 'outtop' || $filter === 'sort_asc_wo_outlier' || $filter === 'sort_desc_wo_outlier' || $filter === 'median_wo_outlier') { ?>
        <div>TOP OUTLIER = <?php echo number_format($outtop, 0, ',', '.'); ?></div>
      <?php }
      if ($filter === 'outbot' || $filter === 'sort_desc_wo_outlier' || $filter === 'sort_asc_wo_outlier' || $filter === 'median_wo_outlier') { ?>
        <div>BOTTOM OUTLIER = <?php echo number_format($outbot, 0, ',', '.'); ?></div>
      <?php }
      if ($filter === 'stdev') { ?>
        <div>STANDAR DEVIASI = <?php echo number_format($stdev, 3, ',', '.'); ?></div>
      <?php } ?>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Alamat</th>
            <th>Prodi</th>
            <th>UKT</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($res->num_rows > 0) {
            $no = 1;
            while ($row = $res->fetch_assoc()) {
              echo "<tr>
                          <td>" . $no++ . "</td>
                          <td>" . htmlspecialchars($row['nama']) . "</td>
                          <td>" . htmlspecialchars($row['nim']) . "</td>
                          <td>" . htmlspecialchars($row['alamat']) . "</td>
                          <td>" . htmlspecialchars($row['prodi']) . "</td>
                          <td>" . number_format($row['ukt'], 0, ',', '.') . "</td>
                        </tr>";
            }
          } else {
            echo "<tr><td colspan='6'>Kosong.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </main>
  </div>
</body>

</html>