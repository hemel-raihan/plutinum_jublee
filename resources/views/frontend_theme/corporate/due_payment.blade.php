@extends('frontend_theme.corporate.front_layout.app')

@section('styles')

@endsection

@section('content')


                <div class="single-post mb-0" >

                    <div class="container-sm">


                        <div class="center mb-5" style="margin-top: 20px">
                            <h1 class="fw-bold display-4">Due Payment</h1>
                        </div>

                        <div class="row" id="member_reg" style="width: 50%; margin-left: 25%">

                            <form action="{{route('member.registration.search')}}" method="POST" enctype="multipart/form-data">
                               @csrf

                                <div class="form-group">
                                    <label for="member_phone">ফোন নম্বর (<span style='color: red;'>*</span>) </label>
                                    <input type="number" id="member_phone" name="phone" class="form-control @error('phone') is-invalid @enderror" />
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit"  class="btn w-100 text-white bg-color rounded-3 py-3 fw-semibold text-uppercase mt-2">Search</button>

                            </form>

                        </div>

                    </div>
                </div>


@endsection()

@section('scripts')

@endsection
