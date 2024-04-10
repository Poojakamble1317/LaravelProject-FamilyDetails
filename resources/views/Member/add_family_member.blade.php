<x-app-layout>
  <x-slot name="header">
      
  </x-slot>

  <div class="py-12">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                    <div class="card" >
                        <div class="card-header">Add Family Member</div>
                        <form action="{{ route('store.family_member') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{--
                                name
                                birthdate
                                marital status - is married- if married - wedding date
                                wedding date
                                education
                                photo
                            --}}
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
                                        <label for="name">Surname</label>
                                        <input type="text" class="form-control" id="surname" name="surname" placeholder="SurName">
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
                                </div>
                                <div class="col-md-5">
                                    {{-- familyHead --}}
                                    <div class="form-group margin_10">
                                        <label for="family_head_id">Family Head</label>
                                        <select class="form-control" name="family_head_id"  id="family_head_id">
                                            <option selected>Choose...</option>
                                             
                                            @foreach ($familyHead as $val)
                                                <option value="{{ $val->id }}"> {{ $val->name."".$val->surname }}</option>
                                            @endforeach                        
                                        </select>
                                        @error('family_head_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group margin_10 wedding_date_div" style="display: none;"
                                        <label for="name">Wedding date</label>
                                        <input type="date" class="form-control" id="wedding_date" name="wedding_date" placeholder="Wedding date">
                                        @error('wedding_date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group margin_10">
                                        <label for="exampleFormControlSelect2">Education</label>
                                        <input type="text" class="form-control" id="education" placeholder="Education" name="education" >
                                        @error('education')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group margin_10">
                                        <label for="name">Photo</label>
                                        <input type="file" class="form-control" id="photo" name="photo" placeholder="Photo">
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

        
    });
</script>