@extends(backpack_view('blank'))

{{-- @php
    if (backpack_theme_config('show_getting_started')) {
        $widgets['before_content'][] = [
            'type'        => 'view',
            'view'        => backpack_view('inc.getting_started'),
        ];
    } else {
        $widgets['before_content'][] = [
            'type'        => 'jumbotron',
            'heading'     => trans('backpack::base.welcome'),
            'heading_class' => 'display-3 '.(backpack_theme_config('layout') === 'horizontal_overlap' ? ' text-white' : ''),
            'content'     => trans('backpack::base.use_sidebar'),
            'content_class' => backpack_theme_config('layout') === 'horizontal_overlap' ? 'text-white' : '',
            'button_link' => backpack_url('logout'),
            'button_text' => trans('backpack::base.logout'),
        ];
    }
@endphp --}}


@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body text-center">
                    <p class="card-text" style="font-size:2rem;">{{ \App\Models\User::where('role', 'student')->count() }}</p>
                    <h5 class="card-title">Total Students</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body text-center">
                    <p class="card-text" style="font-size:2rem;">
                        {{ \App\Models\User::where('role', 'student')->where('present_address', '!=', null)->count() }}</p>
                        <h5 class="card-title">Present Students</h5>
                    </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body text-center">
                    <p class="card-text" style="font-size:2rem;">{{ \App\Models\DriverStudent::where('status', 'Done')->count() }}</p>
                    <h5 class="card-title">Passing Students</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body text-center">
                    <p class="card-text" style="font-size:2rem;">{{ \App\Models\User::where('role', 'driver')->count() }}</p>
                    <h5 class="card-title">Total Drivers</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
