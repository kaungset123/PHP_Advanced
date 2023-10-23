@extends("layout.master")

@section('title','Home page')

@section('content')
<input type="hidden" id="token" value="<?php

                                        use App\classes\Auth;
                                        use App\classes\CSRFToken;
                                        use App\classes\Session;

                                        echo CSRFToken::_token(); ?>">
<div class="container my-5">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Action</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody id="tablebody">

        </tbody>
        @if(Auth::check())
            <tr>
                <td colspan="7" style="text-align:right;" id="checkOutBtn">
                    <a><button class="btn-primary" onclick="payOut()">Checkout</button></a>
                </td>
            </tr>
            <tr style="visibility:hidden;" id="stripeTableRow">
                <td colspan="7" style="text-align: right;">
                    <form action="/payment/stripe" method="post" style="display: none;" id="stripeForm">
                        <script src="https://checkout.stripe.com/checkout.js" async class="stripe-button" 
                        data-key="<?php echo Session::get("publishable_key"); ?>" 
                        data-description="Access for a year" data-amount="5000" 
                        data-image="http://localhost/E-Commerce/public//assets//images/emoji.png" 
                        data-email="<?php echo Auth::user()->email; ?>" 
                        data-zip-code="true" 
                        data-locale="auto">
                        </script>
                    </form>
                </td>
            </tr>
        @else
            <tr>
                <td colspan="7" style="text-align:right;">
                    <a href="user/login"><button class="btn-primary">Login to Checkout</button></a>
                </td>
            </tr>
        @endif
    </table>
    <a href="getitem">show Item</a>
</div>
@endsection

@section ('script')
<script>
    function loadProduct() {
        $.ajax({
            type: "POST",
            url: "http://localhost/E-Commerce/public/cart",
            data: {
                "cart": getCartItem(),
                "token": $("#token").val()
            },
            success: function(results) {
                // clearCart();
                // console.log(result);
                // window.location.href="cart";
                saveProducts(results);
            },
            errors: function(response) {
                console.log(response.responseText);
            }
        })
    }

    function saveProducts(result) {
        localStorage.setItem("products", result); // string value return // saving the results as products
        let results = JSON.parse(localStorage.getItem("products")); // changing string value to json value
        showProducts(results);
    }

    function addProductQty(id) {
        var results = JSON.parse(localStorage.getItem("products"));
        results.forEach((result) => {
            if (result.id === id) {
                result.qty = result.qty + 1;
            }
        });
        saveProducts(JSON.stringify(results));
    }

    function deduceProductQty(id) {
        var results = JSON.parse(localStorage.getItem("products"));
        results.forEach((result) => {
            if (result.id === id) {
                if (result.qty > 1) {
                    result.qty = result.qty - 1;
                }
            }
        });
        saveProducts(JSON.stringify(results));
    }

    function showProducts(results) {
        var str = "";
        var total = 0;
        results.forEach((result) => {
            total += result.qty * result.price;
            str += "<tr>";
            str += `
                    <td>${result.id}</td>
                    <td ><img src='${result.image}' alt="" style="width:100px;height:110px;"></td>
                    <td>${result.name}</td>
                    <td>${result.price}</td>
                    <td>
                        ${result.qty}
                        <i class="fa fa-minus" style="cursor:pointer;" onclick="deduceProductQty(${result.id})"></i>
                        <i class="fa fa-plus" style="cursor:pointer;" onclick="addProductQty(${result.id})"></i>
                    </td>
                    <td><i class="fa fa-trash-o text-danger" onclick="deleteProduct(${result.id})"></i></td>
                    <td>
                        ${(result.qty * result.price).toFixed(2)}
                    </td>
               `;
            str += "</tr>";
        });
        str += `
                <tr>
                    <td colspan="6" style="text-align:center;">Grand Total</td>
                    <td>${total.toFixed(2)}</td>
                </tr>
            `
        $('#tablebody').html(str);
    }

    function deleteProduct(id) {
        // clearCart();
        // alert(id);
        var results = JSON.parse(localStorage.getItem("products"));
        results.forEach((result) => {
            if (result.id === id) {
                var ind = results.indexOf(result);
                results.splice(ind, 1);
            }
        });
        deleteItem(id);
        saveProducts(JSON.stringify(results));
    }

    function payOut() {
        // alert("payout");
        var results = JSON.parse(localStorage.getItem("products"));
        $.ajax({
            type: "POST",
            url: "http://localhost/E-Commerce/public/payout",
            data: {
                "items": results,
                "token": $("#token").val()
            },
            success: function(results) {
                console.log(results);
                $('#checkOutBtn').css("display","none");
                $('#stripeForm').css("display","block");
                $('#stripeTableRow').css("visibility","visible");
                // clearCart();
                // showCartItem();
                // showProducts();
            },
            errors: function(response) {
                console.log(response.responseText);
            }
        })
    }
    loadProduct();
</script>
@endsection