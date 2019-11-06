@extends('layouts.app')

@section('content')
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
                <div class="panel-body">
                    <a href="{{route('create.form')}}">Create form</a>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                      @foreach($users as $user)
                      <tr>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>View</td>
                      </tr>
                      @endforeach

                    </table>
                    {{$users->render()}}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

  var deferredPrompt;
  if('serviceWorker' in navigator){
    navigator.serviceWorker
    .register('/sw.js')
    .then(function(){
      console.log("service Worker registered");
    });
  } 

  window.addEventListener('beforeinstallprompt',function(event){
    console.log('beforeinstallprompt fired');
    event.preventDefault();
    deferredPrompt = event;
    return false;
  });
  var promise = new Promise(function(resolve,reject){
    setTimeout(function(){
      reject({code:500,message:"Something Wrong"});
    },3000);
  });

  promise.then(function(res){
    return res;
  }).then(function(newRes){
    console.log(newRes);
  }).catch(function(err){
    console.log(err.code+"  "+err.message);
  });
</script>
@endsection
