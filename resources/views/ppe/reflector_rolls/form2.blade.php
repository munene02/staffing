              
	        	 <div class="form-group">
	        		<label for="reflector_roll">Select a Reflector Roll:</label>
	        		<select id="reflector_roll" name="reflector_roll" class="form-control">
	        			@foreach($reflector_rolls as $reflector_roll)
								<option value="{{ $reflector_roll->id }}"> {{ $reflector_roll->reflector_roll }} </option>>
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
       		
            