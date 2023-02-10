@extends('errors.error_master')
@section('error')
    <section class="error-page h-p100 bg-gradient-primary">
		<div class="container h-p100">
		  <div class="row h-p100 align-items-center justify-content-center text-center">
			  <div class="col-lg-7 col-md-10 col-12">
				  <div class="b-double border-white rounded30">
					  <h1 class="text-white font-size-180 font-weight-bold error-page-title"> 403</h1>
					  <h1 class="text-white">Forbidden !</h1>
					  <h3 class="text-white">user does not have the right permission!</h3>
				  </div>
			  </div>
		  </div>
		</div>
	</section>
@endsection
