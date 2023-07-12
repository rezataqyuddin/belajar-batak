@extends('layout')
@section('content')
<div class="flex justify-center">
    <h1 style="font-size:42px">ᯘᯮᯒᯖ᯲ <small>Batak</small></h1>
</div>
<div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
    <a class="rounded-full bg-yellow-500 p-5 align-middle" href="{{route('home')}}">
        <span class="material-icons align-middle">
            arrow_back
        </span>
    </a>
    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
        @if(sizeof($data) > 0)
        <div class="lg:pr-8 lg:pt-4 mt-5">
            <div class="lg:max-w-lg">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Let's Writing</h2>
                Select one of these characters to write.
                <div class="space-x-1 flex text-sm font-medium">
                    @foreach ( $data as $chars )
                    <a href="?huruf={{$chars->class}}" class="ftext-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                        {{$chars->unicode}}
                    </a>
                    @endforeach
                </div>
                <hr>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Characters {{ isset($_GET['huruf']) ? $chars->char_name : "" }}</p>
                <p class="mt-6 text-lg leading-8 text-gray-600">About Characters.</p>

            </div>
        </div>
        <form method="POST" action="" class="">
            @if(isset($_GET['huruf']))
                <img src="{{ url('/') }}/img/chars/{{$chars->image}}" width=500 height=200 style="position:relative; opacity:0.3; " />
            @endif
            <canvas class="pad ring ring-pink-500 ring-offset-0 rounded-md" height="300" style="z-index:2;position:absolute; margin-left:-40px; margin-top:50px;"></canvas>
        </form>
        @else 
        <div class="lg:pr-8 lg:pt-4 mt-5">
            <h2>Something went wrong</h2>    
    </div>
        @endif
    </div>
</div>
@endsection

@section('js')
<script src="{{ url('/')}}/js/jquery.signaturepad.js"></script>
<script>
    (function(window) {
        var $canvas,
            onResize = function(event) {
                $canvas.attr({
                    height: "300px",
                    width: "450px"
                });
            };

        $(document).ready(function() {
            $canvas = $('canvas');
            window.addEventListener('orientationchange', onResize, false);
            window.addEventListener('resize', onResize, false);
            onResize();

            $('form').signaturePad({
                drawOnly: true,
                defaultAction: 'drawIt',
                validateFields: false,
                lineWidth: 0,
                output: null,
                sigNav: null,
                name: null,
                typed: null,
                clear: 'input[type=reset]',
                typeIt: null,
                drawIt: null,
                typeItDesc: null,
                drawItDesc: null
            });
        });
    }(this));
</script>
<script src="{{ url('/')}}/js/json2.min.js"></script>
@endsection