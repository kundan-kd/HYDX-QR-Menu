<!doctype html>
<html lang="en">
@php
    $c_name = App\Models\CompanyProfile::where('id', 1)->get();
    $logo = $c_name[0]->company_logo ?? '';
    $name = $c_name[0]->company_name ?? '';
    $primary_color = $c_name[0]->primary_color ?? '';
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="backend/assets/css/bootstrap.css">
    <link rel="stylesheet" href="frontend/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>{{ $name }} | MENU</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="uploads/company_logo/{{ $logo }}">
    <style>
        @media screen and (min-device-width: 300px) and (max-device-width: 768px) {
            .filter-item {
                padding: 0px 0.65rem !important;
                margin-right: 5px !important;
                columns: 100px 4;
            }

            .filter-item span {
                font-size: 12px !important;
            }

            .btn-menu {
                display: flex;
                font-size: 13px;
                margin-top: -1px;
            }
        }
    </style>
    <style>
        #loading-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 5000;
            background: rgba(0, 0, 0, 0.788);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #loading-wrapper .spinner-border {
            width: 5rem;
            height: 5rem;
            color: {{ $primary_color }};
        }

        #loder {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.95);
        }

        .offcanvaswidth {
            width: 50% !important;
        }

        @media only screen and (max-width: 800px) {
            .offcanvaswidth {
                width: 100% !important;
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    @yield('extra-css')
    <div id="loading-wrapper">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</head>

<body>
    @include('frontend.includes.header')
    @yield('main-content')
    @include('frontend.includes.footer')
    <script src="backend/assets/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="frontend/assets/js/script.js"></script>
    <script src="backend/assets/js/toast.min.js"></script>
    @yield('extra-js')
    <script>
        setTimeout(function() {
            $(document).ready(function() {
                $("#loading-wrapper").fadeOut(500);
            });
        }, 100);
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.add-btn', function() {
                var quantityWrapper = $(this).siblings('.qty-controls');
                var qty = quantityWrapper.find('.qty');
                let itemSummary = $('#itemsummary');
                qty.text('1');
                $(this).hide();
                quantityWrapper.show();
                itemSummary.show();
            });

            $(document).on('click', '.increment', function() {
                let itemSummary = $('#itemsummary');
                let qtyElement = $(this).siblings('.qty');
                let currentQty = parseInt(qtyElement.text());
                let n = currentQty + 1;
                qtyElement.text(n);
                itemSummary.show();
            });

            $(document).on('click', '.decrement', function() {
                let qtyElement = $(this).siblings('.qty');
                let itemSummary = $('#itemsummary');
                let currentQty = parseInt(qtyElement.text());
                let n = currentQty - 1;
                qtyElement.text(n);
                itemSummary.show();
                if (n < 1) {
                    qtyElement.text('0');
                    // let p = $(this).parent();
                    // p.hide();
                    // let b = p.siblings('.add-btn');
                    // b.show();
                    // itemSummary.hide();
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const decrementBtn = document.getElementById('decrementBtn');
            const incrementBtn = document.getElementById('incrementBtn');
            const counterValue = document.getElementById('counterValue');
            let count = 1;

            function incrementCounter() {
                count++;
                counterValue.value = count;
                $('.qty_count').html(count);
            }

            function decrementCounter() {
                if (count > 1) {
                    count--;
                    counterValue.value = count;
                    $('.qty_count').html(count);;
                }
            }
            incrementBtn.addEventListener('click', incrementCounter);
            decrementBtn.addEventListener('click', decrementCounter);
        });
        $(document).ready(function() {
            $(".expander").on("click", function() {
                var $this = $(this);
                $this.next().slideToggle();
                console.log($this.children().slideToggle());
            })
        });

        function getimage(src, id, name, price,desc) {
            var output1 = `
      <div class="filter-title mb-3 pt-3 d-flex justify-content-between" style="text-align: left;">
    <div>
        <h5>${name}</h5>
        <h5>₹ ${price}</h5>
        <p>${desc}</p>
    </div>
    <div class="text-center quantity-selector" style="margin-top: -82px; margin-left: 70%;">
        <button class="add-btn" onclick="addItemToCart(${id}, ${price})">Add</button>
        <div class="qty-controls" style="display:none;" data-item-id="${id}">
            <span class="decrement" onclick="adjustQuantity(${id}, ${price}, -1)">-</span>
            <span class="qty">1</span>
            <span class="increment" onclick="adjustQuantity(${id}, ${price}, 1)">+</span>
        </div>
    </div>
</div>
`;
        $('.viewImage').html('<img src="' + src + '" style="width: 100%; border-radius: 15px 15px 0px 0px;">');
        $('.viewImage-details').html(output1);
        }

        function getmodelimage(id, image, name, price) {
            $('.viewmodelImage').html('<img src="uploads/items/' + image + '" height="60" width="70">');
            $('.item_id').empty();
            $('.item_id').append(id);
            $('.item_name').empty();
            $('.item_name').append(name);
            $('.order_price').empty();
            $('.order_price').append(price);
        }
    </script>

</body>

</html>
