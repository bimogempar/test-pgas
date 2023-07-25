@extends('layout')

@section('content')
    <div class="flex justify-center items-center min-h-screen">
        <form method="POST" action="{{ route('doLogin') }}" class="flex flex-col gap-4 w-1/2 bg-gray-100 p-4 rounded-lg">
            @csrf
            <div class="text-xl font-medium text-center">Login</div>
            <div class="flex flex-col gap-2">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="bg-white border-2 p-2 rounded-lg" required>
            </div>
            <div class="flex flex-col gap-2">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="bg-white border-2 p-2 rounded-lg" required>
            </div>
            <a href="{{ route('register') }}" class="text-blue-500 underline underline-offset-auto">Register ?</a>
            <div class="flex justify-end">
                <button type="submit" class="p-2 rounded-lg bg-blue-500 text-white w-24">Login</button>
            </div>
        </form>
    </div>
    @error('errorLogin')
        <div class="text-red-500">{{ $message }}</div>
    @enderror
@endsection
