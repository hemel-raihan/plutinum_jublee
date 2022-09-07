<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invitation Card</title>
    <style>
        /* body {
  background: rgb(204,204,204); 
}
page[size="A4"] {
  background: white;
  width: 21cm;
  height: 29.7cm;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
@media print {
  body, page[size="A4"] {
    margin: 0;
    box-shadow: 0;
  }
} */

.container {
  position: relative;
  text-align: center;
  color: white;
}

/* Bottom left text */
.bottom-left {
  position: absolute;
  bottom: 8px;
  left: 16px;
}

/* Top left text */
.top-left {
  position: absolute;
  top: 8px;
  left: 16px;
}

/* Top right text */
.top-right {
  position: absolute;
  top: 8px;
  right: 16px;
}

/* Bottom right text */
.bottom-right {
  position: absolute;
  bottom: 8px;
  right: 16px;
}

/* Centered text */
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

img {
    display: block;
}

.thumbnail {
    position: relative;
    display: inline-block;
    margin-left: 30%
}

.photo {
    position: absolute;
    top: 52%;
    left: 50%;
    transform: translate( -50%, -50% );
    text-align: center;
    color: red;
    font-weight: bold;
}

.Name {
    position: absolute;
    top: 535px;
    left: 50%;
    transform: translate( -50%, -50% );
    text-align: center;
    color: black;
    font-weight: bold;
}

.phone {
    position: absolute;
    top: 565px;
    left: 49%;
    transform: translate( -50%, -50% );
    text-align: center;
    color: black;
    font-weight: bold;
}

.batch {
    position: absolute;
    top: 596px;
    left: 54%;
    transform: translate( -50%, -50% );
    text-align: center;
    color: black;
    font-weight: bold;
}

.FromNo {
    position: absolute;
    top: 596px;
    left: 11%;
    transform: translate( -50%, -50% );
    text-align: center;
    color: black;
    font-weight: bold;
}

.RegNo {
    position: absolute;
    top: 596px;
    left: 86%;
    transform: translate( -50%, -50% );
    text-align: center;
    color: black;
    font-weight: bold;
}

.QrCode {
    position: absolute;
    top: 712px;
    left: 88%;
    transform: translate( -50%, -50% );
    text-align: center;
    color: black;
    font-weight: bold;
}


    </style>
</head>
<body>
    {{-- <div class="container">
        <img src="{{asset('blank-card.jpg')}}" alt="Snow" style="width:100%;">
        <div class="bottom-left">Bottom Left</div>
        <div class="top-left">Top Left</div>
        <div class="top-right">Top Right</div>
        <div class="bottom-right">Bottom Right</div>
        <div class="centered">Centered</div>
    </div> --}}

    <div id="box-search">
        <div class="thumbnail">
            <img src="{{asset('blank-card.jpg')}}" width="600" height="800" alt="">
            <div class="photo">
                <img src="{{asset('uploads/postphoto/'.$member->photo)}}" style="border-radius: 50%;" height="210" width="210" alt="">
            </div>
            <div class="Name">
                <h2>{{$member->name}}</h2>
            </div>
            <div class="phone">
                <h3>{{$member->phone}}</h3>
            </div>
            <div class="batch">
                <h3>{{$member->passing_year}}</h3>
            </div>
            <div class="FromNo">
                <h3>0{{$member->id}}</h3>
            </div>
            <div class="RegNo">
                <h3>0{{$member->id}}</h3>
            </div>
            <div class="QrCode">
                {!! QrCode::size(100)->generate('
                website: https://demo.platinumjubilee2023.com/
                ') !!}
            </div>
            
        </div>
    </div>


</body>
</html>