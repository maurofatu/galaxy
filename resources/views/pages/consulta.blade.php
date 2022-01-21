@extends('layouts.app')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    @include('layouts.headers.cards')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row justify-content-center">
            <div class=" col ">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0 text-center"><b>CONSULTAS</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="row icon-examples">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="capitan">Nombre Capitan</label>
                                    <select class="form-control js-example-basic-single" id="capitan" name="capitan"
                                        onchange="buscarjugadores(event)" required>
                                        <option value="" selected>Seleccione...</option>
                                        @foreach ($data['capitaneslist'] as $iitem)
                                            <option value="{{ $iitem->cedula }}"> {{ $iitem->nombres }} </option>
                                        @endforeach
                                    </select>
                                    @error('comuna')
                                        <small style="color: #FF0000"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="tablejug" class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">#</th>
                                            <th scope="col" class="sort" data-sort="name">CEDULA</th>
                                            <th scope="col" class="sort" data-sort="budget">NOMBRES</th>
                                            <th scope="col" class="sort" data-sort="budget">CELULAR</th>
                                            <th scope="col" class="sort" data-sort="budget">MUNICIPIO</th>
                                            <th scope="col" class="sort" data-sort="budget">DEPARTAMENTO VOTACIÓN
                                            </th>
                                            <th scope="col" class="sort" data-sort="budget">MUNICIPIO VOTACIÓN
                                            </th>
                                            <th scope="col" class="sort" data-sort="budget">LUGAR VOTACIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">

                                    </tbody>
                                </table>
                            </div>



                        </div> <!--  End Row -->
                    </div>
                </div><!--  End Card -->
            </div>
        </div>
        <!-- Footer -->
        @include('layouts.footers.auth')
    </div><!-- fin content -->

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('argon') }}/js/function.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
