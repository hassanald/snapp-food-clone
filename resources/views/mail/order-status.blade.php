<h1>{{$mailData['title']}}</h1>
<p>Your order status: {{$mailData['order']->status->title}}</p>
<p>{{$mailData['order']->id}}</p>
<p>{{$mailData['order']->user->name}}</p>
<p>SnappFood</p>
