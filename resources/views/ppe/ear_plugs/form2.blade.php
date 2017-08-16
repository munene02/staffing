              
	        	 <div class="form-group">
	        		<label for="ear_plug">Select a Ear Plug:</label>
	        		<select id="ear_plug" name="ear_plug" class="form-control">
	        			@foreach($ear_plugs as $ear_plug)
								<option value="{{ $ear_plug->id }}"> {{ $ear_plug->ear_plug }} </option>>
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
       		
            