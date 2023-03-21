function openPageScript() {
    let action = "Load";
    let windowURL = new URL(window.location.href)
    const urlCategoryID = windowURL.searchParams.get('category_id')
    const urlSortByID = windowURL.searchParams.get('sort_by')
    $.ajax({
        url: '/products/list',
        method: "GET",
        dataType: "json",
        data: {action: action, category_id: urlCategoryID, sort_by: urlSortByID},
        success: function (data) {
            urlSortByID != null ? $('#sortBySelectBox').val(urlSortByID) : null
            data['data']['categoryData'].forEach((element) => {
                $('#sidebarMenu').append(`
                    <div class="position-sticky pt-3 categoryBtn" style="width: 200px;" id="${element[0]}">
                            <ul class="nav flex-column">
                            <li class="nav-item">
                            <button class="btn nav-link" id="${element[0]}" style="color: black">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-shopping-cart" aria-hidden="true">
                            <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                        ${element['category_name']}  ${element['total_count']}
                    </button>
                    </li>
                    </ul>
                    </div>
                `);
            })
            data['data']['productData'].forEach((element) => {
                $('#productsCardsList').append(`
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
                `);
            })
        }
    })
}

openPageScript()