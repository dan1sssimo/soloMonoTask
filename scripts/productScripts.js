$(document).on('click', '.buyProduct', function () {
    let productCard = $(this).closest("div[class$='card mb-4 rounded-3 shadow-sm']")
    $('#productName').text("Product Name: " + (productCard.find('.productNameText').text()))
    $('#productPrice').text("Product Price: " + (productCard.find('.productPriceText').text()))
    $('#productDate').text("Product Added " + (productCard.find('.productDateText').text()))
})

$(document).on('click', '.categoryBtn', function () {
    let categoryID = $(this).attr('id')
    let windowURL = new URL(window.location.href)
    const urlSortByID = windowURL.searchParams.get('sort_by')
    $.ajax({
        url: '/products/category',
        method: "GET",
        dataType: 'json',
        data: {category_id: categoryID, sort_by: urlSortByID},
        success: function (data) {
            const url = new URL(window.location.href)
            if (url.searchParams.has("category_id")) {
                url.searchParams.delete("category_id")
                url.searchParams.append("category_id", categoryID)
                window.history.pushState(null, null, url);
            } else {
                url.searchParams.append("category_id", categoryID)
                window.history.pushState(null, null, url);
            }
            let products = data["data"]["productsData"]
            $('.row.row-cols-1.row-cols-md-3.mb-3.text-center').empty()
            products.forEach((element) => {
                $('.row.row-cols-1.row-cols-md-3.mb-3.text-center').append(`
                 <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal productNameText">${element['product_name']}</h4>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title pricing-card-title productPriceText">${element['product_price']}<small class="text-muted fw-light">$</small></h3>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li class="productDateText">Date: ${element['date']}</li>
                            </ul>
                            <button type="button" class="w-100 btn btn-lg btn-outline-primary buyProduct"
                                    data-toggle="modal"
                                    data-target="#product-form-modal" id="productInfo">Buy
                            </button>
                        </div>
                    </div>
                </div>
                `)
            })
        }
    })
})

$(document).on('change', '#sortBySelectBox', function () {
    let sortByType = $(this).val()
    let categoryID = null
    const url = new URL(window.location.href)
    if (url.searchParams.has("category_id")) {
        categoryID = url.searchParams.get('category_id')
    }
    $.ajax({
        url: '/products/sort',
        method: "GET",
        dataType: 'json',
        data: {sort_by: sortByType, category_id: categoryID},
        success: function (data) {
            const url = new URL(window.location.href)
            if (url.searchParams.has("sort_by")) {
                url.searchParams.delete("sort_by")
                url.searchParams.append("sort_by", sortByType)
                window.history.pushState(null, null, url);
            } else {
                url.searchParams.append("sort_by", sortByType)
                window.history.pushState(null, null, url);
            }
            let products = data["data"]["productsData"]
            $('.row.row-cols-1.row-cols-md-3.mb-3.text-center').empty()
            products.forEach((element) => {
                $('.row.row-cols-1.row-cols-md-3.mb-3.text-center').append(`
                 <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal productNameText">${element['product_name']}</h4>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title pricing-card-title productPriceText">${element['product_price']}<small class="text-muted fw-light">$</small></h3>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li class="productDateText">Date: ${element['date']}</li>
                            </ul>
                            <button type="button" class="w-100 btn btn-lg btn-outline-primary buyProduct"
                                    data-toggle="modal"
                                    data-target="#product-form-modal" id="productInfo">Buy
                            </button>
                        </div>
                    </div>
                </div>
                `)
            })
        }
    })
})
