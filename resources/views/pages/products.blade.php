@extends('pages.master')
@section('title')
Products
@endsection

@section('content')
<div class="table-container">
    <div class="search mb-3 d-flex justify-content-end align-items-end text-center">
        {{-- FIXME: for live search --}}
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover  text-center  table-bordered ">

            <thead class="bg-dark text-light text-center">
                <th>Product Id</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Category</th>
                <th>Product For</th>
                <th>Product Size</th>
                <th>Product Image</th>
                <th>Product Status</th>
                <th colspan="2">Actions</th>
            </thead>
            <tbody>
            </tbody>

        </table>
    </div>
    <button class="btn btn-primary mt-4 show-modal">Add Product</button>

    {{-- Add Products Modal --}}
    <div class="modal fade" id="addProductsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5 " id="exampleModalLabel">Add Product</h3>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    --}}
                </div>
                <div class="modal-body">
                    <form method="POST" id="addProductForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <ul class="add-product-errors alert-danger"></ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" id="product_name" class="form-control">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                <label for="" class="form-label">Product Price</label>
                                <input type="number" id="product_price" class="form-control">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                <label for="" class="form-label">Product category</label>
                                <select name="" id="product_category" class="form-control form-select">
                                    <option value="">Choose Category</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                <label for="" class="form-label">Product For</label>
                                <select name="" id="product_for" class="form-control">
                                    <option value="">Choose Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                <label for="" class="form-label">Product size</label>
                                <select name="" id="product_size" class="form-control">
                                    <option value="">Choose size</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                <label for="" class="form-label">Product image</label>
                                <input type="file" id="product_image" class="form-control">
                            </div>


                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Product Modal --}}
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5 " id="exampleModalLabel">Edit Product</h3>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    --}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <ul class="alert-danger edit_product_error_messages col-12">

                        </ul>


                        <input type="hidden" name="" id="edit_product_id">
                        <div class="col-lg-4 col-md-4 col-sm-12 product-image">

                        </div>
                        <form method="POST" id="editProductsForm" enctype="multipart/form-data"
                            class="col-lg-8 col-md-8 col-sm-12">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="add-product-errors alert-danger"></ul>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <label for="" class="form-label">Product Name</label>
                                    <input type="text" id="edit_product_name" class="form-control">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <label for="" class="form-label">Product Price</label>
                                    <input type="number" id="edit_product_price" class="form-control">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <label for="" class="form-label">Product category</label>
                                    <select name="" id="edit_product_category" class="form-control form-select">

                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <label for="" class="form-label">Product For</label>
                                    <select name="" id="edit_product_for" class="form-control edit_product_for">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <label for="" class="form-label">Product size</label>
                                    <select name="" id="edit_product_size" class="form-control">
                                        <option value="">Choose size</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                                    <label for="" class="form-label">Product image</label>
                                    <input type="file" id="edit_product_images" class="form-control product-image">
                                </div>


                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary edit-button">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    $(document).ready(function () {

        // To show the modal 
        $(document).on('click', '.show-modal', function () {
            $("#addProductsModal").modal('show')
        });


        // All the required Data
        function getRequiredData() {
            let buttonLabel
            let buttonClass
            $.ajax({
                type: "GET",
                url: "get-required-data",
                success: function (response) {

                    $("#product_category").html("")
                    // it is for fetching the categories
                    $.each(response.categoryData, function (indexInArray, valueOfElement) {
                        $("#product_category").append(`
                                    <option value='${valueOfElement.category_name}'> ${valueOfElement.category_name} </option>
                                 `)
                    });
                    $("#product_size").html("")
                    // It is for fetching the sizes
                    $.each(response.sizeData, function (indexInArray, valueOfElement) {
                        $("#product_size").append(`
                                    <option value='${valueOfElement.size_name}'> ${valueOfElement.size_name} </option>
                                 `);
                    });

                    // it is for fetching the products
                    $("tbody").html('')


                    $.each(response.products, function (indexInArray, valueOfElement) {

                        if (valueOfElement.Product_status == 'Active') {
                            buttonLabel = "Deactivate"
                            buttonClass = "btn btn-danger button-deactivate"
                        } else if (valueOfElement.Product_status == 'Inactive') {
                            buttonLabel = "Active"
                            buttonClass = "btn btn-success button-activate"
                        } else if (valueOfElement.Product_status == 'Deleted') {
                            buttonLabel = "Reactivate"
                            buttonClass = "btn btn-danger button-reactivate"
                        }
                        $("tbody").append(`
                                    <tr>
                                        <td>${valueOfElement.Product_id}</td>
                                        <td>${valueOfElement.Product_name}</td>
                                        <td>${valueOfElement.Product_price}</td>
                                        <td>${valueOfElement.Product_category}</td>
                                        <td>${valueOfElement.Product_for}</td>
                                        <td>${valueOfElement.Product_size}</td>
                                        <td><img src='{{ URL::to('/') }}/images/products/${valueOfElement.Product_image}'></td>
                                        <td><button class='${buttonClass}' value='${valueOfElement.Product_id}'>${buttonLabel}</button></td>
                                        <td><button class='btn btn-primary button-edit' value='${valueOfElement.Product_id}'>Edit</button></td>
                                        <td><button class='btn btn-danger button-delete' value='${valueOfElement.Product_id}'>Delete</button></td>
                                    </tr>
                                        
                                `)
                    });
                }
            });


        }
        // This is used to show required data like categories , sizes and all table data  
        getRequiredData()


        // Inserting the data
        $(document).on('submit', '#addProductForm', function (event) {
            event.preventDefault()
            let formData = new FormData(this)
            formData.append("product_name", $("#product_name").val())
            formData.append("product_price", $("#product_price").val())
            formData.append("product_category", $("#product_category").val())
            formData.append("product_for", $("#product_for").val())
            formData.append("product_size", $("#product_size").val())
            formData.append("product_image", $("#product_image")[0].files[0])


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: "product_store",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == 'validation_error') {
                        console.log(response.message)
                        $(".add-product-errors").html("")
                        $.each(response.message, function (indexInArray, valueOfElement) {
                            $(".add-product-errors").append(
                                `<li style='list-style:none;'>${valueOfElement} </li>`
                            )
                        });
                    } else {
                        $(".add-product-errors").html("")
                    }

                    if (response.status == 'success') {
                        $("#addProductsModal").modal('hide')
                        sweetAlert("success", response.message)
                        getRequiredData()
                        $("#addProductsModal").find('input').val("")
                        $("#product_for").val("")
                        $("#product_size").val("")
                        $("#product_category").val("")


                    } else if (response.status == 'failed') {
                        $("#addProductsModal").modal('hide')
                        sweetAlert("error", response.message)
                        $("#addProductsModal").find('input').val("")
                        $("#product_for").val("")
                        $("#product_size").val("")
                        $("#product_category").val("")
                    }
                }
            });


        });

        // Deactivate the specific product by the id's
        $(document).on('click', '.button-deactivate', function () {
            let buttonId = $(this).val()
            $.ajax({
                type: "GET",
                url: `deactivate/${buttonId}`,
                success: function (response) {
                    if (response.status == 'success') {
                        sweetAlert('success', response.message)
                        getRequiredData()
                    } else if (response.status == 'failed') {
                        sweetAlert('error', response.message)
                    }
                }
            });
        });


        // Activating specific product by id's 
        $(document).on('click', '.button-activate', function () {
            let buttonId = $(this).val()
            $.ajax({
                type: "GET",
                url: `activate/${buttonId}`,
                success: function (response) {
                    if (response.status == 'success') {
                        sweetAlert('success', response.message)
                        getRequiredData()
                    } else if (response.status == 'failed') {
                        sweetAlert('error', response.message)
                    }
                }
            });
        });


        // For deleting the product by id
        $(document).on('click', '.button-delete', function () {
            let valueOfButton = $(this).val()
            $.ajax({
                type: "GET",
                url: `delete/${valueOfButton}`,
                success: function (response) {
                    if (response.status == 'success') {
                        sweetAlert("success", response.message)
                        getRequiredData()
                    } else if (response.status == 'failed') {
                        sweetAlert('error', response.message);
                    }
                }
            });
        });

        // TODO: edit the specific product by the id's

        $(document).on('click', '.button-edit', function () {
            let editButtonValue = $(this).val()
            $("#editProductModal").modal('show')

            $.ajax({
                type: "GET",
                url: `edit/${editButtonValue}`,
                success: function (response) {
                    console.log(response.product)
                    if (response.status == 'success') {
                        $("#edit_product_category").html("")
                        $.each(response.category, function (indexInArray, valueOfElement) {
                            $("#edit_product_category").append(`<option value='${valueOfElement.category_name}'> ${valueOfElement.category_name} </option>`)
                        });
                        $("#edit_product_size").html("")
                        $.each(response.size, function (indexInArray, valueOfElement) {
                            $("#edit_product_size").append(`<option value='${valueOfElement.size_name}'> ${valueOfElement.size_name} </option>`)
                        });
                        $("#edit_product_id").val(response.product.Product_id)
                        $("#edit_product_name").val(response.product.Product_name)
                        $("#edit_product_price").val(response.product.Product_price)
                        $("#edit_product_category").val(response.product.Product_category)
                        $(".edit_product_for").val(response.product.Product_for)
                        $("#edit_product_size").val(response.product.Product_size)
                        $(".product-image").html(`
                                    <img src='{{ URL::to('/') }}/images/products/${response.product.Product_image}' style='width: 100%; '>
                                `)
                    }
                    else if (response.status == 'failed') {
                        sweetAlert('error', response.message)
                    }
                }
            });
        });

        $(document).on('submit', '#editProductsForm', function (event) {
            event.preventDefault()
            let formdata = new FormData()
            let selected = $("#edit_product_images")[0].files[0]
            formdata.append("edit_product_id", $("#edit_product_id").val())
            formdata.append('edit_product_name', $("#edit_product_name").val())
            formdata.append('edit_product_price', $("#edit_product_price").val())
            formdata.append('edit_product_category', $("#edit_product_category").val())
            formdata.append('edit_product_for', $("#edit_product_for").val())
            formdata.append('edit_product_size', $("#edit_product_size").val())


            if (selected) {
                formdata.append('edit_product_image', $('#edit_product_images')[0].files[0]);
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "update",
                data: formdata,
                dataType: "json",

                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status == 'validation') {

                        $(".edit_product_error_messages").html("")
                        $.each(response.error, function (indexInArray, valueOfElement) {

                            $(".edit_product_error_messages").append(
                                `
                                <li style='list-style:none;'> ${valueOfElement}</li>
                                `
                            )
                        });
                    }
                    if (response.status == 'success') {
                        $("#editProductModal").modal('hide')
                        sweetAlert('success', response.message)
                        getRequiredData();
                    }
                    else {
                        $("#editProductModal").modal('hide');
                        sweetAlert('error', response.message)
                    }


                }
            });
        });



    });
</script>
@endsection