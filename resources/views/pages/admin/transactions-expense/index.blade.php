@extends('layouts.app')

@section('title', 'Expense Transactions Data')

@section('content')
<div class="container">

    <div class="card shadow-sm">
        <div class="card-body" style="font-size: 13px;">
            @include('partials.alert')
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title mb-0">Expense Transaction</h4>
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#createExpenseModal">
                    <i class="bi bi-plus-circle me-1"></i> Add Expense
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
                        @foreach($transactions as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->category->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->date)->translatedFormat('d M Y') }}</td>
                            <td>Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                            <td>
                                @if($item->receipt_file)
                                    <a href="{{ asset('storage/'.$item->receipt_file) }}" target="_blank">View</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $item->description ?? '-' }}</td>
                            <td>
                                <a href="{{ route('expense.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button class="btn btn-sm btn-danger btn-delete-expense" data-toggle="modal" data-target="#deleteExpenseModal" data-id="{{ $item->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('pages.admin.transactions-expense.modal-create')
                @include('pages.admin.transactions-expense.modal-delete')
            </div>
        </div>
    </div>
</div>

@endsection
