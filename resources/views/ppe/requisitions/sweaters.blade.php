<div class="box">
        <div class="box-header">
           	<h3 class="box-title"> Sweaters </h3>
        </div>
        <div class="box-body">
      		@if(count($errors) > 0)
        		<div class="alert alert-danger">
        			<ul>
        				@foreach($errors->all() as $error)
        				<li>{{ $error }}</li>
        				@endforeach
        			</ul>
        		</div>
			    @endif
			<table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 50px"></th>
                  <th>Sweater Name</th>  
                  <th>Sweater Size</th> 
                  <th>Stock Qty</th>        
                  <th style="width: 200px">Requisition Qty</th>
                </tr>
                @foreach($items as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->color }}  {{ $item->variant }} </td>
                  <td>{{ $item->size }}</td>
                  <td>{{ $item->quantity }}</td>
				          <td>
          				  <form action="/requisitions/add" method="POST" >{!! csrf_field() !!}
                    <div class="input-group">                  
                    <input type="hidden" name="stock_id" value="{{$item->id}}">
                    <input type="hidden" name="stock_name" value="{{$id}}">
                    <input type="hidden" name="stock_details" value="{{$item->color}} {{ $item->size }}">
                    <input type="text" class="form-control" name="quantity">
                  	<span class="input-group-btn">
                      <button type="submit" class="btn bg-blue btn-flat" id="btn-submit1">ADD</button>
                    </span></div>
                    </form>
                  </td>                 
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
	</div>