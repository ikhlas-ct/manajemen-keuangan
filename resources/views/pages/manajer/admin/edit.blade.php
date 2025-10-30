@extends('layouts.app')
{{-- ==================== PAGE TITLE ==================== --}}
@section('title','Edit Data Admin')

{{-- ==================== STYLES ==================== --}}
@section('styles')
@endsection

{{-- ==================== CONTENT ==================== --}}
@section('content')
  <div class="row">
        <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Data Admin</h4>
                  <p class="card-description">

                  </p>
                  @include('partials.alert')
                    <form class="forms-sample" action="{{ route('manajer.admin.update', $admins->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="nama_admin">Nama Admin</label>
                      <input type="text"class="form-control @error('nama_admin') is-invalid @enderror"
                            id="nama_admin" name="nama_admin"
                            value="{{ old('nama_admin', $admins->nama_admin) }}"
                            placeholder="Nama Admin">
                    </div>
                    <div class="form-group">
                      <label for="email">Email Address</label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email', $admins->user->email) }}">
                    </div>
                       <div class="form-group">
                      <label for="no_telepon">No Telepon</label>
                      <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" placeholder="No Telepon" value="{{ old('no_telepon', $admins->no_telepon) }}">
                    </div>
                      <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="4">{{ old('alamat', $admins->alamat) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>



             <div class="col-12 grid-margin stretch-card">
              <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Password</h4>
                <form class="forms-sample" action="{{ route('manajer.manajer.update-password', $admins->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control"
                            value="{{ $admins->user->name }}"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password"
                            placeholder="Enter new password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control"
                            id="password_confirmation" name="password_confirmation"
                            placeholder="Confirm new password">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Update Password</button>
                    <a href="{{ route('manajer.manajer.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
            </div>


    </div>
@endsection




{{-- ==================== SCRIPTS ==================== --}}
@section('scripts')
@endsection
