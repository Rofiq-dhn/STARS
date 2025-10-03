@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/js/app.js'])
</head>
    <body>
         <h1>Dashboard Admin</h1>
            <div>
                <h2>Selamat Datang, Admin! 👋</h2>
                <p> Gunakan menu di samping untuk mengelola data sistem pembayaran sekolah.</p>
            </div>
        @endsection
    </body>
</html>

