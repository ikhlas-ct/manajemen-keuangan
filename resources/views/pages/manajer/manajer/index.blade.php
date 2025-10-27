@extends('layouts.app')
{{-- ==================== PAGE TITLE ==================== --}}
@section('title', 'Data Manajer')

{{-- ==================== STYLES ==================== --}}
@section('styles')
@endsection

{{-- ==================== CONTENT ==================== --}}
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Manajer</h4>
                    <p class="card-description">
                        Add class <code>.table-hover</code>
                    </p>
                    <div class="table-responsive">
                        <table class="table-hover table">
                            <thead>
                                <tr>
                                    <th>Nama Manajer</th>
                                    <th>Alamat</th>
                                    <th>No Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($manajers as $manajer)
                                    <tr>
                                        <td>{{ $manajer->nama_manajer }}</td>
                                        <td>{{ $manajer->alamat }}</td>
                                        <td>{{ $manajer->no_telepon }}</td>
                                        <td>
                                            <a href="#">Edit</a>
                                            <a href="#">Eelete</a>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

{{-- ==================== SCRIPTS ==================== --}}
@section('scripts')
@endsection
