@extends('layout')
@section('content')
<header class="py-5">
    <div class="container px-5 pb-5">
        <div class="row gx-5 align-items-center">
            <div class="col-xl-5">
                <!-- Header text content-->
                <div class="text-center text-xxl-start">
                    <div class="fs-3 fw-light text-muted">
                        <a class="rounded-full bg-yellow-500 p-2 align-middle" href="{{route('home')}}">
                            <span class="material-icons align-middle">
                                arrow_back
                            </span>
                        </a>
                    </div>
                    <h3 class="fw-bolder mb-5">
                        <small>
                            Select one of these characters to write.
                        </small>
                    </h3>
                    <div class="d-flex gap-3 flex-wrap mb-3">
                        @foreach ( $data as $chars )
                        <a href="?huruf={{$chars->class}}" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Character : {{ $chars->class }}">
                            {{$chars->unicode}}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-7">
                <!-- Header profile picture-->
                <div class="d-flex justify-content-center mt-5 mt-xxl-0">
                    <div class="">
                        <form method="POST" action="{{route('predict')}}">
                            @csrf
                            <div class="container border border-primary rounded">
                                <canvas id="signature-pad" height="350" width="400"></canvas>
                                <div id="data">
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <button type="button" class="btn btn-success" id="check">Check your Writing</button>
                                <button type="button" class="btn btn-danger mx-2" id="clear"><i class="fa fa-eraser"></i>Clear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="modal fade" id="modal-result" tabindex="-1" aria-labelledby="modal-result" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hello</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Your Writing : <span id="predicted"></span><br>
                AI predict Confidence : <span id="confidence"></span>
            </div>
        </div>
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
    $("#check").click(function() {
        var data = signaturePad.toDataURL('image/jpeg');
        $.ajax({
            contentType: "application/json",
            url: "http://127.0.0.1:8001/predict/image",
            type: "POST",
            dataType: 'json',
            data: JSON.stringify({
                "image_base64": data
            }),
            success: function(response) {
                console.log(response);
                $("#predicted").html(response.class);
                $("#confidence").html(response.confidence);
                var modal = new bootstrap.Modal(document.getElementById('modal-result'));
                modal.show();
            }
        });
    });

    var canvas = document.getElementById('signature-pad');
    function resizeCanvas() {
        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }

    window.onresize = resizeCanvas;
    resizeCanvas();

    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)',
        minWidth: 3,
        maxWidth: 5,
        penCap: 'butt',
        penColor: '#000000',
    });

    document.getElementById('clear').addEventListener('click', function() {
        signaturePad.clear();
    });
</script>
<script src="{{ url('/')}}/js/json2.min.js"></script>
@endsection