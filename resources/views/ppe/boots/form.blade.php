@inject('heights', 'App\Http\Utilities\Height')
@inject('sizes', 'App\Http\Utilities\Size')

        	<div class="box-body">
        		<div class="form-group">
        			<label for="brand">Boot Name/Brand</label>
        			<input type="text" name="brand" id="brand" class="form-control" value="{{ old('brand') }}">
        		</div>
        		
                <div class="form-group">
	        		<label for="height">Boot Height:</label>
	        		<select id="height" name="height" class="form-control">
	        			@foreach($heights::height() as $height)
								<option value="{{ $height->id }}"> {{ $height->height }} </option>
	        			@endforeach
	        		</select>
	        	</div>

	        	 <div class="form-group">
	        		<label for="size">Boot Size:</label>
	        		<select id="size" name="size" class="form-control">
	        			@foreach($sizes::size() as $size)
								<option value="{{ $size->id }}"> {{ $size->size }} </option>>
	        			@endforeach
	        		</select>
	        	</div>
                         
            	<div class="form-group">
        			<label for="quantity">Quantity</label>
        			<input type="text" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}">
        		</div>

        		<div class="form-group">
        			<label for="reorder_level">Reorder Level</label>
        			<input type="text" name="reorder_level" id="reorder_level" class="form-control" value="{{ old('reorder_level') }}">
        		</div>


	                <div class="form-group">
	                        <button type="submit" class="btn btn-primary" id="btn-submit">Add To Stock</button> 
	                </div>
       		
            </div>