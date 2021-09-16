@extends('posts::layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-4/12 bg-white p-6 rounded-lg">
            <div class="divide-y panel panel-default">
                <div class="p-3 items-center">
                    Reset Password
                </div>
                <div class="panel-body">
                    @if (session('status'))
                    <div class="bg-green-500 p-4 rounded-lg mb-6 text-white text-center">
                        {{session('status')}}
                    </div>
                    @endif
                    <form action="{{route('password.email')}}" method="POST">
                        @csrf
                        <div class="p-4">
                            <label for="email" class="sr-only">Email</label>
                            <input type="text" name="email" id="email" placeholder="Your email"
                                   class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{old('email')}}">
                            @error('email')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                        </div>

                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Send link</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
