@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-xl-6 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-primary-light rounded w-60 h-60">
                            <i class="text-primary mr-0 font-size-24 mdi mdi-account-group"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Total Users</p>
                            <h3 class="text-white mb-0 font-weight-500">{{ count(App\Models\User::all()) }} </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-warning-light rounded w-60 h-60">
                            <i class="text-warning mr-0 font-size-24 mdi mdi-post"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Total Posts</p>
                            <h3 class="text-white mb-0 font-weight-500">{{ count(App\Models\Post::all()) }} </h3>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-info-light rounded w-60 h-60">
                            <i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
                        </div>
                        <div>
                            @php
                                $month = date('Y-m');
                                $student_fee = \App\Models\AccountStudentFee::where('date', $month)->sum('amount');
                                $employee_salary = \App\Models\AccountEmployeeSalary::where('date', $month)->sum('amount');
                                $other_costs = \App\Models\AccountOtherCost::where('date', 'like', '%'. $month . '%')->sum('amount');
                                $totalCost = $employee_salary + $other_costs;
                                $profit = $student_fee - $totalCost;
                            @endphp
                            <p class="text-mute mt-20 mb-0 font-size-16">Profit This Month</p>
                            <h3 class="{{ $profit < 0 ? 'text-danger' : 'text-white' }} mb-0 font-weight-500">{{ $profit }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-danger-light rounded w-60 h-60">
                            <i class="text-danger mr-0 font-size-24 mdi mdi-bank-transfer"></i>
                        </div>
                        <div>
                            @php
                                $transactionsList = array();
                                $student_fee = \App\Models\AccountStudentFee::select(['date', 'amount', 'updated_at'])->get();
                                $employee_salary = \App\Models\AccountEmployeeSalary::select(['date', 'amount', 'updated_at'])->get();
                                $other_costs = \App\Models\AccountOtherCost::select(['date', 'amount', 'updated_at'])->get();
                                foreach ($student_fee as $key => $value) {
                                    array_push($transactionsList, [
                                        'date' => $value->date,
                                        'amount' => $value->amount,
                                        'type' => 'Student Fee',
                                        'updated_at' => $value->updated_at
                                    ]);
                                }
                                foreach ($employee_salary as $key => $value) {
                                    array_push($transactionsList, [
                                        'date' => $value->date,
                                        'amount' => $value->amount,
                                        'type' => 'Employee Salary',
                                        'updated_at' => $value->updated_at
                                    ]);
                                }
                                foreach ($other_costs as $key => $value) {
                                    array_push($transactionsList, [
                                        'date' => $value->date,
                                        'amount' => $value->amount,
                                        'type' => 'Other Costs',
                                        'updated_at' => $value->updated_at
                                    ]);
                                }
                                usort($transactionsList, function($a, $b) {
                                    return $a['updated_at'] < $b['updated_at'];
                                });
                                $count = 0;
                            @endphp
                            <p class="text-mute mt-20 mb-0 font-size-16">Total Transaction</p>
                            <h3 class="text-white mb-0 font-weight-500">{{ count($transactionsList) }}</h3>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title align-items-start flex-column">
                            Latest transaction
                        </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <thead>
                                    <tr class="text-uppercase bg-lightest">
                                        <th style="min-width: 200px"><span class="text-white">Date</span></th>
                                        <th style="min-width: 200px"><span class="text-fade">Last Update</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">Amount</span></th>
                                        <th style="min-width: 150px"><span class="text-fade">Type</span></th>
                                        <th style="min-width: 100px"><span class="text-fade"></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactionsList as $transaction)
                                        @if ($count <= 10)
                                            <tr>
                                                <td class="pl-0 py-8">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 mr-20">
                                                            <div class="bg-img h-50 w-50" style="background-image: url(../images/gallery/creative/img-1.jpg)"></div>
                                                        </div>
                                                        <div>
                                                            <a href="#" class="text-white font-weight-600 hover-primary mb-1 font-size-16">{{ $transaction['date'] }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-white font-weight-600 d-block font-size-16">
                                                    {{ $transaction['updated_at'] }}
                                                    </span>
                                                </td>
                                                <td>

                                                    <span class="text-white font-weight-600 d-block font-size-16">
                                                        {{ $transaction['amount'] }}
                                                    </span>
                                                </td>
                                                <td>

                                                    <span class="text-white font-weight-600 d-block font-size-16">
                                                        @if ($transaction['type'] == 'Student Fee')
                                                            <span class="badge badge-success-light badge-lg">Student Fee</span>
                                                        @elseif ($transaction['type'] == 'Employee Salary')
                                                            <span class="badge badge-warning-light badge-lg">Employee Salary</span>
                                                        @elseif ($transaction['type'] == 'Other Costs')
                                                            <span class="badge badge-danger-light badge-lg">Other Costs</span>
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($transaction['type'] == 'Student Fee')
                                                        <a href="{{ route('student.fee.view') }}" class="waves-effect waves-light btn btn-info btn-circle mx-5"><span class="mdi mdi-arrow-right"></span></a>
                                                    @elseif ($transaction['type'] == 'Employee Salary')
                                                        <a href="{{ route('account.salary.view') }}" class="waves-effect waves-light btn btn-info btn-circle mx-5"><span class="mdi mdi-arrow-right"></span></a>
                                                    @elseif ($transaction['type'] == 'Other Costs')
                                                        <a href="{{ route('other.cost.view') }}" class="waves-effect waves-light btn btn-info btn-circle mx-5"><span class="mdi mdi-arrow-right"></span></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                $count++;
                                            @endphp
                                        @else
                                            break;
                                        @endif
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    </div>
</div>

@endsection
