<!DOCTYPE html>
<html>

@extends('layout')

@section('content')
    <div class="flex justify-center items-center min-h-screen">
        <form method="POST" action="{{ route('doRegister') }}" class="flex flex-col gap-4 w-1/2 bg-gray-100 p-4 rounded-lg">
            @csrf
            <div class="text-xl font-medium text-center">Register</div>
            <div class="flex flex-col gap-2">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" class="bg-white border-2 p-2 rounded-lg" required>
            </div>

            <div class="flex flex-col gap-2">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="bg-white border-2 p-2 rounded-lg" required>
            </div>

            <div class="flex flex-col gap-2">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="bg-white border-2 p-2 rounded-lg" required>
            </div>

            <div class="flex flex-col gap-2">
                <label for="role">Role</label>
                <select name="role" id="role" class="bg-white border-2 p-2 rounded-lg" required>
                    <option value="admin" selected>Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <a href="{{ route('login') }}" class="text-blue-500 underline underline-offset-auto">Login ?</a>
            <div class="flex justify-end">
                <button type="submit" class="p-2 rounded-lg bg-blue-500 text-white w-24">Register</button>
            </div>
        </form>
    </div>
    @error('errorLogin')
        <div class="text-red-500">{{ $message }}</div>
    @enderror
@endsection
