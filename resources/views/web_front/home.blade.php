@extends('web_front.mainbase')

@section('title')
HOME
@endsection

@section('content')
    <div class="col-sm-8 text-left"> 
      <h2>Introduction</h2>
<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ac mollis sem. Integer in aliquet enim. Mauris rhoncus, quam quis sollicitudin ornare, dui neque cursus eros, a eleifend nisi est et neque. Morbi ornare ante sit amet elit luctus, ac ullamcorper nunc sollicitudin. Mauris gravida, est in scelerisque pretium, nisl dui feugiat est, eget pharetra ante urna ut felis. Integer bibendum enim quis eleifend sollicitudin. Sed non facilisis dolor. Vivamus euismod nisi imperdiet, feugiat lacus id, feugiat nibh. Curabitur viverra commodo libero eget faucibus. Sed ac ex enim. Aliquam id erat a diam porttitor egestas. Nam ac feugiat ipsum. Sed id felis at felis mollis malesuada. Nulla mollis ex at congue congue. Cras nec ultricies lacus. Proin vehicula facilisis mauris sed volutpat.</p>

<p>Suspendisse vel gravida nibh. Aenean interdum ligula ac augue placerat, sit amet auctor tortor suscipit. Fusce ultricies commodo sapien nec accumsan. Phasellus efficitur porta tortor, quis vulputate justo mattis vel. Sed at odio interdum, lacinia tellus et, eleifend tortor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus imperdiet justo nunc, ut congue nibh tincidunt a. Maecenas auctor tempor diam, a aliquet massa sodales sed. Quisque accumsan non tortor nec rhoncus. Nullam velit augue, elementum varius bibendum ac, fermentum at lectus. Aenean pellentesque malesuada nulla nec vulputate. Vivamus diam libero, rhoncus ultrices lacus sed, lacinia semper ex. Etiam scelerisque sit amet mi sit amet lobortis. Sed semper eleifend congue.</p>

<p>Quisque tristique pulvinar nunc sed viverra. Vivamus et laoreet lacus. Maecenas at sem sollicitudin lectus maximus tristique sit amet et nisl. Praesent ultrices justo diam, in venenatis ipsum sodales tempus. Quisque enim enim, feugiat a justo nec, interdum posuere ex. Nunc tempus eleifend odio. Quisque convallis massa lorem, et viverra mauris aliquam vehicula. In hac habitasse platea dictumst. Nunc dapibus hendrerit sodales. Morbi non quam magna. Aenean luctus lectus quis pharetra bibendum. Nam varius, elit euismod venenatis lacinia, nulla felis iaculis nibh, placerat commodo ipsum justo et tellus. </p>

      <hr>
      <h3>Important Info</h3>
      <p style="background-color:#EEEEEE;color: black">Suspendisse vel gravida nibh. Aenean interdum ligula ac augue placerat, sit amet auctor tortor suscipit. Fusce ultricies commodo sapien nec accumsan. Phasellus efficitur porta tortor, quis vulputate justo mattis vel.</p>
      <p style="background-color:#EEEEEE;color: black">Morbi non quam magna. Aenean luctus lectus quis pharetra bibendum. Nam varius, elit euismod venenatis lacinia, nulla felis iaculis nibh, placerat commodo ipsum <strong>justo@et.tellus.</strong></p>
      <a href="{{url('/student')}}" class="btn btn-lg btn-danger" style="width: 100%">Registered User</a>
      <br/><br/>
      <a href="{{url('/student/register')}}" class="btn btn-lg btn-warning" style="width: 100%">New Application</a>
      <br/>
    </div>
@endsection
