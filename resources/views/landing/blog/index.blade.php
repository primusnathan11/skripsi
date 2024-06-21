@include('landing.template.header2')
        <div class="page-title">
            <div class="container-fluid">
                <div class="row">
                    <div class="inner-title2">
                        <div class="overlay-image"></div>
                        <div class="banner-title">
                            <div class="page-title-heading">
                                Blog
                            </div>
                            <div class="page-title-content link-style6">
                                <span><a class="home" href="#">Home</a></span><span class="page-title-content-inner" style="color: white">Blog</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        
        <section class="flat-blog-home01">
            <div class="container">
                <div class="row">
                    <div class="section-title-box">
                        <h4 class="section-subtitle  wow fadeInUp">LATEST NEWS</h4>
                        <h2 class="section-title  wow fadeInUp judul-home">Our Insights & Articles</h2>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($news as $card)
                            <div class="col-md-4 item wow fadeInUp">
                                <a href="{{route('detail.news', $card->id)}}">
                                <div class="blog-item hover-up-style2">
                                    <img src="{{ Storage::url($card->image) }}" alt="" style="height:100%;width:100%; object-fit:cover">
                                    <div class="item-overlay">

                                    </div>

                                    <div class="item-box link">
                                        <div class="link-style6">
                                            <div class="content-info" style="margin-top:-175px;">
                                                <a href="{{route('detail.news', $card->id)}}" class="user">
                                                    {{ $card->author }}

                                                </a>
                                            </div>
                                            <a href="{{route('detail.news', $card->id)}}" class="section-heading-jost-size20">
                                                
                                                {{ Str::limit($card->title, 25) }}
                                            </a>
                                        </div>
                                        <hr class="" style="width: 100%;">
                                        <h4 class="sub-title">
                                            <div style="color: #fff">
                                                {{ $card->created_at->format('d/m/y') }}
                                        </div>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            </div>
                    <div class="col-md-12">
                        <div class="themesflat-spacer clearfix" data-desktop="0" data-mobile="60" data-smobile="0">
                        </div>
                    </div>
                </div>
            </div>
        </section>
       

       
        @include('landing.template.footer')
