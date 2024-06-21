@include('landing.template.header2')


<body>
    <div class="boxed blog">
        <!-- Preloader -->
        <div class="preloader">
            <div class="clear-loading loading-effect-2">
                <span></span>
            </div>
    </div>
        <!-- page title -->
        <div class="page-title">
            <div class="container-fluid">
                <div class="row">
                    <div class="inner-title2">
                        <div class="overlay-image"></div>
                        <div class="banner-title">
                            <div class="section-title">
                                Donate
                            </div>
                            <div class="section-subtitle">
                                <span><a class="home" href="index.html">Home</a></span><span class="page-title-content-inner" style="color: white">Donate</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- /.page-title -->

        <!-- Our services -->
        <section class="flat-why-choose-us" id="donat">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="themesflat-spacer clearfix" data-desktop="120" data-mobile="60" data-smobile="60"></div>
                    </div>
                </div>
                <div class="row">
                    @php
                        $currDate = new DateTime('now');
                    @endphp
                    @foreach ($donations as $donation)
                    @php
                        $target = $donation->target;
                        $collected = $donation->collected;
                        $progress = $collected != 0 ? ($collected / $target) * 100: 0;

                        $dueDate = date_create($donation->due_date);
                        $dateDiff = date_diff($currDate, $dueDate);
                    @endphp
                    <div class="item-three-column mg-bottom-60 wow fadeInUp">
                        <article class="flat-WCU-box grow-up-hover">
                            <div class="WCU-image">
                                <img class="grow-up-hover" src="{{ Storage::url($donation->image) }}" alt="images">
                            </div>
                            <div style="padding-left: 18px;">
                                <div class="content-features">
                                    <a href="{{ url('donate',$donation->id) }}">
                                        <h3 class="section-heading-rubik-size20">{{$donation->title}}</h3>
                                    </a>

                                <div style="margin-top: 1.5rem;">
                                    <small style="color: #111;">UKM Tani: {{$donation->nama_ukm}}</small>
                                    <div class="progress" style="width: 100%;margin-top: 0.5rem;">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ $progress }}%</div>
                                    </div>
                                </div>
                                    <div class="row" style="margin-top: 0.2rem;">
                                        <div class="col-md-6" style="padding-left: 20px;">
                                            <small style="color: #111;"><strong>Rp. {{ number_format($donation->collected)}}</strong></small>
                                            <br>
                                            <small style="color: #111;">Pohon terkumpul</small>
                                        </div>
                                        <div class="col-md-6">
                                            @if ($dateDiff->format("%R") == "+")
                                                @if ($dateDiff->format("%a") == "0")
                                                    <small style="color: #111;float: right;"><strong>Hari ini</strong></small>
                                                @else
                                                    <small style="color: #111;float: right;"><strong>{{ $dateDiff->format("%a") }}</strong> hari lagi</small>
                                                @endif
s                                           @else
                                                <small style="color: #111;float: right;"><strong>Selesai</strong></small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-read-more link-style2">
                                <a href="{{ url('donate',$donation->id) }}" class="read-more btn-read-more">Donasi</a>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="themesflat-spacer clearfix" data-desktop="120" data-mobile="100" data-smobile="100"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / Our service -->

        @include('landing.template.footer')
