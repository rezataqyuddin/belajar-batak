@extends('layout')

@section('content')
<div class="flex justify-center">
    <h1 style="font-size:42px">ᯘᯮᯒᯖ᯲ <small>Batak</small></h1>
</div>
<div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
    <a class="rounded-full bg-yellow-500 p-5 align-middle" href="{{route('home')}}">
        <span class="material-icons mt-5 relative">
            arrow_back
        </span>
    </a>
    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2 mt-5">
        <div class="lg:pr-8 lg:pt-4">
            <div class="lg:max-w-lg">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Latihan Menulis</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Tuliskan kata berikut ini kedalam bahasa Batak.
                </p>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Batak</p>
                <button id="shuffle" class="mt-10 ring-2 ring-blue-500 px-5 py-2 rounded">Ganti Kata</button>
            </div>
        </div>
        <div class="wrapper flex">
            <canvas id="signature-pad" class="signature-pad ring ring-pink rounded" width=400 height=300></canvas>
        </div>
    </div>
    <div class="flex align-items-right">
        <button id="save" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
        <button id="clear" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Clear</button>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });
        var saveButton = document.getElementById('save');
        var cancelButton = document.getElementById('clear');

        saveButton.addEventListener('click', function(event) {
            var data = signaturePad.toDataURL('image/png');
            // Send data to server instead...
            // window.open(data);
            console.log(data);
        });

        cancelButton.addEventListener('click', function(event) {
            signaturePad.clear();
        });
    });
</script>
@endsection