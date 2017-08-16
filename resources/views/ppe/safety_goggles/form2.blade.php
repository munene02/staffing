              
	        	 <div class="form-group">
	        		<label for="safety_goggle">Select a Safety Goggle:</label>
	        		<select id="safety_goggle" name="safety_goggle" class="form-control">
	        			@foreach($safety_goggles as $safety_goggle)
								<option value="{{ $safety_goggle->id }}"> {{ $safety_goggle->safety_goggle }} </option>>
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
       		
            