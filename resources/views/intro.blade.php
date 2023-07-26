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
        <div class="lg:pr-8 lg:pt-4 mt-5">
            <div class="lg:max-w-lg">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Let's Writing<br>
                    <small>
                        Select one of these characters to write.
                    </small>
                </h2>
                <hr class="mb-5">
                <div class="grid gap-4 grid-cols-6 grid-rows-3">
                    @foreach ( $data as $chars )
                    <a href="?huruf={{$chars->class}}" class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                        {{$chars->unicode}}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <div class="text-right">
                <button type="button" class="btn btn-danger btn-sm" id="clear"><i class="fa fa-eraser"></i>Clear</button>
            </div>
            <br>
            <form method="POST" action="{{route('predict')}}">
                @csrf
                <div class="wrapper">
                    <canvas id="signature-pad" class="signature-pad"></canvas>
                    <div id="data">
                    </div>
                </div>
                <br>
                <button type="button" class="btn btn-info btn-sm" id="save-jpeg">Prepare</button>
                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
    @endsection

    @section('js')
    <style type="text/css">
        .sigPad {
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            height: 260px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script>
        var canvas = document.getElementById('signature-pad');

        // Adjust canvas coordinate space taking into account pixel ratio,
        // to make it look crisp on mobile devices.
        // This also causes canvas to be cleared.
        function resizeCanvas() {
            // When zoomed out to less than 100%, for some very strange reason,
            // some browsers report devicePixelRatio as less than 1
            // and only part of the canvas is cleared then.
            var ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }

        window.onresize = resizeCanvas;
        resizeCanvas();

        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)',
            penWidth: 100,
            lineWidth : 100,
            penCap : 'butt',
        });

        document.getElementById('save-jpeg').addEventListener('click', function() {
            if (signaturePad.isEmpty()) {
                alert("Tanda Tangan Anda Kosong! Silahkan tanda tangan terlebih dahulu.");
            } else {
                var data = signaturePad.toDataURL('image/jpeg');
                console.log(data);
                $('#data').html('<h4>Format .JPEG</h4><img src="'+data+'"><textarea id="signature64" name="signed" style="display:none">'+data+'</textarea>');
            }
        });

        
        document.getElementById('clear').addEventListener('click', function() {
            signaturePad.clear();
        });

    </script>
    <script src="{{ url('/')}}/js/json2.min.js"></script>
    @endsection