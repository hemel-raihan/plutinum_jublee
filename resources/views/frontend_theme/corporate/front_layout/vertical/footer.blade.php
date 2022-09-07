@php
    $footer = \App\Models\Appearance_Settings\Footersetting::find(1);
@endphp
@isset($footer)


        @if ($footer->container == 'container-sm')
        <div class="container-sm" style="background: {{$page->container_color}};">
            <div class="main-div">
        {{-- <footer id="footer" style="background: {{$footer->background_color}};">
            <div class="container" style="margin-left: {{$footer->left_margin}}; margin-right: {{$footer->right_margin}};">

                <div class="footer-widgets-wrap">

                    <div class="row col-mb-50">
                        <div class="col-lg-8">

                            <div class="row col-mb-50">
                                <div class="col-md-4">

                                    <div class="widget clearfix">

                                        @isset($setting)
                                        <img width="200" src="{{asset('uploads/settings/'.$setting->logo)}}" alt="Image" class="footer-logo">
                                        @endisset



                                        <p style="color: {{$footer->text_color}}">{{$setting->company_slogan}}</p>



                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="widget widget_links clearfix">


                                        <ul>
                                            @isset($footer_menuitems)
                                            @foreach ($footer_menuitems as $footer_menuitem)
                                            @if ($footer_menuitem->url == null)
                                            <li><a style="color: {{$footer->text_color}}" href="{{route('page',$footer_menuitem->slug)}}">{{$footer_menuitem->title}}</a></li>
                                            @endif
                                            @endforeach
                                            @endisset
                                        </ul>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="widget widget_links clearfix">



                                        <ul>
                                            @isset($footer_menuitems)
                                            @foreach ($footer_menuitems as $footer_menuitem)
                                            @if ($footer_menuitem->slug == null)
                                            <li><a style="color: {{$footer->text_color}}" href="{{$footer_menuitem->url}}">{{$footer_menuitem->title}}</a></li>
                                            @endif
                                            @endforeach
                                            @endisset
                                        </ul>

                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="row col-mb-50">


                                <div class="col-md-3 col-lg-12">
                                    <div class="widget clearfix" style="margin-bottom: -20px;">

                                        <div class="row">
                                            <div class="col-6 col-md-12 col-lg-6 clearfix bottommargin-sm">
                                                <a href="{{$setting->facebook_link}}" class="social-icon si-dark si-colored si-facebook mb-0" style="margin-right: 10px;">
                                                    <i class="icon-facebook"></i>
                                                    <i class="icon-facebook"></i>
                                                </a>
                                                <a style="color: {{$footer->text_color}}" href="{{$setting->facebook_link}}"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <!-- Copyrights
            ============================================= -->
            <div id="copyrights">
                <div class="container">

                    <div class="row col-mb-30">

                        <div style="color: {{$footer->text_color}}" class="col-md-6 text-center text-md-start">
                            Copyrights &copy; 2022 All Rights Reserved by 1plusoverseas. Powered by: <a href="https://datahostbd.com/">datahostbd.com</a>
                        </div>

                    </div>

                </div>
            </div><!-- #copyrights end -->
        </footer> --}}

        <footer id="footer" style="background: {{$footer->background_color}};">
            <div class="container">

                <!-- Footer Widgets
                ============================================= -->
                <div class="footer-widgets-wrap">

                    <div class="row col-mb-50">
                        <div class="col-lg-12">

                            <div class="row col-mb-50">
                                <div class="col-md-4">

                                    <div class="widget clearfix">


                                        @isset($setting)
                                        <img width="200" src="{{asset('uploads/settings/'.$setting->logo)}}" alt="Image" class="footer-logo">
                                        @endisset



                                        <p style="color: {{$footer->text_color}}">{{$setting->company_slogan}}</p>


                                    </div>

                                </div>

                        @isset($footer_menuitems)
                        @foreach ($footer_menuitems as $footer_menuitem)

                        <div class="col-lg-2 col-md-8 pb-2 pb-sm-0">
                            <div class="widget">
                                <h4 style="color: {{$footer->text_color}}" class="widget-title pb-1">{{$footer_menuitem->title}}</h4>
                                @if(!$footer_menuitem->childs->isEmpty())
                                <ul>
                                    @foreach ($footer_menuitem->childs as $footer_item)
                                    @if ($footer_item->slug == null)
                                    <li><a style="color: {{$footer->text_color}}" href="{{$footer_item->url}}">{{$footer_item->title}}</a></li>
                                    @else
                                    <li><a style="color: {{$footer->text_color}}" href="{{route('page',$footer_item->slug)}}">{{$footer_item->title}}</a></li>
                                    @endif
                                    @endforeach
                                </ul>
                                @endif
                            </div><!-- End .widget -->
                        </div><!-- End .col-lg-3 -->

                        @endforeach
                        @endisset

                        <div class="col-md-4">
                            <div class="widget  clearfix">
                                <h5><strong>Subscribe</strong> to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</h5>
                                <div class="widget-subscribe-form-result"></div>
                                <form method="POST" action="{{route('subscriber.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                     @endif
                                    <div class="input-group mx-auto">
                                        <div class="input-group-text"><i class="icon-email2"></i></div>
                                        <input type="email" id="widget-subscribe-form-email" name="email" class="form-control required email" placeholder="Enter your Email">
                                        <button class="btn btn-success" type="submit">Subscribe</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                            </div>

                        </div>
                    </div>

                </div><!-- .footer-widgets-wrap end -->

            </div>

            <div id="copyrights" style="background: #fff">
                <div class="container">

                    <div class="row col-mb-30">

                        <div style="color: {{$footer->text_color}};" class="text-center text-md-start">
                           <p style="text-align: center;"> Copyrights &copy; 2022 All right reserved by <a href="https://datahostbd.com/">Datahostbd</a></p>
                        </div>



                    </div>

                </div>
            </div><!-- #copyrights end -->


        </footer>
        
    </div>
