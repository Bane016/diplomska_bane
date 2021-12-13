@extends('layouts.app')
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.21.0/slimselect.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><b>{{ __('Register') }}</b></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text"
                                           class="form-control @error('surname') is-invalid @enderror" name="surname"
                                           value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="personal_number"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Personal Number') }}</label>

                                <div class="col-md-6">
                                    <input id="personal_number" type="text"
                                           class="form-control @error('personal_number') is-invalid @enderror"
                                           name="personal_number" value="{{ old('personal_number') }}" required
                                           autocomplete="personal_number" autofocus>

                                    @error('personal_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile_number"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                                <div class="col-md-6">
                                    <input id="mobile_number" type="text"
                                           class="form-control @error('mobile_number') is-invalid @enderror"
                                           name="mobile_number" value="{{ old('mobile_number') }}" required
                                           autocomplete="mobile_number" autofocus>

                                    @error('mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                                <div class="col-md-6">
                                    <select id="city" type="text"
                                            class="@error('city') is-invalid @enderror"
                                            name="city" value="{{ old('city') }}" required autocomplete="city"
                                            autofocus>
                                        <option value="Berovo">Berovo</option>
                                        <option value="Bitola">Bitola</option>
                                        <option value="Bogdanci">Bbogdanci</option>
                                        <option value="Valandovo">Valandovo</option>
                                        <option value="Veles">Veles</option>
                                        <option value="Gevgelija">Gevgelija</option>
                                        <option value="Gostivar">Gostivar</option>
                                        <option value="Debar">Debar</option>
                                        <option value="Delcevo">Delcevo</option>
                                        <option value="Demir Kapija">Demir Kapija</option>
                                        <option value="Demir Hisar">Demir Hisar</option>
                                        <option value="Kavadarci">Kavadarci</option>
                                        <option value="Kicevo">Kicevo</option>
                                        <option value="Kocani">Kocani</option>
                                        <option value="Kratovo">Kratovo</option>
                                        <option value="Kriva Palanka">Kriva Palanka</option>
                                        <option value="Krusevo">Krusevo</option>
                                        <option value="Kumanovo">Kumanovo</option>
                                        <option value="Makedonski Brod">Makedonski Brod</option>
                                        <option value="Makedonska Kamenica">Makedonska Kamenica</option>
                                        <option value="Negotino">Negotino</option>
                                        <option value="Ohrid">Ohrid</option>
                                        <option value="Pehcevo">Pehcevo</option>
                                        <option value="Prilep">Prilep</option>
                                        <option value="Probistip">Probistip</option>
                                        <option value="Radovis">Radovis</option>
                                        <option value="Resen">Resen</option>
                                        <option value="Sveti Nikole">Sveti Nikole</option>
                                        <option value="Skopje">Skopje</option>
                                        <option value="Struga">Struga</option>
                                        <option value="Strumica">Strumica</option>
                                        <option value="Tetovo">Tetovo</option>
                                        <option value="Stip">Stip</option>
                                    </select>

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.21.0/slimselect.min.js"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csfr-token"]').attr('content')
            }
        });

        $(document).ready(function () {

            let city = new SlimSelect({
                select: '#city'
            });
        });
    </script>
@endsection
