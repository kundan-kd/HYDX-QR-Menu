<footer class="main-footer mt-auto py-3 bg-white text-center fs-6 border-top">
    <div class="container px-0">
        <span class=""> Copyright © <span id="year"></span> <a href="javascript:void(0);"
                class="text-primary fw-semibold"></a>
            <span class="fw-semibold" style="color:{{ $primary_color }}"> Techie Squad. </span>All rights
            reserved</span>
        @if (!empty($company_address))
            <p class="mb-0">
                <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $company_address }}
            </p>
        @endif
        @if (!empty($company_email))
            <p class="mb-0">
                <i class="fa fa-envelope" aria-hidden="true"></i> {{ $company_email }}
            </p>
        @endif
        @if (!empty($company_mobile))
            <p class="mb-0">
                <i class="fa fa-mobile" aria-hidden="true"></i> {{ $company_mobile }}
            </p>
        @endif
    </div>
</footer>