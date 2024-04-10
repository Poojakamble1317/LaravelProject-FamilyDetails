<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- __('Community Family Members') --}}
        </h2>
    </x-slot> -->
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="">Community Family Members
                            <a href="{{ url('family_member/add'); }}" style="float: right;" class="btn btn-sm btn-info">Add Family Member</a>
                            </h5>
                        </div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Birthdate</th>
                                <th scope="col">Marital Status</th>                            
                                <th scope="col">Education</th>
                                <th scope="col">Head of the Family</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($family_member as $k => $item)
                                <tr>
                                    <td scope="row">{{ $family_member->firstItem()+$loop->index}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->surname}}</td>
                                    <td>{{$item->birthdate}}</td>
                                    <td>{{$item->marital_status}}</td>
                                    <td>{{$item->education}}</td>
                                    <td>
                                        <?php $totalMembers = DB::table('family_head_models')->where('id',$item->family_head_id)->get();?>
                                        @foreach ($totalMembers as $head_of_family) 
                                            {{ $head_of_family->name." ".$head_of_family->surname }} 
                                        @endforeach 
                                    </td>
                                    <td>
                                        <a href="{{ url('head/edit/'.$item->id); }}" class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ url('softdelete/head/'.$item->id); }}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $family_member->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
