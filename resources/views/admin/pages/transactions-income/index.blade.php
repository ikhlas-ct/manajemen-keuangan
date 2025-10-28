@extends('admin.layouts.app')

@section('title', 'Income Transactions Data')

@section('content')
<div class="container">

    <div class="card shadow-sm">
        <div class="card-body" style="font-size: 13px;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title mb-0">Income Transaction</h4>
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#createIncomeModal">
                    <i class="bi bi-plus-circle me-1"></i> Add Income
                </button>
            </div>
            <div class="table-responsive">
                <table id="datatable" class="table table-hover">
                    <thead style="background-color: #1B1B29; color: #FFFFFF;">
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
                                <td>
                                    <a href="{{ route('income.edit', 1) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger btn-delete-income" data-toggle="modal" data-target="#deleteIncomeModal">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
                @include('admin.pages.transactions-income.modal-create')
                @include('admin.pages.transactions-income.modal-delete')
            </div>
        </div>
    </div>
</div>

@endsection
