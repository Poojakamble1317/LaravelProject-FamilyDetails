<x-app-layout>
  <!-- <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{-- __('Family Head') --}}
      </h2>
  </x-slot> -->

  <div class="py-12">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                    <div class="card" >
                        <div class="card-header">Add Family Head</div>
                        <form action="{{ route('store.family_head') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- //name,surname,
                            // birthdate > 21 acceptable
                            //mobile no
                            //address
                            //state - dropdown
                            //city - dropdown
                            //pincode
                            //marital status radio - if married - wedding date
                            //hobbies - add hobby button
                            //photo --}}
                            <div class="row">
                                <div class="col-md-5">
                                <div class="form-group margin_10">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"  placeholder="Name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group margin_10">
                                    <label for="name">SurName</label>
                                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname">
                                    @error('surname')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group margin_10">
                                    <label for="name">Birthdate</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Birthdate">
                                    @error('birthdate')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group margin_10">
                                    <label for="name">Mobile No</label>
                                    <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile Number">
                                    @error('mobile_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group margin_10">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="2"></textarea>
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group margin_10">
                                    <label for="name">Pincode</label>
                                    <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Pincode Number">
                                    @error('pincode')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group margin_10">
                                        <label for="countries">Country</label>
                                        <select class="form-control" id="countries" name="countryId">
                                        @foreach ($data['countries'] as $item)
                                        <option value="{{ $item->country_id }}">{{ $item->country_name }} - {{  $item->country_code  }}</option>
                                        @endforeach
                                        </select>
                                        @error('countryId')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group margin_10">
                                        <label for="state">State</label>
                                        <select class="form-control" id="state" name="stateId">
                                            <option selected>Choose...</option>
                                        </select>
                                        @error('stateId')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group margin_10">
                                        <label for="city">City</label>
                                        <select class="form-control" id="city" name="cityId">
                                            <option selected>Choose...</option>
                                        </select>
                                        @error('cityId')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group margin_10">
                                        <label for="marital_status">Marital Status</label>
                                        <select class="form-control" name="marital_status"  id="marital_status">
                                            <option selected>Choose...</option>
                                            <option>Married</option>
                                            <option>Unmarried</option>
                                        </select>
                                        @error('marital_status')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group margin_10 wedding_date_div" style="display: none;">
                                        <label for="name">Wedding date</label>
                                        <input type="date" class="form-control" id="wedding_date" name="wedding_date" placeholder="Wedding date">
                                        @error('wedding_date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group margin_10">
                                        <label for="hobbies">Hobbies</label>
                                        <div class="input-group mb-3">
                                        <select class="custom-select" id="hobbies" name="hobbies">
                                            <option selected>Choose...</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        @error('hobbies')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="form-group margin_10">
                                        <label for="name">Photo</label>
                                        <input type="file" class="form-control" name="photo" id="photo" placeholder="Photo" >
                                        @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </div>

                            </div>

                        </form>
                    </div>
              </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">

    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#marital_status').on('change',function(){
            if(this.value === 'Married'){
                $('.wedding_date_div').css('display','');
            }else{
                $('.wedding_date_div').css('display','none');
            }
        });

        $('#state').on('change',function(){
            var stateId = this.value;
            $.post('getCities',{stateId:stateId},function(data){
                if($.trim(data)){
                    $('#city').html(data);
                }
            });
        });

        $('#countries').on('change',function(){
            alert();
            var countryId = this.value;
            $.post('getState',{countryId:countryId},function(data){
                if($.trim(data)){
                    $('#state').html(data);
                }
            });
            $.ajax({
                url:'./FamilyDataController/getState',
                type:'GET',
                data:{countryId = countryId},
                processData: false,
                contentType: false,
                success:function(response){
                    console.log(response)
                }
            });
        })

    });
</script>
