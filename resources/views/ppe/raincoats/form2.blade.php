@inject('variants', 'App\Http\Utilities\Varianted')
@inject('colors', 'App\Http\Utilities\Colored')
@inject('companies', 'App\Http\Utilities\Companied')
@inject('sizes', 'App\Http\Utilities\Sized')
				
				
                         
            	<div class="form-group">
        			<label for="quantity">Enter Quantity</label>
        			<input type="text" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}">
        		</div>
	
        		<input type="hidden" name="raincoat" value="{{ $raincoats->id}}">


	                <div class="form-group">
	                        <button type="submit" class="btn btn-primary" id="btn-submit">Add To Stock</button> 
	                </div>
       		
            