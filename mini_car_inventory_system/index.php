<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mini Car Inventory System</title>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> 
  <script src="jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.css">
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript">


    window.onload=function(){

        $(document).ready(function () {
          var companyTable=  $('#jobs').DataTable();   
          $('#jobs').on('click', 'tr', function () {
             var name = $('td', this).eq().text();
             console.log( companyTable.row(this).data()[0]);
      // console.log( companyTable.row(this).data()[1]);
      $("#manufacturer_name").val(companyTable.row(this).data()[1]);
      $("#model_name").val(companyTable.row(this).data()[2]);
      $("#count").val(companyTable.row(this).data()[3]);
      $('#DescModal').modal("show");
  });
      });

    }

</script>
</head>
<body>
    <div class="container">
       <h1 class="page-header text-center">Mini Car Inventory System</h1>
       <div class="row">
          <div class="col-sm-8 col-sm-offset-2">
             <a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Manufacturer</a>
             <a href="#addnew1" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Model</a>
             <?php 
             session_start();
             if(isset($_SESSION['message'])){
                ?>
                <div class="alert alert-info text-center" style="margin-top:20px;">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php

                unset($_SESSION['message']);
            }
            ?>
            <div><center> <h4>View Inventory</h4></center></div>

            <table id="jobs" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Serial Number</th>
                        <th>Manufacturer Name</th>
                        <th>Model Name</th>
                        <th>Count</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                        //include our connection
                    include_once('connection.php');

                    $database = new Connection();
                    $db = $database->open();
                    try{    
                        $sql = 'SELECT * FROM model';

                        foreach ($db->query($sql) as $row) {
                            $manufacturing_year=$row['manufacturing_year'];
                            $color=$row['color'];
                            $registration_number=$row['registration_number'];
                            $note=$row['note'];
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['manufacturer_name']; ?></td>
                                <td><?php echo $row['model_name']; ?></td> 
                                <td><?php echo $row['count']; ?></td>  
                            </tr>
                            <?php 
                        }
                    }
                    catch(PDOException $e){
                        echo "There is some problem in connection: " . $e->getMessage();
                    }

                        //close connection
                    $database->close();

                    ?>   
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="DescModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Model Details</h3>

            </div>
            <div class="modal-body">

                <div class="row dataTable">
                    <div class="col-md-4">
                        <label class="control-label">Manufacturer Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="manufacturer_name" name="manufacturer_name" readonly />
                    </div>
                </div>

                <br>
                <div class="row dataTable">
                    <div class="col-md-4">
                        <label class="control-label">Model Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="model_name" name="model_name" readonly />
                    </div>
                </div>
                <br>
                <div class="row dataTable">
                    <div class="col-md-4">
                        <label class="control-label">Count</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="count" name="count" readonly />
                    </div>
                </div>
                <br>
                <div class="row dataTable">
                    <div class="col-md-4">
                        <label class="control-label">Color</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="color" name="color" value="<?php echo $color;?>" readonly />
                    </div>
                </div>
                <br>

                <div class="row dataTable">
                    <div class="col-md-4">
                        <label class="control-label">Manufacturing Year</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="manufacturing_year" name="manufacturing_year" value="<?php echo $manufacturing_year;?>" readonly />
                    </div>
                </div>
                <br>
                <div class="row dataTable">
                    <div class="col-md-4">
                        <label class="control-label">Registration Number</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="registration_number" name="registration_number" value="<?php echo $registration_number;?>" readonly />
                    </div>
                </div>
                <br>
                <div class="row dataTable">
                    <div class="col-md-4">
                        <label class="control-label">Note</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="note" name="note" value="<?php echo $note;?>" readonly />
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Sold</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php include('add_manufacturer_modal.php'); ?>
<?php include('add_model_modal.php'); ?>
</body>
</html>