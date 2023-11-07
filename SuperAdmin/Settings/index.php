
			<form method="POST" action="Settings/import.php" enctype="multipart/form-data">
				<div class="form-group">
					<label for="file">File:</label>
				<!--	<input type="file" id="file" name="file" required>-->
                    
                    <input type="file" multiple name="filename" id="filename">
				</div>
				<button type="submit" name="import" class="btn btn-primary btn-sm">Import to the System</button>
			</form>
            
          <img src="settings/uploadexam.png" style="margin-top:10px">   	
        </div>