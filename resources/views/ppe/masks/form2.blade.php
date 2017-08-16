              
	        	 <div class="form-group">
	        		<label for="mask">Select a Mask:</label>
	        		<select id="mask" name="mask" class="form-control">
	        			@foreach($masks as $mask)
								<option value="{{ $mask->id }}"> {{ $mask->mask }} </option>>
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
       		
            