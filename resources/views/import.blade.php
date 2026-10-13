<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                padding: 24px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="position-ref full-height">
            <div class="content">
                @if(session()->get('message'))
                    <div class="alert alert-success">
                    {{ session()->get('message') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('importPatients') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="file" class="">Importar Pacientes</label>
                        <div class="col-md-6">
                            <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}" required autofocus />
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Upload') }}
                            </button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('importRecords') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="file" class="">Importar Historias</label>
                        <div class="col-md-6">
                            <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}" required autofocus />
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Upload') }}
                            </button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('importPhysical') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="file" class="">Importar Físico</label>
                        <div class="col-md-6">
                            <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}" required autofocus />
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Upload') }}
                            </button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('importCito') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="file" class="">Importar Citologías y Embarazos</label>
                        <div class="col-md-6">
                            <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}" required autofocus />
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Upload') }}
                            </button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('importConclusions') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="file" class="">Importar Conclusiones</label>
                        <div class="col-md-6">
                            <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}" required autofocus />
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Upload') }}
                            </button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('importControls') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="file" class="">Importar Controles</label>
                        <div class="col-md-6">
                            <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}" required autofocus />
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Upload') }}
                            </button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('importEvolutions') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="file" class="">Importar Evoluciones</label>
                        <div class="col-md-6">
                            <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}" required autofocus />
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Upload') }}
                            </button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('importIncomes') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="file" class="">Importar Ingresos diarios</label>
                        <div class="col-md-6">
                            <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}" required autofocus />
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Upload') }}
                            </button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('importAppointments') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="file" class="">Importar Citas</label>
                        <div class="col-md-6">
                            <input id="file" type="file" class="form-control" name="file" value="{{ old('file') }}" required autofocus />
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Upload') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
