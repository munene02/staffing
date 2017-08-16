              
	        	 <div class="form-group">
	        		<label for="helmet">Select a Helmet:</label>
	        		<select id="helmet" name="helmet" class="form-control">
	        			@foreach($helmets as $helmet)
								<option value="{{ $helmet->id }}"> {{ $helmet->helmet }} </option>>
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
       		
            