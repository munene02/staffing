
	        	 <div class="form-group">
	        		<label for="helmet">Helmet Name/Brand:</label>
					<input type="text" name="helmet" id="helmet" class="form-control" value="{{ old('helmet') }}">
	        	</div>
                         
            	<div class="form-group">
        			<label for="quantity">Enter Quantity</label>
        			<input type="text" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}">
        		</div>

        		<div class="form-group">
        			<label for="reorder_level">Enter Reorder Level Quantity</label>
        			<input type="text" name="reorder_level" id="reorder_level" class="form-control" value="{{ old('reorder_level') }}">
        		</div>


	                <div class="form-group">
	                        <button type="submit" class="btn btn-primary" id="btn-submit">Add New Item</button> 
	                </div>
       		
            