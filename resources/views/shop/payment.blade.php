@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-950 min-h-screen flex items-center justify-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="max-w-xl mx-auto bg-gray-900 rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-800">
            <div class="bg-indigo-600 p-10 text-white text-center">
                <h1 class="text-3xl font-black uppercase tracking-tighter">{{ __('messages.payment_secure_title') }}</h1>
                @php
                    $currency = session('currency', 'UAH');
                    $amountRaw = number_format($order->total_price, 2);
                    $formattedAmount = match ($currency) {
                        'USD' => '$' . $amountRaw,
                        'EUR' => '€' . $amountRaw,
                        default => $amountRaw . ' грн',
                    };
                @endphp
                <p class="mt-3 font-bold opacity-80 uppercase tracking-widest text-xs">
                    {{ __('messages.payment_order_line', ['id' => $order->id, 'amount' => $formattedAmount]) }}
                </p>
            </div>
            
            <form action="{{ route('payment', $order->id) }}" method="POST" class="p-10 space-y-8">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-3">{{ __('messages.card_number') }}</label>
                        <div class="relative">
                            <input type="text" name="card_number" value="{{ old('card_number') }}" placeholder="0000 0000 0000 0000" maxlength="16" class="w-full px-5 py-4 bg-gray-800 border-gray-700 rounded-2xl text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition @error('card_number') border-red-500 @enderror" required>
                            <i class="fas fa-credit-card absolute right-5 top-5 text-gray-600"></i>
                        </div>
                        @error('card_number') <p class="text-red-500 text-xs mt-2 font-bold uppercase tracking-wide">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-3">{{ __('messages.card_expiry') }}</label>
                            <input type="text" name="expiry" value="{{ old('expiry') }}" placeholder="MM/YY" maxlength="5" class="w-full px-5 py-4 bg-gray-800 border-gray-700 rounded-2xl text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition @error('expiry') border-red-500 @enderror" required>
                            @error('expiry') <p class="text-red-500 text-xs mt-2 font-bold uppercase tracking-wide">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-3">{{ __('messages.card_cvv') }}</label>
                            <input type="password" name="cvv" placeholder="123" maxlength="3" class="w-full px-5 py-4 bg-gray-800 border-gray-700 rounded-2xl text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition @error('cvv') border-red-500 @enderror" required>
                            @error('cvv') <p class="text-red-500 text-xs mt-2 font-bold uppercase tracking-wide">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-3">{{ __('messages.cardholder') }}</label>
                        <input type="text" name="cardholder" value="{{ old('cardholder') }}" placeholder="IVAN IVANOV" class="w-full px-5 py-4 bg-gray-800 border-gray-700 rounded-2xl text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition uppercase @error('cardholder') border-red-500 @enderror" required>
                        @error('cardholder') <p class="text-red-500 text-xs mt-2 font-bold uppercase tracking-wide">{{ $message }}</p> @enderror
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-5 rounded-2xl font-black text-xl hover:bg-indigo-700 transition transform hover:scale-[1.02] shadow-xl shadow-indigo-500/20">
                    {{ __('messages.pay_button', ['amount' => $formattedAmount]) }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
