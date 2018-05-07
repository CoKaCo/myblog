@include('include.header')
<br>
<br>
<br>
<br>
<br>

<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Shoping Cart
			</span>
		</div>
	</div>
		<div class="container ">
			<div class="row">
				
			</div>
		</div>

	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">

				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						@if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
						 @if (Cart::count() > 0)

            <h2>{{ Cart::count() }} item(s) in Shopping Cart</h2>
						<div class="wrap-table-shopping-cart">

							{{-- <h2 style="text-align: center;">3 Items in cart</h2> --}}
							<table class="table-shopping-cart">
								<tr class="table_head">

									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
								</tr>
								@foreach(Cart:: content() as $item)
									<tr class="table_row">
										<td class="column-1">
											<div class="how-itemcart1">
												<img src="{{asset('images/'.$item->model->slug.'.jpg')}}" alt="IMG">
											</div>
										</td>
										<td class="column-2"><a href="{{route('product.show',$item->model->slug)}}">{{ $item->model->name}}</td></a>
										<td class="column-3">{{ $item->model->presentprice()}}</td>
										<td class="column-4">
											{{-- <div class="wrap-num-product flex-w m-l-auto m-r-0"> --}}
												{{-- <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
													<i class="fs-16 zmdi zmdi-minus"></i>
												</div> --}}

												{{-- <input class="mtext-104 cl3 txt-center num-product quantity" type="number" name="num-product1" value="{{ $item->model->qty}}"> --}}
												<div class="form-group">
												    {{-- <label for="exampleFormControlSelect1">Example select</label> --}}
												    <select class="form-control quantity" id="exampleFormControlSelect1" data-id="{{ $item -> rowId }}">
												    	@for($i=1; $i < 5 + 1; $i++)
												      		<option value="{{$i}}" {{ $item->qty == $i ? 'selected':''}}>{{ $i }}</option>
												      	@endfor
												     {{--  <option>2</option>
												      <option>3</option>
												      <option>4</option>
												      <option>5</option> --}}
												    </select>
												 </div>

												{{-- <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
													<i class="fs-16 zmdi zmdi-plus"></i>
												</div> --}}
											{{-- </div> --}}
										</td>
										<style type="text/css">
											.hide{
												visibility: hidden;
											}
										</style>
										<td class="column-5">
										{{-- <td class="column-5"><a href="#">Save For Later</a><br> --}}
											<div class="hide">
											<form action="{{ route('cart.SwitchToSaveForLater',$item->rowId)}}" method="POST">
												{{-- <form action="/Cart/SwitchToSaveForLater/<?php echo $item->rowId; ?>" method="POST"> --}}
				                                {{ csrf_field() }}
				                                {{-- {{ method_field('DELETE') }} 	 --}}
												<button type="submit" class="cart-options"><i class="zmdi zmdi-favorite-outline"></i></button>
                            				</form>
                            			</div>
												<form action="/Cart/SwitchToSaveForLater/<?php echo $item->rowId; ?>" method="POST">
				                                {{ csrf_field() }}
				                                {{-- {{ method_field('DELETE') }} 	 --}}
												<button type="submit" class="cart-options"><i class="zmdi zmdi-favorite-outline"></i></button>
                            				</form>
											{{-- <a href="{{ route('cart.destroy', $item->rowId) }}">Remove</a> --}}
											<div class="hide">
											 <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
				                                {{ csrf_field() }}
				                                {{ method_field('DELETE') }}
												<button type="submit" class="cart-options"><i class="zmdi zmdi-delete"></i></button>
                            				</form>
                            				</div>
                            				<form action="/Cart/<?php echo $item->rowId; ?>" method="POST">
				                                {{ csrf_field() }}
				                                {{ method_field('DELETE') }} 	
												<button type="submit" class="cart-options"><i class="zmdi zmdi-delete"></i></button>
                            				</form>

										</td>
										<td class="column-6">{{ presentPrice(Cart:: total())}}</td>
									</tr>  
								@endforeach

							</table>

							
            				@else
				                <h3>No items in Cart!</h3>
				                <div class="spacer"></div>
				                <a href="/Products" class="button">Continue Shopping</a>
				                <div class="spacer"></div>
			                @endif
						</div>
						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
									
								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>
							</div>

							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
								{{ presentPrice(Cart:: subtotal())}}
								</span>
							</div>
							<div class="size-208">
								<span class="stext-110 cl2">
									Tax(13%):
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
								{{ presentPrice(Cart:: tax())}}
								</span>
							</div>
							<div class="size-208">
								<span class="stext-110 cl2">
									Discounted Amount:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
								{{ presentPrice(Cart:: tax())}}
								</span>
							</div>
						</div>
						{{-- <div class="flex-w flex-t bor12 p-t-15 p-b-30"> --}}
							{{-- <div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Discounted Amount:
								</span>
							</div>
 --}}
							{{-- <div class="size-209 p-r-18 p-r-0-sm w-full-ssm"> --}}
								{{-- <span class="mtext-110 cl2">
								{{ presentPrice(Cart:: tax())}}
								</span> --}}

								
								{{-- <div class="p-t-15"> --}}
									{{-- <span class="stext-112 cl8">
										Calculate Shipping
									</span> --}}

									{{-- <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="time">
											<option>Select a country...</option>
											<option>USA</option>
											<option>UK</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div> --}}

									{{-- <div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
									</div> --}}

									{{-- <div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
									</div> --}}
									
									{{-- <div class="flex-w">
										<div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
											Update Totals
										</div>
									</div>
										 --}}
								{{-- </div> --}}
							{{-- </div> --}}
						{{-- </div> --}}

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									{{ presentPrice(Cart:: total())}}
								</span>
							</div>
						</div>

						<a href="{{route('checkout.index')}}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Proceed to Checkout
						</a>
					</div>
				</div>
				
			</div>
		</div>
	</form>


						




						{{-- Wish List Starts here --}}




		<div class="container" id="Wish">
			<div class="row">
				<div class="col-lg-12 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							@if (Cart::instance('saveForLater')->count() > 0)

            <h2>{{ Cart::instance('saveForLater')->count() }} item(s) is Saved For later</h2>
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
								</tr>
								@foreach(Cart::instance('saveForLater')->content() as $item)
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="{{asset('images/'.$item->model->slug.'.jpg')}}" alt="IMG">
										</div>
									</td>
									<td class="column-2"><a href="{{route('product.show',$item->model->slug)}}">{{ $item->model->name}}</td></a>
									<td class="column-3">{{ $item->model->presentprice()}}</td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product2" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5">{{ $item->model->presentprice()}}</td>
									<style type="text/css">
											.hide{
												visibility: hidden;
											}
										</style>
										<td class="column-6">
										{{-- <td class="column-5"><a href="#">Save For Later</a><br> --}}
											<div class="hide">
											<form action="{{ route('saveForLater.SwitchToCart',$item->rowId)}}" method="POST">
												{{-- <form action="/Cart/SwitchToSaveForLater/<?php echo $item->rowId; ?>" method="POST"> --}}
				                                {{ csrf_field() }}
				                                {{-- {{ method_field('DELETE') }} 	 --}}
												<button type="submit" class="cart-options"><i class="zmdi zmdi-shopping-cart"></i></button>
                            				</form>
                            			</div>
												<form action="/saveForLater/SwitchToCart/<?php echo $item->rowId; ?>" method="POST">
				                                {{ csrf_field() }}
				                                {{-- {{ method_field('DELETE') }} 	 --}}
												<button type="submit" class="cart-options"><i class="zmdi zmdi-shopping-cart"></i></button>
                            				</form>
											{{-- <a href="{{ route('cart.destroy', $item->rowId) }}">Remove</a> --}}
											<div class="hide">
											 <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
				                                {{ csrf_field() }}
				                                {{ method_field('DELETE') }}
												<button type="submit" class="cart-options"><i class="zmdi zmdi-delete"></i></button>
                            				</form>
                            				</div>
                            				<form action="/saveForLater/<?php echo $item->rowId; ?>" method="POST">
				                                {{ csrf_field() }}
				                                {{ method_field('DELETE') }} 	
												<button type="submit" class="cart-options"><i class="zmdi zmdi-delete"></i></button>
                            				</form>

										</td>
									{{-- <td class="column-6"><a href="#"><i class="zmdi zmdi-shopping-cart"></i></a> | <a href="#"><i class="zmdi zmdi-delete"></i></a></td>
 --}}								</tr>
 										@endforeach
							</table>
							@else
				                <h3>No items is saved for later!</h3>
				                <div class="spacer"></div>
				                <a href="/Products" class="button">Continue Shopping</a>
				                <div class="spacer"></div>
			                @endif
						</div>

						{{-- <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm"> --}}
							{{-- <div class="flex-w flex-m m-r-20 m-tb-5"> --}}
								{{-- <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code"> --}}
									
								{{-- <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div> --}}
							{{-- </div> --}}

							{{-- <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</div> --}}
						{{-- </div> --}}
					</div>
				</div>

 
			</div>
		</div>
		{{-- @section('extra-js') --}}
		{{-- <script type="text/javascript" src="{{ asset('js/yutelajs/app.js') }}"></script> --}}
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<script type="text/javascript" src="{{asset('js/yutelajs/app.js')}}"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script type="text/javascript">
			(function(){
			    // alert ('Hi Shubham');
			    const classname = document.querySelectorAll('.quantity')


			    Array.from(classname).forEach(function(element){
			    	element.addEventListener('change',function(){
			    		const id = element.getAttribute('data-id')
			    		// alert ('changed');
			    		axios.patch(`/cart/${id}`, {
					    quantity: this.value
					   alert('hi');
					  });
					  .then(function (response) {
					    // console.log(response);
					    // window.loaction.reload();
					    location.reload();
					  });
					  .catch(function (error) {
					    console.log(error);
					  });
			    	})
			    })
			})();
		</script>
{{-- @endsection --}}

@include('include.footer')