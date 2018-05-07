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
		

	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-xl-7 m-lr-auto m-b-50">
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


						<div class="wrap-table-shopping-cart">
							@if (Cart::count() > 0)

            <h2>{{ Cart::count() }} item(s) in Shopping Cart</h2>
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
									{{-- <td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td> --}}
									<td class="column-4">{{ $item->model->qty}}1</td>
									<td class="column-4">{{ $item->model->presentprice()}}</td>
									{{-- <td class="column-5"><a href="#"><i class="zmdi zmdi-favorite-outline"></i></a> | <a href="#"><i class="zmdi zmdi-delete"></i></a></td> --}}
								</tr>

								{{-- <tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="images/item-cart-05.jpg" alt="IMG">
										</div>
									</td>
									<td class="column-2">Lightweight Jacket</td>
									<td class="column-3">$ 16.00</td>
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
									<td class="column-5">$ 16.00</td>
								</tr> --}}
								 @endforeach

							</table>
							  
                            @else
                                <h3>No items in Cart!</h3>
                                <div class="spacer"></div>
                                <a href="/Products" class="button">Continue Shopping</a>
                                <div class="spacer"></div>
                            @endif
						</div>
						{{-- @if(!session()->has('coupon')) --}}
						<style type="text/css">
							.hide {
								/*display: none;*/
								visibility: none;
							}
						</style>

						<div class="hide">
						<form action="coupon/store" method="POST">
							{{ csrf_field() }}
							<input type="text" name="coupon_code" id="coupon_code">
							<button type="submit" name="submit"></button>
						</form>
						</div>
						{{-- <form action="{{route('coupon.store')}}" method="POST">
							{{ csrf_field() }}	
							<input type="text" name="">
							<button type="submit" name="submit">Apply Coupon</button>
						</form> --}}
						<form action="{{route('coupon.store')}}" method="POST">
						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
									{{ csrf_field() }}
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon_code" id="coupon_code" placeholder="Coupon Code">
									
								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									<button type="submit" name="submit" >Apply Coupon</button>
								</div>
							</div>
			{{-- @endif --}}


							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</div>
						</div>
					</div>
				</div>
			</form>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal 
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
									{{ presentPrice(Cart:: subtotal())}}
								</span>
							</div>
							<div class="size-208">
								<span class="stext-110 cl2" style="font-size: 12px;">
									
									Discount Amount
									@if(session()->has('coupon'))
									({{session()->get('coupon')['name']}}):
									<form action="{{route('coupon.destroy')}}" method="POST" style="display: inline;">
								{{ csrf_field() }}
								{{ method_field('delete') }}
							<button type="submit" name="submit" style="font-size: 18px;"><i class="zmdi zmdi-delete"></i></button>
							</form>
							@endif
								</span>
							</div>
							
							
							<div class="size-209">
								<span class="mtext-110 cl2" style="">
									{{presentPrice(session()->get('coupon')['discount'])}}
								</span>
							</div>
							{{-- <hr> --}}

						</div>

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							@if(session()->has('coupon'))
							<div class="size-208">
								<span class="stext-110 cl2">
									New Subtotal
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
									{{presentPrice($newSubtotal) }}
									{{-- stuff --}}
								</span>
							</div>
							@endif
							<div class="size-208">
								<span class="stext-110 cl2">
									Tax (13%) 
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
									{{presentPrice($newTax) }}
								</span>
							</div>
							{{-- <div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Tax (13%) :
								</span>
							</div> --}}
							<div class="size-209">
								{{-- <span class="mtext-110 cl2">
									$79.65
								</span> --}}
								
								<div class="p-t-15">
									<span class="stext-112 cl8">
										Personal Details
									</span>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<input type="text" name="name" class="stext-111 cl8 plh3 size-111 p-lr-15" placeholder="Name">
									</div>
									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<input type="email" name="email" class="stext-111 cl8 plh3 size-111 p-lr-15" placeholder="email">
									</div>
									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<input type="text" name="contact" class="stext-111 cl8 plh3 size-111 p-lr-15" placeholder="Contact no">
									</div>
									{{-- <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="time">
											<option>Select a country...</option>
											<option>USA</option>
											<option>UK</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div> --}}
									

									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
									</div>
									
									{{-- <div class="flex-w">
										<div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
											Update Totals
										</div>
									</div> --}}
										
								</div>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									 {{ presentPrice($newTotal)}}
								</span>
							</div>
						</div>

						<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Make Payment
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>

@include('include.footer')