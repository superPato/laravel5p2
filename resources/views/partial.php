@php($three_months_from_now = Carbon::parse('-3 months')->format('d-m-Y'))

<div class="col-md-6 col-md-offset-3">

    <h1>{{ $three_months_from_now }}</h1>

</div>