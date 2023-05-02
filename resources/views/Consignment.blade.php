<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TheLorry</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
        <section class="container-sm" style="width: 600px; margin-left:5em">
            <div class="container border border-dark my-3" id="app">
                <div class="row">
                    <div class="col text-left">
                        <h1 class="document-type display-4" style="margin-right:2em"><span>TheLorry</span></h1>
                        <p class="mx-2"><strong>Ref. Code
                                <em>{{ $data->address1 ? 'P' : 'D' }}{{ date('Ymmd', strtotime($data->created_at)) }}-{{ Auth::user()->id }}</strong></em>
                        </p>
                    </div>
                    <div class="col text-right">
                        <address><strong>The Lorry Sdn.Bhd.</strong><br>
                            Lot 8, Jalan Astaka U8/81, Bukit Jelutong Business And Technology Centre,
                            40150 Shah Alam, Selangor, Malaysia</address>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Tracking:
                        {{ $data->address1 ? 'PCu' : 'Drp' }}{{ date('mdy', strtotime($data->created_at)) }}{{ $data->id }}
                    </div>
                    <div class="col">Type: Parcel Delivery</div>
                    <div class="col">Weight: {{ $data->weight }} KG</div>
                    <div class="col">Date: {{ date('d M Y', strtotime($data->date)) }}</div>
                </div>
                <div class="row">
                    <div class="col border border-dark pt-3">
                        <div>From: {{ $data->name }}</div>
                        <div>Phone: {{ $data->phone }}</div>
                        <address>
                            {{ $data->address1 ? $data->address1 : Auth::user()->address1 }},
                            {{ $data->address2 ? $data->address2 : Auth::user()->address2 }},
                            {{ $data->postcode ? $data->postcode : Auth::user()->postcode }},
                            {{ $data->city ? $data->city : Auth::user()->city }},
                            {{ $data->province ? $data->province : Auth::user()->province }},
                            {{ $data->country ? $data->country : Auth::user()->country }}
                        </address>
                    </div>
                    <div class="col border border-dark pt-3">
                        <div>To: {{ $data->toname }}</div>
                        <div>Phone: {{ $data->tophone }}</div>
                        <address>
                            Address:
                            {{ $data->toaddress1 }}, {{ $data->toaddress2 }}, {{ $data->topostcode }},
                            {{ $data->tocity }}, {{ $data->toprovince }}, {{ $data->tocountry }}
                        </address>
                    </div>
                </div>
                <div class="row border border-dark"></div>
                <div class="row">
                    <div class="col border border-dark py-3">
                        <div class="d-flex justify-content-around">{!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate($data) !!}</div>
                    </div>
                    <div class="col border border-dark py-3 text-center">
                        <div style="padding-top: 3em; padding-left:6em;">{!! DNS1D::getBarcodeHTML($data->sku, 'C39') !!}</div>
                        <div>
                            {{ date('mdy', strtotime($data->created_at)) }}{{ $data->id }}{{ number_format($data->price, 0) }}{{ date('dmy', strtotime($data->date)) }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

<div class="button mx-2">
    <a @click="printMe" rel="noopener" target="_blank" class="btn bg-blue"><i class="fas fa-print"></i> Print</a>
</div>

</html>
<script src="/js/app.js" defer></script>
