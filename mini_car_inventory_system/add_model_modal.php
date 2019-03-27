<style>
.selectBox{border-radius:4px;border:1px solid #AAAAAA;display: block;
    width: 100%;
    height: 30px;
}
</style>
<script type="text/javascript">
	function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
<script language="Javascript" type="text/javascript"> 

        function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        } 

    </script>
<div class="modal fade" id="addnew1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Add Model</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" enctype="multipart/form-data" action="add_model.php">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label">Model Name:</label>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="model_name" required="">
					</div>
					<div class="col-sm-2">
						<label class="control-label">Manufacturar Name:</label>
					</div>
					<div class="col-sm-4">
						<select required="" name="manufacturer_name" class="selectBox" style="width:100%">
							<option value="">SELECT</option>
							<?php
							include_once('connection.php');

						$database = new Connection();
    					$db = $database->open();
							
						    $sql = 'SELECT * FROM manufacturer';
						    foreach ($db->query($sql) as $row) 
						    {
						    	
						    		echo '<option value="'.$row['manufacturer_name'].'">'.$row['manufacturer_name'].'</option>';
						    }
						
						?>

						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Color:</label>
					</div>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="color" onkeypress="return onlyAlphabets(event,this);">
					</div>
				</div> 
				 <div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Manufacturing Year:</label>
					</div>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="manufacturing_year" minlength="4" maxlength="4" onkeypress="return isNumber(event)">
					</div>
				</div> 
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Registration Number:</label>
					</div>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="registration_number">
					</div>
				</div> 
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Note :</label>
					</div>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="note">
					</div>
				</div> 
					<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Count :</label>
					</div>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="count" minlength="1" maxlength="12" onkeypress="return isNumber(event)">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Picture 1 :</label>
					</div>
					<div class="col-sm-9">
						<input type="file" name="picture_1">
					</div>
				</div> 
				<div class="row form-group">
					<div class="col-sm-3">
						<label class="control-label" style="position:relative; top:7px;">Picture 2 :</label>
					</div>
					<div class="col-sm-9">
						<input type="file" name="picture_2">
					</div>
				</div> 
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Submit</a>
			</form>
            </div>

        </div>
    </div>
</div>