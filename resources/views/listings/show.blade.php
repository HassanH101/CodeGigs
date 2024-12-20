<!---
title: Listing View
description: This is the view for displaying a single job listing.
---
-->
@extends('layout')

@section('content')
    <!-- Back button -->
    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back</a>

    <!-- Job listing card -->
    <div class="mx-4">
        <x-card class="p-1">
            <!-- Job listing image -->
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mr-6 mb-6" src="{{ asset('images/no-image.png') }}" alt="" />
                <!-- Job listing title -->
                <h3 class="text-2xl mb-2">{{ $listing->title }}</h3>
                <!-- Job listing company -->
                <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
                <!-- Job listing tags -->
                <x-listing-tags :tagsCsv='$listing->tags' />
                <!-- Job listing location -->
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{ $listing->location }}
                </div>
                <!-- Job listing description -->
                <div class="text-lg space-y-6">
                    {{ $listing->description }}
                    <!-- Contact employer button -->
                    <a href="mailto:{{ $listing->email }}"
                        class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                            class="fa-solid fa-envelope"></i> Contact Employer</a>
                    <!-- Visit website button -->
                    <a href="{{ $listing->website }}" target="_blank"
                        class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i class="fa-solid fa-globe"></i>
                        Visit Website</a>
                </div>
            </div>
        </x-card>
    </div>
@endsection
