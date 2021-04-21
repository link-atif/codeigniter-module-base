
		<h3>Add Package</h3>
		<br />			
		<br />		
		<form method="POST" enctype="multipart/form-data">	
			
		<div class="row">
			<div class="col-md-12" >
								
				<div class="col-md-8">
				<div class="form-group">
					<div class="col-md-3">
						<label>Upload Image</label>
					</div>
					<div class="col-md-8">
						<input type="file" name="image" class="form-control">
					</div>
					<br>
					<br>				
				</div>
					<div class="form-group">
						<div class="col-md-3">
							<label>Title</label>
						</div>
						<div class="col-md-8">
							<input type="text" name="title" class="form-control">
						</div>
					</div>	
					<br>
					<br>
					<br>
					<div class="form-group">
						<div class="col-md-3">
							<label>Price</label>
						</div>
						<div class="col-md-8">
							<input type="number" name="price" class="form-control">
						</div>
					</div>	
					<br>
					<br>
					<div class="form-group">
						<div class="col-md-3">
							<label>Description</label>
						</div>
						<div class="col-md-8">
							<textarea name="editor1"></textarea>
			                <script>
			                        CKEDITOR.replace( 'editor1' );
			                </script>
						</div>
					</div>
	
					<div class="col-md-12" style="text-align: center;margin: 20px;">
						<button type="submit" name="submit" class="btn btn-info" >Submit</button>					
					</div>						
				</div>	
			
	
		</div>
		</div>
	</form>
