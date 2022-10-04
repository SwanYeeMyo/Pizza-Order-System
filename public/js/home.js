$(document).ready(function() {
    $('#sortingOption').change(function() {
        $eventOption = $('#sortingOption').val();
        console.log($eventOption);
        if ($eventOption == 'asc') {
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/pizzaList',
                data: {
                    'status': 'asc'
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $list = '';
                    for ($i = 0; $i < data.length; $i++) {
                        $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/${data[$i].image}') }}"
                                    alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>

                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate"
                                    href="">${data[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${data[$i].price}</h5>
                                    <h6 class="text-muted ml-2"><del>25000</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>

                    </div>
                       `;
                    }
                    $('#dataList').html($list)
                }
            })
        } else if ($eventOption == 'desc') {
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/pizzaList',
                data: {
                    'status': 'desc'
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $list = '';
                    for ($i = 0; $i < data.length; $i++) {
                        $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/${data[$i].image}') }}"
                                    alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>

                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate"
                                    href="">${data[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${data[$i].price}</h5>
                                    <h6 class="text-muted ml-2"><del>25000</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                       `;
                    }
                    $('#dataList').html($list)
                }
            })
        }

    })
});
