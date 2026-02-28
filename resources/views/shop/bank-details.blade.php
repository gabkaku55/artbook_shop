@extends('layouts.app')

@section('content')
<div class="py-20 bg-gray-950 min-h-screen flex items-center justify-center">
    <div class="max-w-xl w-full bg-gray-900 p-8 rounded-2xl border border-gray-800">
        <h1 class="text-2xl font-bold text-white mb-4">{{ __('messages.bank_details_title') }}</h1>
        <p class="text-gray-400 text-sm mb-6">{{ __('messages.bank_details_desc') }}</p>

        <div class="bg-gray-800/50 p-4 rounded-xl border border-gray-700 text-left mb-6 space-y-2 text-sm">
            <div><span class="text-gray-500">IBAN:</span> <span class="text-white">{{ $bankDetails['iban'] }}</span></div>
            <div><span class="text-gray-500">@if(app()->getLocale() == 'uk') Отримувач @elseif(app()->getLocale() == 'en') Payee @else Empfänger @endif:</span> <span class="text-white">{{ $bankDetails['receiver'] }}</span></div>
            <div><span class="text-gray-500">ЄДРПОУ:</span> <span class="text-white">{{ $bankDetails['edrpou'] }}</span></div>
            <div><span class="text-gray-500">@if(app()->getLocale() == 'uk') Призначення @elseif(app()->getLocale() == 'en') Purpose @else Verwendungszweck @endif:</span> <span class="text-white">{{ $bankDetails['purpose'] }}</span></div>
        </div>

        <form action="{{ route('checkout.bank-details') }}" method="POST" enctype="multipart/form-data" class="mb-6">
            @csrf
            <div class="mb-4">
                <input type="file" name="receipt" id="receipt" accept="image/*,.pdf" required class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-gray-700 file:text-white">
                @error('receipt') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700 transition">{{ __('messages.send_receipt') }}</button>
        </form>

        @if(session('error'))
            <p class="text-red-500 text-sm mb-4">{{ session('error') }}</p>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <a href="{{ route('profile') }}" class="bg-gray-800 text-gray-300 py-3 rounded-xl font-bold text-center hover:bg-gray-700 transition">{{ __('messages.order_history') }}</a>
            <a href="{{ route('home') }}" class="bg-gray-800 text-gray-300 py-3 rounded-xl font-bold text-center hover:bg-gray-700 transition">{{ __('messages.back_to_home') }}</a>
        </div>
    </div>
</div>
@endsection
