@extends('layouts.web')

@section('content')
    <div class="grid grid-cols-3 gap-4">
        <div class="p-8 bg-gray-200 col-span-1">
            <ul class="flex flex-col">
                <li class="font-medium text-sm text-gray-400 uppercase mb-4">Contenido</li>
                @foreach ($course->posts as $post)
                    <li class="flex items-center text-gray-400 uppercase mb-4">
                        {{ $post->name }}
                        @if ($post->free)
                            <span class="text-xs text-gray-500 font-semibold bg-gray-300 rounded-full ml-auto">Gratis</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="text-gray-700 col-span-2">
            <img src="{{ $course->image }}" alt="">
            <h2>{{ $course->name }}</h2>
            <p>{{ $course->description }}</p>
            <div class="flex mt-3">
                <img src="{{ $course->user->avatar }}" class="h-10 w-10 rounded-full mr-2">
                <div>
                    <p class="text-gray-500 text-sm">{{ $course->user->name }}</p>
                    <p class="text-gray-300 text-xs">{{ $course->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 my-8">
                @foreach ($course->similar() as $course)
                    <x-course-card :course="$course"/>
                @endforeach
            </div>
        </div>
    </div>

    <div class="text-center">
        <h1 class="text-3xl text-gray-700 mb-2 uppercase">Ultimos Cursos</h1>
        <h2 class="text-xl text-gray-600">Formate online como profesional en tecnologia</h2>
    </div>

    <livewire:course-list>
@endsection
