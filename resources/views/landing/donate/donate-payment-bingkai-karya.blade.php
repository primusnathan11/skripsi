@include('landing.template.header2')

@php
    $target = $donations->target;
    $collected = $donations->collected;

    $progress = $collected != 0 ? ($collected / $target) * 100: 0;
@endphp

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
    <!-- /.page-title -->
    <section class="flat-about">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="themesflat-spacer clearfix" data-desktop="121" data-mobile="60" data-smobile="60">
                        </div>
                    </div>
                    <div class="col-md-12 text-center" style="margin-bottom: 2rem;">
                    <h1 class="section-heading-jost-size28 text-pri2-color">"{{$donations->title}}"</h1>
                </div>
                    <div class="col-lg-6">
                        <div class="about-post center bd-radius-50-image">
                            <img class="img-fluid" src="{{ Storage::url($donations->image) }}" alt="images">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-content">
                            <div class="about-content-title wow fadeInUp">
                                <!-- <div class="section-subtitle">ABOUT US</div> -->
                                <div class="section-title judul-home" >"{{$donations->title}}"</div>
                                <div class="section-desc">{{ $donations->description}}</div>
                            </div>
                </section>

    <section class="flat-service-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="themesflat-spacer clearfix" data-desktop="117" data-mobile="60" data-smobile="60"></div>
                </div>
                <div class="col-md-12">
                    <a href="{{ url()->previous() }}" class="btn btn-success"> < Kembali </a>

                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('store.payment')}}" method="POST">
                            @csrf
                            <div class="widget-contact-services-details mg-bottom-25">
                             <div class="sidebar-title mg-bottom-25">
                             <h3 style="color: #0F4229;" class="section-heading-jost-size20 item-1">Data Diri <span style="color: red;">*</span></h3>
                                    <div class="form-group">
                                        <label for="name" class="text-success">Nama</label>
                                        <input type="text" class="form-control" id="name" placeholder="Masukkan nama" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="text-success">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Masukkan email" name="email" required>
                                        <small id="emailHelp" class="form-text text-muted" style="font-size: 14px">*Email diperlukan untuk pelaporan kegiatan acara.</small>
                                </div>
                            </div>

                            <div class="sidebar-title mg-bottom-25">
                                <h2 class="section-heading-jost-size28 text-pri2-color">Pembayaran</h2>
                            </div>

                            <h3 style="color: #0F4229;" class="section-heading-jost-size20 item-1">Nominal: Rp. {{ number_format("$donations->target")}}</h3>
                            <input type="hidden" class="form-control" id="name" placeholder="Masukkan nominal donasi" name="total_price" value="{{ $donations->target}}">

                            <button type="submit" class="btn btn-primary w-100" style="margin-top: 15px;">Bayar</button>
                        </div>



                    <div class="themesflat-spacer clearfix" data-desktop="0" data-mobile="30" data-smobile="30">
                    </div>
                </div>
                </form>
                <div class="col-md-12">
                    <div class="themesflat-spacer clearfix" data-desktop="172" data-mobile="100" data-smobile="60">
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('landing.template.footer')

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
          window.snap.pay('TRANSACTION_TOKEN_HERE', {
            onSuccess: function(result){

              alert("payment success!"); console.log(result);
            },
            onPending: function(result){
              /* You may add your own implementation here */
              alert("wating your payment!"); console.log(result);
            },
            onError: function(result){
              /* You may add your own implementation here */
              alert("payment failed!"); console.log(result);
            },
            onClose: function(){
              /* You may add your own implementation here */
              alert('you closed the popup without finishing the payment');
            }
          })
        });
      </script>