</div>

@else

<footer id="footer" style="background: {{$footer->background_color}};">
    <div class="container">

        <!-- Footer Widgets
        ============================================= -->
        <div class="footer-widgets-wrap">

            <div class="row col-mb-50">
                <div class="col-lg-12">

                    <div class="row col-mb-50">
                        <div class="col-md-4">

                            <div class="widget clearfix">


                                @isset($setting)
                                <img width="200" src="{{asset('uploads/settings/'.$setting->logo)}}" alt="Image" class="footer-logo">
                                @endisset



                                <p style="color: {{$footer->text_color}}">{{$setting->company_slogan}}</p>


                            </div>

                        </div>

                @isset($footer_menuitems)
                @foreach ($footer_menuitems as $footer_menuitem)

                <div class="col-lg-2 col-md-8 pb-2 pb-sm-0">
                    <div class="widget">
                        <h4 style="color: {{$footer->text_color}}" class="widget-title pb-1">{{$footer_menuitem->title}}</h4>
                        @if(!$footer_menuitem->childs->isEmpty())
                        <ul>
                            @foreach ($footer_menuitem->childs as $footer_item)
                            @if ($footer_item->slug == null)
                            <li><a style="color: {{$footer->text_color}}" href="{{$footer_item->url}}">{{$footer_item->title}}</a></li>
                            @else
                            <li><a style="color: {{$footer->text_color}}" href="{{route('page',$footer_item->slug)}}">{{$footer_item->title}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                    </div><!-- End .widget -->
                </div><!-- End .col-lg-3 -->

                @endforeach
                @endisset

                <div class="col-md-4">
                    <div class="widget  clearfix">
                        <h5><strong>Subscribe</strong> to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</h5>
                        <div class="widget-subscribe-form-result"></div>
                        <form method="POST" action="{{route('subscriber.store')}}" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                             @endif
                            <div class="input-group mx-auto">
                                <div class="input-group-text"><i class="icon-email2"></i></div>
                                <input type="email" id="widget-subscribe-form-email" name="email" class="form-control required email" placeholder="Enter your Email">
                                <button class="btn btn-success" type="submit">Subscribe</button>
                            </div>

                        </form>
                    </div>
                </div>
                    </div>

                </div>
            </div>

        </div><!-- .footer-widgets-wrap end -->

    </div>

    <div id="copyrights" style="background: #fff">
        <div class="container">

            <div class="row col-mb-30">

                <div style="color: {{$footer->text_color}};" class="text-center text-md-start">
                   <p style="text-align: center;"> Copyrights &copy; 2022 All right reserved by <a href="https://datahostbd.com/">Datahostbd</a></p>
                </div>



            </div>

        </div>
    </div><!-- #copyrights end -->


</footer>

@endif


@endisset

