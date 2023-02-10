@extends('client.client_master')
@section('client')
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
<main class="profile-page">
  <section class="relative block h-[500px]">
    <div class="absolute top-0 w-full h-full bg-center bg-cover" style="
            background-image: url('{{ asset('upload/bg-1.jpg') }}');
          ">
    </div>
    <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-[70px]" style="transform: translateZ(0px)">
      <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
        <polygon class="text-gray-200 fill-white" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </section>
  <section class="relative py-16 bg-white">
    <div class="container mx-auto px-4">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
        <div class="px-6">
          <div class="flex flex-wrap justify-center">
            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
              <div class="relative">
                <img src="{{  !empty($user->image)  ? asset('upload/user_images/'.$user->image) : asset('/upload/user3-128x128.jpg')  }}" class="aspect-square shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-[150px]">
              </div>
            </div>
            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
              <div class="py-6 px-3 mt-32 sm:mt-0">
                @if (Auth::user() && Auth::user()->id == $user->id)
                    <a href={{ route('client.profile.edit', $user->id) }} class="bg-red-500 active:bg-red-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none cursor-pointer focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150" type="button">
                        Edit Profile
                    </a>
                @endif
              </div>
            </div>
            <div class="w-full lg:w-4/12 px-4 lg:order-1">
              <div class="flex justify-center py-4 lg:pt-4 pt-8">
                <div class="mr-4 p-3 text-center">
                  <span class="text-xl font-bold block uppercase tracking-wide text-gray-600">{{ $user->post()->count() }}</span><span class="text-sm text-gray-400">Posts</span>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-12 mb-10">
            <h3 class="text-4xl font-semibold leading-normal mb-2 text-gray-700">
              {{ $user->name }}
            </h3>
            <div class="text-sm leading-normal mt-0 mb-2 text-gray-400 font-bold uppercase">
              <i class="fas fa-user mr-2 text-lg text-gray-400"></i>
              {{ count($user->roles) > 0 ? $user->roles[0]->name : 'User' }}
            </div>
            <div class="mb-2 text-gray-600 mt-10">
              <i class="fa-solid fa-calendar-days mr-2 text-lg text-gray-400"></i>{{ $user->created_at->format('d M Y') }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection
