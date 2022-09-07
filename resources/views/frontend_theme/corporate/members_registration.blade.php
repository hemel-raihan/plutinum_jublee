@extends('frontend_theme.corporate.front_layout.app')

@section('styles')

@endsection

@section('content')


                <div class="single-post mb-0" >

                    <div class="container-sm">


                        <div class="center mb-5" style="margin-top: 20px">
                            <h1 class="fw-bold display-4">Member Registration Form</h1>
                        </div>

                        <div class="row" id="member_reg" style="width: 50%; margin-left: 25%">

                            <form action="{{route('member.registration')}}" method="POST" enctype="multipart/form-data">
                               @csrf

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="passingYear">Passing Year</label>
                                    <select id="passingYear" name="passing_year" class="form-control">
                                    <option selected>Choose...</option>
                                    @foreach ($members as $key)
                                    <option value="{{ $key->year_pass }}">{{ $key->year_pass }}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="memberName">Select Your Name</label>
                                    <select id="memberName" name="member_name" class="form-control">
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="member_photo">Upload your photo: </label>
                                    <input type="file" id="member_photo" name="member_photo" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="member_phone">Phone Number: </label>
                                    <input type="number" id="member_phone" name="member_phone" class="form-control" />
                                </div>

                                <p style="text-align: center">for aditional extra guest</p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="number" id="guest_number" name="guest_number" placeholder="Add guest?" class="form-control"/>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <a id="add_guest" class="btn btn-primary ">add guest</a>
                                    </div> --}}
                                </div>
                                </br>
                                </br>
                                </br>

                                <div  id="dd_handle"></div>

                                <div style="border-style: dotted; padding: 10px;" class="row">
                                    <p style="text-align: center; color: red;">Total Fee</p>
                                    <div class="col-md-4">
                                        <label for="member_phone">Member Fee: </label>
                                    </div>
                                    <div class="col-md-4">
                                        <p>1 * 2000</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>2000</p>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="member_phone">Guest Fee: </label>
                                    </div>
                                    <div class="col-md-4">
                                        <p id="guestNum"></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p id="guest_fee"></p>
                                    </div>
                                    <hr>
                                    <div class="col-md-4">
                                        <label for="member_phone">Total Fee: </label>
                                    </div>
                                    <div class="col-md-4">
                                        <p id="totalNum"></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p id="total_fee"></p>
                                    </div>
                                </div>

                                <button type="submit"  class="btn w-100 text-white bg-color rounded-3 py-3 fw-semibold text-uppercase mt-2">Register</button>

                            </form>

                        </div>

                    </div>
                </div>


@endsection()

@section('scripts')

<script>
     $('#passingYear').change(function(){
    var year = $(this).val(); 
    var url = '{{ route("member.name", ":year") }}';
    url = url.replace(':year', year);
    if(year){
        $.ajax({
           type:"GET",
           url: url,
           success:function(res){               
            if(res){
                $("#memberName").empty();
                $("#memberName").append('<option>Select</option>');
                $.each(res.memberName,function(key,value){
                    $("#memberName").append('<option value="'+value.id+'">'+value.name+' - ('+value.fathers_name+')</option>');
                });
           
            }else{
               $("#memberName").empty();
            }
           }
        });
    }else{
        $("#memberName").empty();
    }      
   });

$('#total_fee').text(2000);

// $("#guest_number").change(function(){
//   alert("The text has been changed.");
// });

$("#guest_number").on('keyup change', function(){
// $('#add_guest').click(function(){

var guest_number = $('#guest_number');

var guestFee = 1000*guest_number.val()

var total = guestFee+2000;

 $('#guestNum').text(guest_number.val()+' * '+'1000');

 $('#guest_fee').text(guestFee);

 $('#total_fee').text(total);

$('#dd_handle').empty()

for (var i=0, n=guest_number.val(); i<n;i++)
{
    
        $('#dd_handle').append(`<div style="border-style: solid; margin-bottom: 20px; padding: 5px;">
                                    <p style="text-align: center;">add no `+(i+1)+` guest</p>
                                    <div class="form-group">
                                        <label for="memberName">Guest Name</label>
                                        <input type="text" name="guest_name[]" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="memberName">Guest Age</label>
                                        <input type="number" name="guest_age[]" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="memberName">Guest Gender</label>
                                        <select  name="guest_gender[]" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="memberName">Guest Relation</label>
                                        <select  name="guest_relation[]" class="form-control">
                                            <option value="">Select Relation</option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Husband">Husband</option>
                                            <option value="Wife">Wife</option>
                                            <option value="Child">Child</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="memberName">Guest Photo</label>
                                        <input type="file" name="guest_photo[]" class="form-control" />
                                    </div>
                               </div>
                              
                              `);

            iziToast.success({
                title: 'Success',
                message: 'Please fill up the guest form',
            });
    
}

});

</script>

@endsection
