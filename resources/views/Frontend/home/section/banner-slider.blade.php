<section id="wsus__banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__banner_content">
                    <div class="row banner_slider">
                        @foreach ($sliders as $slider)
                        <div class="col-xl-12"> 
                            <div class="wsus__single_slider" style="background: url({{$slider->banner}});">
                                <div class="wsus__single_slider_text">
                                    <h3>{!! $slider->type !!}</h3>
                                    {{-- I DOPPI PUNTI ESCLAMATIVI PREVENGONO DALL ERRORE LADDOVE CI SIANO DEGLI APOSTROFI ALL INETRNO DELLA PAROLA O DEL TITOLO, IN QUESTO CASO NON SI UTILIZZANO LE DOPPIE PARENTESI --}}
                                    <h1>{{$slider->title}}</h1>
                                    <h6>${{$slider->starting_price}}</h6>
                                    <a class="common_btn" href="{{$slider->btn_url}}">shop now</a>
                                </div>
                            </div>
                        </div>    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>