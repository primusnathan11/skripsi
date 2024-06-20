@include('landing.template.header2')
@php
    $target = $donations->target;
    $collected = $donations->collected;

    $progress = $collected != 0 ? ($collected / $target) * 100: 0;
@endphp

<style>
    /* #map{
        height: 200px;
    } */
</style>

<body>
<div class="boxed blog">
        <!-- Preloader -->
        <div class="preloader">
            <div class="clear-loading loading-effect-2">
                <span></span>
            </div>
        </div>

        <!-- top header -->

    <div class="page-title">
        <div class="container-fluid">
            <div class="row">
                <div class="inner-title2">
                    <div class="overlay-image"></div>
                    <div class="banner-title">
                        <div class="page-title-heading">
                            Detail Donate
                        </div>
                        <div class="page-title-content link-style6">
                            {{-- <span><a class="home" href="index.html">Home</a></span><span class="page-title-content-inner">Donate</span> --}}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- /.page-title -->

    <section class="flat-service-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="themesflat-spacer clearfix" data-desktop="117" data-mobile="60" data-smobile="60"></div>
                </div>
                <div class="col-md-12 text-center">
                    <h1 class="section-heading-jost-size28 text-pri2-color">Rp. {{ number_format($donations->collected) }} / Rp. {{ number_format($donations->target)}}</h1>
                </div>
                <div class="col-md-12" style="margin-bottom: 2rem;">
                    <div class="progress" style="width: 100%;margin-top: 0.5rem;">
                        <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ $progress }}%</div>
                    </div>
                </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="widget-contact-services-details mg-bottom-25">
                                <div class="sidebar-title mg-bottom-25">
                                    <h2 class="section-heading-jost-size28 text-pri2-color">Detail</h2>
                                </div>
                                <ul class="widget-sidebar-contact-us text-pri2-color section-heading-rubik-size16">
                                    <li><span class="">Kelompok Tani Hutan Hijau Lestari</span><span class="info-contact-us">{{ $donations->nama_ukm}}</span></li>
                                    <li><span class="">Lokasi:</span><span class="info-contact-us">{{ $donations->nama_lokasi}}</span></li>
                                    <li><span class="">Jenis Pohon:</span><span class="info-contact-us">{{$donations->tree_name}}</span></li>
                                    <!-- <li><span class="">Lokasi:</span><span class="info-contact-us">Kabupaten Pasuruan</span></li> -->
                                    <li><span class="">Batas Donasi:</span><span class="info-contact-us">{{ date_format(date_create($donations->due_date), 'Y-m-d')}}</span></li>
                                    <li><span class="">Penanaman:</span><span class="info-contact-us">{{ $donations->planting_date? date_format(date_create($donations->planting_date), 'Y-m-d') : "-" }}</span></li>
                                    <li><span class="">Mitra Penanaman:</span><span class="info-contact-us">{{ $donations->nama_mitra }}</span></li>
                                </ul>
                                <div class="text-center" style="margin-top: 2rem;margin-bottom: 2rem;"><a class="button-services" href="{{ url('donate-payment',$donations->id) }}">Donasi Sekarang</a></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="widget-contact-services-details">
                                <div class="sidebar-title">
                                    <h2 class="section-heading-jost-size28 text-pri2-color" style="margin-bottom: 2rem;">Maps</h2>
                                    <div id="map" style="width: 100%; height: 250px;"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="themesflat-spacer clearfix" data-desktop="0" data-mobile="30" data-smobile="30"></div>
                </div>
                <div class="col-md-8">
                    <div class="widget-contact-services-details">
                        <div class="post-service-details bd-radius-8-image mg-bottom-45 text-center">
                            <img style="max-height: 500px;"  src="{{ Storage::url($donations->image) }}" alt="imagess">
                        </div>
                        <h2 class="section-heading-jost-size34 text-pri2-color mg-bottom30">{{ $donations->title}}</h2>
                        <span class="mg-bottom-20">{!! $donations->description !!}</span>
                    </div>
                    {{-- <article class="content-service-details">
                    </article> --}}
                </div>
                <div class="col-md-12">
                    <div class="themesflat-spacer clearfix" data-desktop="172" data-mobile="100" data-smobile="60"></div>
                </div>
            </div>
        </div>
    </section>


    <script src="{{ asset("js/leaflet.js") }}"></script>
    @include('landing.template.footer')
    <script>
        $(document).ready(function() {
          // Initialize the Leaflet map
          var map = L.map('map').setView([{{ $location->latitude }}, {{ $location->longitude }}], 13);

          // Add the tile layer (you can use other tile providers as well)
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

          // Add a marker to the map
          L.marker([{{ $location->latitude }}, {{ $location->longitude }}]).addTo(map)
        });
      </script>

