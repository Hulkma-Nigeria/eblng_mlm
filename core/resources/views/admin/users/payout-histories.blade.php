@extends('admin.layouts.app')

@section('panel')
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive table-responsive-xl">
                <table class="table align-items-center table-light">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">PV</th>
                            <th scope="col">Narration</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse($payouts as $payout)
                            <tr>
                                <td>{{$payout->user->firstname. ' '.$payout->user->lastname}}</td>
                                <td>{{$payout->pv}}</td>
                                <td>{{$payout->narration}}</td>
                                <td>{{$payout->status ? 'Success': 'Failed'}}</td>
                                <td>{{$payout->created_at}}</td>
                            </tr>
                        @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">No histories yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
