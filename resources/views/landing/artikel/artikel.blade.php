@include('landing.template.header2')

<body>
    <div class="boxed blog">

        <!-- Preloader -->
        <div class="preloader">
            <div class="clear-loading loading-effect-2">
                <span></span>
            </div>
        </div>


        <!-- /.page-title -->

        <!-- main content -->
        <section class="flat-blog-detail">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="themesflat-spacer clearfix" data-desktop="166" data-mobile="0" data-smobile="0"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="post-wrap">
                            <div class="content-blog-detail">
                                <div class="image-box">
                                    <div class="image" style="text-align: center">
                                        <img src={{  Storage::url($news->image)  }} alt="image">
                                    </div>
                                </div>
                                <div class="content mg-top-15">
                                    <span class="content-info"><a href="#" class="user" style="color:black">
                                        {{ $news->author }}
                                    </a><a href="#" class="date" style="color:black">
                                        {{ $news->created_at->format('d/m/y') }}
                                    </a></span>
                                        <div class="heading-content-box">
                                            <a href="#" style="color:black">
                                            {{ $news->title }}
                                    </a>
                                </div>


                                    <p class="desc-content-box text-decs">
                                        <div style="color: #525368">
                                       {!! $news->content  !!}
                                        </div>
                                    </p>





                                    <hr>


                                    <!-- comments -->
                                    <!-- input comment -->

                                </div>
                            </div>
                        </div>
                        <!-- /.post-wrap -->

                    </div>
                    <!-- /.col-md-8 -->


                    <!-- /.col-md-4 -->
                    <div class="col-md-12">
                        <div class="themesflat-spacer clearfix" data-desktop="193" data-mobile="60" data-smobile="60"></div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
        <!-- /.main-content -->

        @include('landing.template.footer')
