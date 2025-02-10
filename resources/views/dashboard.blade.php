@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard</h2>
    <p>Total Leave Days: {{ $user->total_leave_days }}</p>
    <p>Remaining Leave Days: {{ $user->remaining_leave_days }}</p>

    <h3>Apply for Leave</h3>
    <form action="{{ route('apply-leave') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Apply</button>
    </form>

    <h3>Your Leave Applications</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaveDays as $leave)
                <tr>
                    <td>{{ $leave->start_date }}</td>
                    <td>{{ $leave->end_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection