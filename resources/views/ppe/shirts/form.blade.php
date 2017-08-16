@inject('variants', 'App\Http\Utilities\Varianted')
@inject('colors', 'App\Http\Utilities\Colored')
@inject('companies', 'App\Http\Utilities\Companied')
@inject('sizes', 'App\Http\Utilities\Sized')

	        	<div class="form-group">
                    <label for="color">Shirt Color:</label>
                    <select id="color" name="color" class="form-control">
                        @foreach($colors::colored() as $color)
                                <option value="{{ $color->color }}"> {{ $color->color }} </option>>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="size">Shirt Size:</label>
                    <select id="size" name="size" class="form-control">
                        @foreach($sizes::sized() as $size)
                                <option value="{{ $size->size }}"> {{ $size->size }} </option>>
                        @endforeach
                    </select>
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
       		
            