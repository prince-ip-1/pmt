<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
    <title>Bluepixel</title>
    <style>
      html body {
        font-family: 'Open Sans', sans-serif!important;
        color: #373A3C;
      }
      p.heading {
        font-weight: 500;
        letter-spacing: 0.5px;
        margin:10px;
        font-family: 'Open Sans', sans-serif;
        font-size: 25px;
      }
      p {
        font-size: 12.5px;
        margin-bottom: 30px;
      }
      table {  
        font-family: arial, sans-serif;  
        border-collapse: collapse;  
        width: 100%;
        margin: 0px auto;
        border: 2px solid #e6e6e6;
      }
      #htmlContent{
        font-family: 'Open Sans', sans-serif;
        text-align: center;
      }
      .table thead > th {
        font-family: 'Open Sans', sans-serif;
        font-weight: 600;
        background-color: #f5f5f5
      }
      td, th {  
        border: 2px solid #e6e6e6;
        text-align: left; 
        font-size: 14px;
        padding: 8px;  
      }
      @font-face {
        font-family: 'Open Sans', sans-serif;
        font-style: normal;
        font-weight: normal;
      }
    </style>  
</head>
<body>
  <div id="htmlContent">
    <p class="heading">Project: <?= $data['heading']; ?></p>  
    <p>Monthly Task report for <?= $data['month']; ?></p>  
    <table class="table">  
      <thead> 
        <tr>  
          <th>Task Title</th>
          <th>Employee Name</th>
          <th>Total Hours</th>
        </tr>
      </thead>  
      <tbody>  
        <?php 
        if(count($data['report_data']) > 0) {
          foreach($data['report_data'] as $k => $v) { 
        ?>
        <tr>  
            <td><?= $v['task']; ?></td>
            <td><?= $v['name']; ?></td>
            <td><?= $v['hours']; ?></td>
        </tr>
          <?php } ?>
        <tr>
          <td colspan="2" style="text-align: right;">Total</td>
          <td><?=$data['total_hours'];?></td>
        </tr>
        <?php } else {  ?>
          <tr>
            <td colspan="5" style="text-align: center;">No Data Found</td>
          </tr>
        <?php } ?>
      </tbody>  
    </table>    
  </div>
</body>
</html>