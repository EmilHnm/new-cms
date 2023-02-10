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
        <polygon class="text-gray-200 fill-gray-200" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </section>
  <section class="relative py-16 bg-gray-200">
    <form action={{ route('client.profile.update.data', $user->id) }} method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container mx-auto px-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
                <div class="px-6">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                            <div class="relative">
                                <img id="profile_image" src="{{  !empty($user->image)  ? asset('upload/user_images/'.$user->image) : asset('/upload/user3-128x128.jpg')  }}" class="aspect-square Sshadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-[150px]">
                                <input id="image" name='image' type="file" class="rounded-full align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 w-32 h-32 opacity-0">
                            </div>
                        </div>
                        <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                            <div class="py-6 px-3 mt-32 sm:mt-0">
                                <button type="submit" class="bg-red-500 active:bg-red-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none cursor-pointer focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150" type="button">
                                    Save Profile
                                </button>
                            </div>
                        </div>
                        <div class="w-full lg:w-4/12 px-4 lg:order-1">
                        </div>
                    </div>
                    <div class="text-center mt-12 mb-10">
                        <input name="name" type="text" class="text-2xl font-semibold leading-normal mb-2 text-gray-700 text-center" value=" {{ $user->name }}">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action={{ route('client.profile.update.password', $user->id) }} method="POST">
        @csrf
        <div class="container mx-auto px-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg">
                <div class="px-6">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                        </div>
                        <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                            <div class="py-6 px-3 mt-32 sm:mt-0">
                                <button type="submit" class="bg-red-500 active:bg-red-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none cursor-pointer focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150" type="button">
                                    Save Password
                                </button>
                            </div>
                        </div>
                        <div class="w-full lg:w-4/12 px-4 lg:order-1 flex justify-center items-center">
                            <div class="text-2xl font-semibold leading-normal mb-2 text-gray-700 text-center">
                                Change Password
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-12 mb-10">
                        <label for="password_old" class="block text-2xl font-semibold leading-normal mb-2 text-gray-700 text-center">Old Password</label>
                        <input name="password_old" type="password" class="text-2xl font-semibold leading-normal mb-2 text-gray-700 text-center" value="">
                        <label for="password" class="block text-2xl font-semibold leading-normal mb-2 text-gray-700 text-center">New Password</label>
                        <input name="password" type="password" class="text-2xl font-semibold leading-normal mb-2 text-gray-700 text-center" value="">
                        <label for="password_confirmation" class="block text-2xl font-semibold leading-normal mb-2 text-gray-700 text-center">Confirm new Password</label>
                        <input name="password_confirmation" type="password" class="text-2xl font-semibold leading-normal mb-2 text-gray-700 text-center" value="">
                    </div>
                </div>
            </div>
        </div>
    </form>
  </section>
</main>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', ()=>{
        const image = document.getElementById('image');
        const profile_image = document.getElementById('profile_image');
        image.addEventListener('change', (e)=>{
            const reader = new FileReader();
            reader.onload = (e)=>{
                profile_image.src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endsection
