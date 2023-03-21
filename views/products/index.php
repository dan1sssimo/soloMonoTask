<div class="row">
    <!-- Sidebar-->
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">

    </nav>
    <!-- Sidebar-->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
                <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
                <div class=""></div>
            </div>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Products</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <select class="form-select" aria-label="Default select example" id="sortBySelectBox">
                    <option selected value="0">Sort By</option>
                    <option value="1">Price: low to high</option>
                    <option value="2">Alphabetically, A-Z</option>
                    <option value="3">By newest</option>
                </select>
            </div>
        </div>
        <!--            Products Cards-->
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center" id="productsCardsList">

        </div>
        <!--            Products Cards-->
    </main>
</div>
<!-- UserFormModal -->
<?php include_once 'views/products/productInfoModal.php' ?>
<!-- EndUserFormModal -->
<script src="/scripts/openProductPageScripts.js"></script>