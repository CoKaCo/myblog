@include('include.header')
<head>
    <link rel="stylesheet" type="text/css" href="">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
    {{-- <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
    <script src="https://js.stripe.com/v3/"></script>
    <style type="text/css">
        .StripeElement {
  background-color: white;
  height: 40px;
  width: 100%;
  padding: 10px 12px;
  border-radius: 4px;
  border: 1px solid transparent;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
    </style>
</head>
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
                                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="{{ $item->model->qty}}">

                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
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
                                                {{-- {{ method_field('DELETE') }}    --}}
                                                {{-- <button type="submit" class="cart-options">Save For Later</button> --}}
                                            </form>
                                        </div>
                                                <form action="/Cart/SwitchToSaveForLater/<?php echo $item->rowId; ?>" method="POST">
                                                {{ csrf_field() }}
                                                {{-- {{ method_field('DELETE') }}    --}}
                                                {{-- <button type="submit" class="cart-options">Save For Later</button> --}}
                                            </form>
                                            {{-- <a href="{{ route('cart.destroy', $item->rowId) }}">Remove</a> --}}
                                            <div class="hide">
                                             <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                {{-- <button type="submit" class="cart-options">Remove</button> --}}
                                            </form>
                                            </div>
                                            <form action="/Cart/<?php echo $item->rowId; ?>" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}    
                                                {{-- <button type="submit" class="cart-options">Remove</button> --}}
                                            </form>

                                        </td>
                                        <td class="column-6">$ 36.00</td>
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
                        </div>
                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Tax:
                                </span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2">
                                    {{presentPrice(Cart::tax()) }}
                                    {{-- {{Cart::shippping_tax() }} --}}
                                </span>
                            </div>
                        </div>

                        {{-- <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">
                                    Shipping:
                                </span>
                            </div>
 --}}
                            {{-- <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <p class="stext-111 cl6 p-t-2">
                                    There are no shipping methods available. Please double check your address, or contact us if you need any help.
                                </p>
                                
                                <div class="p-t-15">
                                    <span class="stext-112 cl8">
                                        Calculate Shipping
                                    </span>

                                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                        <select class="js-select2" name="time">
                                            <option>Select a country...</option>
                                            <option>USA</option>
                                            <option>UK</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
 --}}
                                    {{-- <div class="bor8 bg0 m-b-12">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
                                    </div>

                                    <div class="bor8 bg0 m-b-22">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
                                    </div>
 --}}                                    
                                   {{--  <div class="flex-w">
                                        <div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
                                            Update Totals
                                        </div>
                                    </div> --}}
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
                  {{--   </div>
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
                                    {{ presentPrice(Cart:: total())}}
                                </span>
                            </div>
                        </div>

                        {{-- <a href="{{route('checkout.index')}}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            Proceed to Checkout
                        </a> --}}
                    {{-- </div> --}}
                {{-- </div> --}}
                
            {{-- </div> --}}
        {{-- </div> --}}
    {{-- </form> --}}
{{-- <div class="container"> --}}
{{-- <form id="contact-form" method="post" action="contact.php" role="form"> --}}
    <form action="{{route('checkout.store')}}" method="POST" id="payment-form">
        {{ csrf_field() }}
         <div class="form-row">
            <label for="card-element">
                Credit or debit card
        </label>
        <div id="card-element">
      <!-- A Stripe Element will be inserted here. -->
      {{-- <input type="text" name="name"> --}}
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
        </div>

        <button>Submit Payment</button>
    </form>
            {{-- <div class="col-md-12">
                <input type="submit" class="btn btn-success btn-send" value="Send message">
            </div>
        </div> --}}
       
    {{-- </div> --}}

{{-- </form> --}}
{{-- </div> --}}
<script type="text/javascript">

    (function(){
    // Create a Stripe client.
var stripe = Stripe('pk_test_vpjHh7HLAO5pE1Nxn3X9siFO');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    lineHeight: '18px',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {
    style: style,
    hidePostalCode: true
});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
})();


</script>
 @include('include.footer')