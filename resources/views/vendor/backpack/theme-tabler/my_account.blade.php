@extends(backpack_view('blank'))

@section('after_styles')
    <style media="screen">
        .backpack-profile-form .required::after {
            content: ' *';
            color: red;
        }

        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            padding: 40px;
            color: white;
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(50%, -50%);
        }

        .profile-avatar {
            position: relative;
            z-index: 1;
            margin-bottom: 20px;
        }

        .profile-avatar .avatar {
            width: 120px;
            height: 120px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .profile-info {
            position: relative;
            z-index: 1;
        }

        .profile-info h1 {
            font-size: 32px;
            font-weight: 700;
            margin: 0 0 5px 0;
        }

        .profile-info p {
            font-size: 14px;
            opacity: 0.9;
            margin: 0;
        }

        .profile-stats {
            display: flex;
            gap: 30px;
            margin-top: 20px;
            position: relative;
            z-index: 1;
        }

        .profile-stat {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-stat i {
            font-size: 18px;
            opacity: 0.9;
        }

        .profile-stat-value {
            font-weight: 600;
        }

        .profile-stat-label {
            font-size: 12px;
            opacity: 0.8;
        }

        .card-profile {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            margin-bottom: 24px;
        }

        .card-profile .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #e5e7eb;
            border-radius: 8px 8px 0 0;
        }

        .card-profile .card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #333;
            font-weight: 600;
        }

        .card-profile .card-title i {
            color: #667eea;
        }

        .form-group label {
            font-weight: 500;
            color: #333;
            margin-bottom: 6px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 8px 12px;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn {
            border-radius: 6px;
            font-weight: 500;
            padding: 8px 16px;
            transition: all 0.2s;
        }

        .btn-success {
            background: #10b981;
            border-color: #10b981;
        }

        .btn-success:hover {
            background: #059669;
            border-color: #059669;
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        .card-footer.bg-light {
            background-color: #f8f9fa !important;
            border-top: 1px solid #e5e7eb;
        }

        .profile-header .btn-light {
            background-color: rgba(255, 255, 255, 0.25) !important;
            border-color: rgba(255, 255, 255, 0.4) !important;
            color: white !important;
            transition: all 0.3s ease;
        }

        .profile-header .btn-light:hover {
            background-color: rgba(255, 255, 255, 0.4) !important;
            border-color: rgba(255, 255, 255, 0.6) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .profile-header .btn-light i {
            color: white;
        }

        /* Form validation styles */
        .form-control.is-invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath fill='%23dc3545' d='M8 4a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 4zm-1-2h1v1H7V2z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .form-control.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 13px;
            margin-top: 4px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }
    </style>
@endsection

@php
  $breadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      trans('backpack::base.my_account') => false,
  ];
@endphp

@section('header')
    <section class="content-header">
        <div class="container-fluid mb-3">
            <h1>{{ trans('backpack::base.my_account') }}</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">

        {{-- PROFILE HEADER --}}
        <div class="col-12">
            <div class="profile-header">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto d-flex align-items-center">
                        <div class="profile-avatar">
                            <span class="avatar avatar rounded-circle" style="width: 120px; height: 120px; font-size: 48px;">
                                <img src="{{ backpack_avatar_url($user) }}" alt="{{ $user->name }}" class="avatar-img" onerror="this.style.display='none'" style="width: 100%; height: 100%; object-fit: cover;">
                                <span class="avatar rounded-circle backpack-avatar-menu-container text-center" style="width: 120px; height: 120px; line-height: 120px; font-size: 48px;">
                                    {{ mb_substr($user->name, 0, 1, 'UTF-8') }}
                                </span>
                            </span>
                        </div>
                        <div class="profile-info ms-4">
                            <h1>{{ $user->name }}</h1>
                            <p>{{ $user->email }}</p>
                            <div class="profile-stats">
                                <div class="profile-stat">
                                    <i class="la la-shield-alt"></i>
                                    <div>
                                        <div class="profile-stat-value">{{ ucfirst($user->role ?? 'User') }}</div>
                                        <div class="profile-stat-label">Role</div>
                                    </div>
                                </div>
                                <div class="profile-stat">
                                    <i class="la la-calendar"></i>
                                    <div>
                                        <div class="profile-stat-value">{{ $user->created_at->format('M Y') }}</div>
                                        <div class="profile-stat-label">Member Since</div>
                                    </div>
                                </div>
                                <div class="profile-stat">
                                    <i class="la la-clock"></i>
                                    <div>
                                        <div class="profile-stat-value">{{ $user->updated_at->format('M d, Y') }}</div>
                                        <div class="profile-stat-label">Last Updated</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <a href="{{ backpack_url('admin/' . $user->id . '/edit') }}" class="btn btn-light text-dark fw-semibold" style="border-radius: 6px;">
                            <i class="la la-edit me-2"></i>Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ALERTS --}}
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="la la-check-circle me-2"></i>
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->count())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-start">
                        <i class="la la-exclamation-circle me-2" style="margin-top: 2px;"></i>
                        <div>
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>

        {{-- UPDATE INFO FORM --}}
        <div class="col-lg-8 mb-4">
            <form class="form" action="{{ route('backpack.account.info.store') }}" method="post">

                {!! csrf_field() !!}

                <div class="card card-profile">

                    <div class="card-header">
                        <h3 class="card-title"><i class="la la-user"></i> {{ trans('backpack::base.update_account_info') }}</h3>
                    </div>

                    <div class="card-body backpack-profile-form bold-labels">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                @php
                                    $label = trans('backpack::base.name');
                                    $field = 'name';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input required class="form-control" type="text" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->$field }}">
                            </div>

                            <div class="col-md-6 form-group">
                                @php
                                    $label = trans('backpack::base.'.strtolower(config('backpack.base.authentication_column_name')));
                                    $field = backpack_authentication_column();
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input required class="form-control @error($field) is-invalid @enderror" type="{{ backpack_authentication_column()==backpack_email_column()?'email':'text' }}" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->$field }}">
                                @error($field)
                                    <div class="invalid-feedback d-block">
                                        <i class="la la-warning me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light">
                        <button type="submit" class="btn btn-success"><i class="la la-save me-2"></i> {{ trans('backpack::base.save') }}</button>
                        <a href="{{ backpack_url() }}" class="btn btn-secondary"><i class="la la-times me-2"></i> {{ trans('backpack::base.cancel') }}</a>
                    </div>
                </div>

            </form>
        </div>

        {{-- CHANGE PASSWORD FORM --}}
        <div class="col-lg-8 mb-4">
            <form class="form" action="{{ route('backpack.account.password') }}" method="post">

                {!! csrf_field() !!}

                <div class="card card-profile">

                    <div class="card-header">
                        <h3 class="card-title"><i class="la la-lock"></i> {{ trans('backpack::base.change_password') }}</h3>
                    </div>

                    <div class="card-body backpack-profile-form bold-labels">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                @php
                                    $label = trans('backpack::base.old_password');
                                    $field = 'old_password';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
                            </div>

                            <div class="col-md-4 form-group">
                                @php
                                    $label = trans('backpack::base.new_password');
                                    $field = 'new_password';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
                            </div>

                            <div class="col-md-4 form-group">
                                @php
                                    $label = trans('backpack::base.confirm_password');
                                    $field = 'confirm_password';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light">
                        <button type="submit" class="btn btn-success"><i class="la la-save me-2"></i> {{ trans('backpack::base.change_password') }}</button>
                        <a href="{{ backpack_url() }}" class="btn btn-secondary"><i class="la la-times me-2"></i> {{ trans('backpack::base.cancel') }}</a>
                    </div>

                </div>

            </form>
        </div>

    </div>
@endsection
