@extends('layouts.app')
@section('content')
    <router-link to='/'>Home</router-link>
    <router-link to='/about'>About</router-link>
    <router-link to='/login'>Login</router-link>
    <router-link to='/register'>Register</router-link>
    <router-view></router-view>
@endsection