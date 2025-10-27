@extends('admin.layouts.app')

@section('title', 'Income Transactions Data')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Income Transactions Data</h5>
    </div>

    <div class="card shadow-sm">
        <div class="card-body" style="font-size: 13px;">
            <table id="datatable" class="table table-bordered table-striped align-middle table-sm">
                <thead class="table-success" style="font-size: 13px;">
                    <tr>
                        <th>No</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Receipt</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13px;">
                    {{-- @foreach() --}}
                        <tr>
                            <td>1</td>
                            <td>Proyek</td>
                            <td>01 Jan 2025</td>
                            <td>Rp 1.000.000</td>
                            <td>-</td>
                            <td>Description</td>
                            <td>-</td>
                        </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
