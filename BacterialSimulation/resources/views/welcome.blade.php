@extends('layouts.master-layout')
@section('title')
    <title>Welcome to Bacterial Growth Simulator</title>
@endsection
@section('content')
<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Bacterial Growth Simulator
            </div>
            <div class="info">
                <p>Bacterial Simulator is a mobile responsive web app that visually simulates the bacterial growth on food. The growth of bacteria displays how food would change based on parameters set by the end user, such as (PH levels, water content of the food, temperature, etc). There is a database of foods and pathogens that you will be able to choose from to start your simulations, and watch the bacteria grow (or not)! You can create an account in order to save your simulations for easy re-runs of the same parameters. We hope you enjoy your bacterial simulations.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
@endsection