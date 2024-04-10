<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>All Community Head of Family 
                                <a href="{{ url('family_head/add'); }}" style="float: right;" class="btn btn-sm btn-info">Add New Head Member</a>
                            </h5>
                        </div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Birthdate</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">address</th>
                                <th scope="col">pincode</th>
                                <th scope="col">marital status</th>
                                <th scope="col">Age</th>
                                <th scope="col">city</th>
                                <th>Total Members</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($family_head as $k => $item)
                                <tr>
                                    <td scope="row">{{ $family_head->firstItem()+$loop->index}}</td>
                                    <td>{{$item->name}} {{$item->surname}}</td>
                                    <td>{{$item->birthdate}}</td>
                                    <td>{{$item->mobile_no}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{$item->pincode}}</td>
                                    <td>{{$item->marital_status}}</td>
                                    <td>{{ $year = (date('Y') - date('Y',strtotime($item->birthdate)))}}</td>
                                    <?php $cityName = DB::table('cities')->where('id_city',$item->cityId)->first();
                                    ?>
                                    <td>{{$cityName->city}}</td>
                                    <td>
                                        <?php $totalMembers = DB::table('family_members')->where('family_head_id',$item->id)->get();
                                        ?>
                                        <a href="{{ url('head/memberlist/'.$item->id); }}" data-toggle="modal" data-target="#yourModal-{{$item->id}}" class="btn btn-sm btn-success">{{ $totalMembers->count() }}</a>

                                        <!-- /**
                                        Modal to display Family Members
                                        **/ -->
                                        <div class="modal fade" id="yourModal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <?php
                                                        if($totalMembers->count() > 0){
                                                    ?>
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Family Members of {{$item->name}} {{$item->surname}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">First</th>
                                                                    <th scope="col">Last</th>
                                                                    <th scope="col">Birthdate</th>
                                                                    <th scope="col">Marital Status</th>                            
                                                                    <th scope="col">Education</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($totalMembers as $k => $family_member)
                                                                <tr>
                                                                    <td scope="row">{{ $family_member->id}}</td>
                                                                    <td>{{$family_member->name}}</td>
                                                                    <td>{{$family_member->surname}}</td>
                                                                    <td>{{$family_member->birthdate}}</td>
                                                                    <td>{{$family_member->marital_status}}</td>
                                                                    <td>{{$family_member->education}}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <?php }else{ ?>
                                                        <div class="modal-body">
                                                            <h5 class="text-center">No Records Founds</h5>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $family_head->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
