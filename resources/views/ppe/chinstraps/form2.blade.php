              
	        	 <div class="form-group">
	        		<label for="chinstrap">Select a Chinstrap:</label>
	        		<select id="chinstrap" name="chinstrap" class="form-control">
	        			@foreach($chinstraps as $chinstrap)
								<option value="{{ $chinstrap->id }}"> {{ $chinstrap->chinstrap }} </option>>
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
       		
            