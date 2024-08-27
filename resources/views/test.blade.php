<!doctype html>

<html>

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">



        <title>Rekenings</title>

        <link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css"/>

    </head>

    <body>

        <div class="mw6 center pa3 sans-serif">

            <h1 class="mb4">Rekening</h1>



            @foreach($rekening as $rek)

            <div class="pa2 mb3 striped--near-white">

                <header class="b mb2">{{ $rek->nama_ktp }}</header>

                <div class="pl2">

                    <p class="mb2">model: {{ $rek->tempat_lahir }}</p>

                    <p class="mb2">year: {{ $rek->tanggal_lahir }}</p>

                    <p class="mb2">owner: {{ $rek->provinces.name }}</p>

                    <p class="mb2">email: {{ $rek->pekerjaan.name }}</p>

                </div>

            </div>

            @endforeach

        </div>

    </body>

</html>