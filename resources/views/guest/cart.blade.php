@extends('guest.master')

@section('titles')
Cart
@endsection
@section('styles')
<style>
    body {
        overflow-x: hidden;
    }

    .star {
        cursor: pointer;
    }

    .star.filled {
        color: gold;
        /* Change the color of the filled stars */
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12 my-5">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Pro_id</th>
                            <th scope="col">Pro_name</th>
                            <th scope="col">Pro_price</th>
                            <th>Pro_size</th>
                            <th>Pro_for</th>
                            <th>Pro_category</th>
                            <th>Image</th>
                            <th>Qty</th>
                            <th>Total </th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 col-md-4 mt-4 border bg-light text-dark rounded p-4" style="width: 400px">
            <h3>Total: </h3>
            <h5 id="grandTotal" style="float: right;"></h5>

            <form method="post" id="makePurchaseForm">
                @csrf
                <div class="row mt-4">
                    <div class="col-12 mt-4">
                        <label for="" class="form-label">Email</label>
                        <input type="email" value="{{ session('user_email') }}" class="form-control" readonly>
                    </div>

                    <div class="col-12 mt-4">
                        <label for="">Enter the coupen code</label>
                        <div class="" style="gap: 10px; margin-top:10px">
                            <input type="text" name="" id="coupen" class="form-control">

                        </div>


                    </div>
                    <div class="col-12 mt-4">
                        <label for="">Enter the address</label>
                        <input id="address" type="text" class="form-control mt-2"></input>

                    </div>

                    <center>
                        <div class="col-12 mt-4">
                            <input type="submit" value="Make Purchase" class="btn btn-primary">
                        </div>
                    </center>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rate and Review us</h5>


                </div>
                <div class="modal-body text-center">
                    <span style="font-size: 2rem;" class="star" data-value="1" style="cursor:pointer;">&star;</span>
                    <span style="font-size: 2rem;" class="star" data-value="2" style="cursor:pointer;">&star;</span>
                    <span style="font-size: 2rem;" class="star" data-value="3" style="cursor:pointer;">&star;</span>
                    <span style="font-size: 2rem;" class="star" data-value="4" style="cursor:pointer;">&star;</span>
                    <span style="font-size: 2rem;" class="star" data-value="5" style="cursor:pointer;">&star;</span>

                    <form method="post" id="myForm">
                        @csrf
                        <div class="row">
                            <div class="col-12 mt-4">
                                <label for="" class="mb-4">Enter your review</label>
                                <input type="text" name="review" id="review" class="form-control" required>

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary button-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Reveiw</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/sweetAlert.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    $(document).ready(function () {
        function loadAllCartDetails() {
            $.ajax({
                type: "GET",
                url: "get-cart-details",
                success: function (response) {

                    if (response.status == 'details') {
                        let grandTotal = 0
                        $("tbody").html('')
                        $.each(response.details, function (indexInArray, valueOfElement) {
                            const { id, email, Product_id, Product_name, Product_price, Product_for, Product_category, Product_image, quantity, Product_size } = valueOfElement


                            let product_price = Product_price;
                            let Quantity = quantity;
                            let total = product_price * parseInt(Quantity);
                            grandTotal += total;

                            $("tbody").append(
                                `
                                    <tr class='text-center' data-product-id="${Product_id}">
                                        <td>${Product_id}</td>
                                        <td>${Product_name}</td>
                                        <td>${product_price} Rs</td>
                                        <td>${Product_size}</td>
                                        <td>${Product_for}</td>
                                        <td>${Product_category}</td>
                                        <td><img src="{{ URL::to('/') }}/images/products/${Product_image}" style="width:100px;"></td>
                                        <td>
                                     <div class="row d-flex text-center justify-content-center">
                                    <div class="col-auto mb-2">
                                        <button class="btn btn-secondary decrement" data-product-id="${Product_id}">-</button>
                                    </div>
                                    <div class="col-auto mb-2 text-center">
                                        <input type="number" class="form-control quantity" min="1" max="10" step="1" value="${Quantity}" style="font-size: 11px" readonly>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-secondary increment" data-product-id="${Product_id}">+</button>
                                    </div>
                                </div>
                            </td>
                            <td>${total} Rs</td>
                            <td>
                                <center>
                                <button class='btn btn-danger button-delete' data-item-id="${id}">Delete</button>
                                </center>
                            </td>
                        </tr>
                                `
                            );
                        });
                        $("#grandTotal").text(grandTotal)
                    }
                }
            });
        }

        loadAllCartDetails()

        $(document).on('click', '.increment', function () {
            let $button = $(this);
            let productId = $button.data('product-id');
            let $quantityInput = $button.closest('tr').find('.quantity');
            let currentQuantity = parseInt($quantityInput.val());

            if (currentQuantity < 10) {
                let newQuantity = currentQuantity + 1;
                $quantityInput.val(newQuantity);
                updateQuantity(productId, newQuantity);
                loadAllCartDetails()
            }
        });

        $(document).on('click', '.decrement', function () {
            let $button = $(this);
            let productId = $button.data('product-id');
            let $quantityInput = $button.closest('tr').find('.quantity');
            let currentQuantity = parseInt($quantityInput.val());

            if (currentQuantity > 1) {
                let newQuantity = currentQuantity - 1;
                $quantityInput.val(newQuantity);
                updateQuantity(productId, newQuantity);
                loadAllCartDetails()
            }
        });


        function updateQuantity(productId, newQuantity) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'update-cart-quantity',
                data: {
                    id: productId,
                    quantity: newQuantity
                },
                success: function (response) {

                    if (response.status == 'error') {
                        console.log('Error updating quantity.');
                    }
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        }

        $(document).on('click', '.button-delete', function () {
            let itemId = $(this).data('item-id');

            $.ajax({
                type: "GET",
                url: `delete/${itemId}`,
                success: function (response) {
                    if (response.status == 'success') {
                        sweetAlert('success', response.message);
                        loadAllCartDetails()// Refresh cart after deletion
                    } else {
                        sweetAlert('error', response.message);
                    }
                },
                error: function (error) {
                    console.log(error)
                }
            });
        });


        $(document).on('click', '.apply-coupen-button', function () {
            let grandTotal = parseInt($("#grandTotal").text())
            let data = {
                total: grandTotal,
                coupen: $("#coupen").val()
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });


        $(document).on('submit', '#makePurchaseForm', function (e) {
            e.preventDefault()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "purchase-products",
                data: {
                    coupen: $("#coupen").val(),
                    grandTotal: $("#grandTotal").text(),
                    address: $("#address").val()
                },
                success: function (response) {
                    console.log(response)
                    if (response.status == 'success') {
                        sweetAlert('success', response.message)
                        loadAllCartDetails()

                        setTimeout(() => {
                            rateUs()
                        }, 3000);
                    }
                    else if (response.status == 'failed') {
                        sweetAlert('error', response.message)
                    }

                },
                error: function (error) {
                    console.log(error)
                }
            });

        });



        $(document).on('click', '.button-close', function () {
            $(".modal").modal('hide')
        })




        function rateUs() {
            $(".modal").modal('show')

            let stars = document.querySelectorAll('.star');
            let rating = 0; // Variable to store the user's rating

            stars.forEach((star) => {
                star.addEventListener('click', function () {
                    rating = parseInt(this.getAttribute('data-value'));

                    // Loop through the stars and update their appearance
                    stars.forEach((s) => {
                        if (parseInt(s.getAttribute('data-value')) <= rating) {
                            s.classList.add('filled');

                        } else {
                            s.classList.remove('filled');

                        }
                    });
                });
            });

            $(document).on('submit', '#myForm', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ URL::to('/') }}/guest_user/submit-review",
                    data: {
                        rate: rating,
                        review: $("#review").val()
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                            sweetAlert('success', response.message)
                            $(".modal").modal('hide')
                        }
                        else if (response.status == 'failed') {
                            sweetAlert('error', response.message)
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            });
        }



    });
</script>
@endsection