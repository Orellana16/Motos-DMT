<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle - Motos DMT</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-black">

<div class="min-h-screen bg-gray-100">

    <!-- NAVBAR (mismo patrón que catálogo) -->
    <header class="border-b border-gray-300 bg-gray-100">
        <div class="flex items-center justify-between px-10 py-6">
            <nav class="flex gap-16 text-lg font-black tracking-wide">
                <a href="{{ route('inicio') }}" class="hover:text-red-700 transition">
                    INICIO
                </a>
                <a href="{{ route('catalogo.index') }}" class="hover:text-red-700 transition">
                    CATÁLOGO
                </a>
                <a href="{{ route('nosotros') }}" class="hover:text-red-700 transition">
                    SOBRE NOSOTROS
                </a>
            </nav>

            <div class="w-12 h-12 rounded-full border-2 border-black overflow-hidden">
                <img src="{{ asset('img/user.png') }}" alt="Usuario" class="w-full h-full object-cover">
            </div>
        </div>
    </header>

    <!-- CONTENIDO -->
    <div class="px-20 py-16">

        <!-- TÍTULO -->
        <div class="flex items-end justify-between mb-10">
            <h1 class="text-6xl font-black text-black leading-none">
                DETALLE <br> MOTO
            </h1>

            <a href="{{ route('catalogo.index') }}"
               class="bg-red-700 hover:bg-red-800 transition text-white font-bold text-lg px-10 py-3 rounded-full shadow-md">
                ← Volver al catálogo
            </a>
        </div>

        <!-- CARD PRINCIPAL -->
        <div class="bg-white rounded-2xl border border-gray-300 shadow-sm overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">

                <!-- IMAGEN -->
                <div class="bg-gray-200 min-h-[420px]">
                    @if($moto->imagen)
                        <img src="{{ asset('storage/'.$moto->imagen) }}" alt="Moto"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-500 font-semibold">
                            Sin imagen
                        </div>
                    @endif
                </div>

                <!-- INFO -->
                <div class="p-10">
                    <div class="flex items-start justify-between gap-6">
                        <div>
                            <h2 class="text-4xl font-black text-black leading-tight">
                                {{ $moto->modelo }}
                            </h2>
                            <p class="text-lg font-semibold text-gray-700 mt-2">
                                {{ optional($moto->manufacturer)->nombre ?? '—' }}
                                <span class="text-gray-400 font-bold mx-2">|</span>
                                {{ optional($moto->category)->nombre ?? '—' }}
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-sm font-bold text-gray-500">PRECIO</p>
                            <p class="text-4xl font-black text-black">
                                ${{ number_format($moto->precio, 2) }}
                            </p>
                        </div>
                    </div>

                    <p class="text-gray-700 mt-6">
                        {{ $moto->descripcion ?? 'Sin descripción.' }}
                    </p>

                    <!-- ESPECIFICACIONES -->
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <div class="rounded-xl border border-gray-200 p-4">
                            <p class="text-xs font-black text-gray-500">AÑO</p>
                            <p class="text-lg font-black text-black">{{ $moto->año }}</p>
                        </div>
                        <div class="rounded-xl border border-gray-200 p-4">
                            <p class="text-xs font-black text-gray-500">CILINDRADA</p>
                            <p class="text-lg font-black text-black">{{ $moto->cilindrada }} cc</p>
                        </div>
                        <div class="rounded-xl border border-gray-200 p-4">
                            <p class="text-xs font-black text-gray-500">STOCK</p>
                            <p class="text-lg font-black text-black">{{ $moto->stock }}</p>
                        </div>
                        <div class="rounded-xl border border-gray-200 p-4">
                            <p class="text-xs font-black text-gray-500">DISPONIBILIDAD</p>
                            @if($moto->disponible)
                                <p class="text-lg font-black text-green-700">Disponible</p>
                            @else
                                <p class="text-lg font-black text-red-700">No disponible</p>
                            @endif
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="flex flex-col sm:flex-row gap-4 mt-10">
                        <a href="{{ route('checkout', ['moto_id' => $moto->id]) }}"
                           class="flex-1 bg-red-700 hover:bg-red-800 transition text-white font-black text-lg
                                  px-10 py-4 rounded-full shadow-md text-center">
                            Reservar / Pagar
                        </a>

                        @auth
                            <a href="{{ route('motos.admin.edit', $moto->id) }}"
                            class="flex-1 bg-black hover:bg-gray-900 transition text-white font-black text-lg
                                    px-10 py-4 rounded-full shadow-md text-center">
                                Editar
                            </a>
                        @endauth


                    </div>

                </div>
            </div>
        </div>

        <!-- ACCESORIOS + REVIEWS -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mt-10">

            <!-- ACCESORIOS -->
            <div class="bg-white rounded-2xl border border-gray-300 shadow-sm p-8">
                <h3 class="text-2xl font-black text-black mb-6">ACCESORIOS</h3>

                @if(($moto->accessories ?? collect())->count() > 0)
                    <ul class="space-y-3">
                        @foreach($moto->accessories as $acc)
                            <li class="flex items-center justify-between border border-gray-200 rounded-xl px-5 py-4">
                                <div>
                                    <p class="font-black text-black">{{ $acc->nombre ?? 'Accesorio' }}</p>
                                    @if(!empty($acc->descripcion))
                                        <p class="text-sm text-gray-600">{{ $acc->descripcion }}</p>
                                    @endif
                                </div>
                                @if(isset($acc->precio))
                                    <p class="font-black text-black">${{ number_format($acc->precio, 2) }}</p>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600">No hay accesorios asociados.</p>
                @endif
            </div>

            <!-- REVIEWS -->
            <div class="bg-white rounded-2xl border border-gray-300 shadow-sm p-8">
                <h3 class="text-2xl font-black text-black mb-6">RESEÑAS</h3>

                @if(($moto->reviews ?? collect())->count() > 0)
                    <div class="space-y-4">
                        @foreach($moto->reviews as $rev)
                            <div class="border border-gray-200 rounded-xl p-5">
                                <div class="flex items-center justify-between">
                                    <p class="font-black text-black">
                                        {{ $rev->titulo ?? 'Reseña' }}
                                    </p>
                                    @if(isset($rev->rating))
                                        <p class="font-black text-red-700">
                                            {{ $rev->rating }}/5
                                        </p>
                                    @endif
                                </div>
                                @if(!empty($rev->comentario))
                                    <p class="text-gray-700 mt-2">{{ $rev->comentario }}</p>
                                @endif
                                <p class="text-xs text-gray-500 mt-3">
                                    {{ optional($rev->created_at)->format('d/m/Y') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600">Aún no hay reseñas.</p>
                @endif
            </div>

        </div>

    </div>
</div>

</body>
</html>
