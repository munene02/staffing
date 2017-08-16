              
	        	 <div class="form-group">
	        		<label for="glove">Select a Glove:</label>
	        		<select id="glove" name="glove" class="form-control">
	        			@foreach($gloves as $glove)
								<option value="{{ $glove->id }}"> {{ $glove->glove }} </option>>
	        			@endforeach
	        		</select>
	        	</div>
                         
            	<div class="form-group">
        			<label for="quantity">Enter Quantity</label>
        			<input type="text" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}">
        		</div>


	                <div class="form-group">
	                        <button type="submit" class="btn btn-primary" id="btn-submit">Add To Stock</button> 
	                </div>
       		
            