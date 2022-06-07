<x-home-master>
   @section('contactus')
        <div style="height:140vh">

   <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->


   <div class="container">
       <div class="p-3 py-5">
       <div class="card-body">

           @if(session('message-sent'))
               <div class="alert alert-success alert-dismissible fade show">{{session('message-sent')}}
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button></div>
           @endif
           <div class="card shadow-lg">
           <div class="row justify-content-center p-2 mt-4">
				<div class="col-md-9">
					<div class="wrapper">
           <div class="row no-gutters">
               <div class="col-md-6">
               <div class="contact-wrap">
           <form action="{{route('contact.send')}}" method="post" enctype="multipart/form-data">
               @csrf

               <div class="mt-3">
                   <label for="name">Name</label>
                   <input type="text" name="name" class="form-control">
               </div>
               <div class="mb-3">
                   <label for="name">Email</label>
                   <input type="email" name="email" class="form-control">
               </div>
               <div class="mb-3">
                   <label for="msg">Message</label>
                   <textarea  name="msg" class="form-control" style="height: 10rem;"></textarea>
               </div>


               <div class="row mb-3">
                            <div class="col-ms-6 offset-ms-3 text-ms-center">
                                <button type="submit" class="btn btn-warning" style="width: 100%"><i  class="fa fa-paper-plane fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Send Message') }}
                                </button>


                                 </div>
                            </div>
           </form>
               </div>
           </div>

               <div class="col-md-6 d-flex">
								<div class="  p-2 mt-4 text-justify">
									<h3>Contact us</h3>
									<p class="mb-4">Please let me know if you have any comments or questions. We are open for any suggestion or concerns.Thank you very much for your time.</p>
				        	<div class="dbox w-100 d-flex align-items-start">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span style="margin: 1em;" class="fa fa-map-marker fa-fw mr-2 text-gray-400"></span>Address: Technological of the Philippines of Manila, Ayala Blvd, Ermita, Manila, Philippines
				        		</div>

				          </div>
                          <br>
				        	<div class="dbox w-100 d-flex align-items-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span style="margin: 1em;" class="fa fa-phone fa-sm fa-fw mr-2 text-gray-400"></span>Phone:(02) 8125 2156
				        		</div>

				          </div>
                          <br>
				        	<div class="dbox w-100 d-flex align-items-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
                                <span style="margin: 1em;" class="fa fa-envelope fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></span>Email:tupkms2022@gmail.com
				        		</div>
				          </div>

				          </div>
			          </div>

           </div>
       </div>
       </div>
   </div>
   </div>
       </div>
       </div>
   </div>
   </div>

    @endsection
</x-home-master>
