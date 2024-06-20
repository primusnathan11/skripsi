@include('landing.template.header2')
<div class="boxed blog">
    <!-- Preloader -->
    <div class="preloader">
        <div class="clear-loading loading-effect-2">
            <span></span>
        </div>
    </div>

    
<div class="page-title">
    <div class="container-fluid">
        <div class="row">
            <div class="inner-title2">
                <div class="overlay-image"></div>
                <div class="banner-title">
                    <div class="page-title-heading">
                        Pembayaran
                    </div>
                    <div class="page-title-content link-style6">
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<section class="flat-service-details">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="themesflat-spacer clearfix" data-desktop="117" data-mobile="60" data-smobile="60"></div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget-contact-services-details mg-bottom-25">
                            <div class="sidebar-title mg-bottom-25">
                                <h2 class="section-heading-jost-size28 text-pri2-color">Detail Pembayaran</h2>
                            </div>
                            <div class="col-md-12 text-center" id="status_transaction" style="margin-top: 2rem; margin-bottom: 2rem;">
                                @if ($donate->status == "success")
                                    <button type="button" class="btn btn-success">{{ strtoupper($donate->status) }}</button>
                                @elseif($donate->status == "pending" || $donate->status == "request")
                                    <button type="button" class="btn btn-warning">{{ strtoupper($donate->status) }}</button>
                                @else
                                    <button type="button" class="btn btn-danger">{{ strtoupper($donate->status) }}</button>
                                @endif
                            </div>
                            <ul class="widget-sidebar-contact-us text-pri2-color section-heading-rubik-size16">
                                <li><span class="">Kode Transaksi</span><span class="info-contact-us">{{ $donate->order_code }}</span></li>
                                <li><span class="">Total Donasi</span><span class="info-contact-us">Rp. {{ number_format($donate->grand_total) }}</span></li>
                                <li><span class="">Metode:</span><span class="info-contact-us">{{ strtoupper($donate->payment_method) }}</span></li>
                                <li><span class="">Tanggal Pembayaran:</span><span class="info-contact-us">{{ date_format(date_create($donate->date), "j F Y") }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="themesflat-spacer clearfix" data-desktop="0" data-mobile="30" data-smobile="30"></div>
            </div>
            <div class="col-md-12">
                <div class="themesflat-spacer clearfix" data-desktop="172" data-mobile="100" data-smobile="60"></div>
            </div>
        </div>
    </div>
</section>
<!-- /.page-title -->
@include('landing.template.footer')
<script>
    $(document).ready(function(){
        var status = "{{ $donate->status }}"
        if(status == "pending" || statu == "request" ){
            var interval = setInterval(function(){
                $.ajax({
                    url: "{{ url('payment/get-status') }}",
                    method: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: "{{ $donate->id }}"
                    },
                    success: function(res){
                        if(res == "success"){
                            $('#status_transaction').html(`<button type="button" class="btn btn-success">SUCCESS</button>`);
                            window.location.href = "{{ url('payment/running') . '/'  }}" + res;
                            clearInterval(interval);
                        }else if(res == "pending" || res == "request"){
                            $('#status_transaction').html(`<button type="button" class="btn btn-warning">${res.toUpperCase()}</button>`);
                        }else {
                            clearInterval(interval);
                            $('#status_transaction').html(`<button type="button" class="btn btn-danger">${res.toUpperCase()}</button>`);
                        }
                    }
                })
            }, 1500);
        }
        
    })
</script>