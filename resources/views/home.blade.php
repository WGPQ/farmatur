@extends('layouts.app')

@section('content')
<div class="container" style="width:100%;"> 
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="https://mdbootstrap.com/img/Photos/Slides/img%20(35).jpg" alt="Los Angeles" style="width:100%;">
      </div>

      <div class="item">
        <img src="https://www.ttandem.com/media/geolocalizacion-1.jpg" alt="Chicago" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="https://northcentralus1-mediap.svc.ms/transform/thumbnail?provider=spo&inputFormat=png&cs=fFNQTw&docid=https%3A%2F%2Futneduec-my.sharepoint.com%3A443%2F_api%2Fv2.0%2Fdrives%2Fb!zFRO55SKYEKgMq3-L1wIC38RsrjJbgxHhHveC0BHRj1CH3zbF-MbQqxIdUVip761%2Fitems%2F01ULAD45HXLUOCC4RCJFF36M7X4O6FVAUG%3Fversion%3DPublished&encodeFailures=1&ctag=%22c%3A%7B211C5DF7-2272-4B49-BF33-F7E3BC5A8286%7D%2C2%22&srcWidth=&srcHeight=&width=1365&height=589&action=Access" alt="New york" style="width:100%;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

@endsection