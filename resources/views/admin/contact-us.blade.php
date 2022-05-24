<x-home-master>
   @section('content')

       <div class="card-body">

           @if(session('message-sent'))
               <div class="alert alert-success alert-dismissible fade show">{{session('message-sent')}}
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button></div>
           @endif
           <form action="{{route('contact.send')}}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                   <label for="name">Name</label>
                   <input type="text" name="name" class="form-control">
               </div>
               <div class="form-group">
                   <label for="name">Email</label>
                   <input type="email" name="email" class="form-control">
               </div>
               <div class="form-group">
                   <label for="msg">Message</label>
                   <textarea  name="msg" class="form-control"></textarea>
               </div>
               <button type="submit" class="btn btn-primary float-right">Submit</button>
           </form>
       </div>

    @endsection
</x-home-master>
