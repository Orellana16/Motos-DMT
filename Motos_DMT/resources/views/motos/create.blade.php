@extends('layouts.public')

@section('title', 'Añadir Nueva Bestia - Motos DMT')

@section('body-class', 'create-moto-page')

@section('content')
<div class="content" style="position: relative; z-index: 10; padding-top: 120px; padding-bottom: 60px;">
    <div class="container" style="max-width: 800px; margin: 0 auto; padding: 0 20px;">
        
        <header class="main-header" style="text-align: center; margin-bottom: 40px;">
            <span class="main-header__subtitle" style="color: var(--color-red-primary);">Nueva Incorporación</span>
            <h1 class="main-header__title">AÑADIR <span>MOTO</span></h1>
        </header>

        @if ($errors->any())
            <div class="alert-error">
                <div class="alert-error__title">¡Atención, motero! Revisa estos campos:</div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="auth__card" style="width: 100%; max-width: none; background: rgba(20, 20, 20, 0.9); border: 1px solid #333; padding: 40px;">
            <form method="POST" action="{{ route('motos.store') }}" class="ruda-form">
                @csrf

                <div class="form-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                    
                    {{-- Fabricante --}}
                    <div class="form-group">
                        <label>Fabricante</label>
                        <select name="manufacturer_id" class="form-control">
                            <option value="" disabled selected>Selecciona Marca</option>
                            @foreach($fabricadores as $fabricador)
                                <option value="{{ $fabricador->id }}" {{ old('manufacturer_id') == $fabricador->id ? 'selected' : '' }}>
                                    {{ $fabricador->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Categoría --}}
                    <div class="form-group">
                        <label>Categoría</label>
                        <select name="category_id" class="form-control">
                            <option value="" disabled selected>Selecciona Categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('category_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Modelo --}}
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Modelo</label>
                        <input type="text" name="modelo" class="form-control" value="{{ old('modelo') }}" placeholder="Ej: Sportster S 1250">
                    </div>

                    {{-- Año --}}
                    <div class="form-group">
                        <label>Año</label>
                        <input type="number" name="año" class="form-control" value="{{ old('año') }}" placeholder="2024">
                    </div>

                    {{-- Cilindrada --}}
                    <div class="form-group">
                        <label>Cilindrada (cc)</label>
                        <input type="number" name="cilindrada" class="form-control" value="{{ old('cilindrada') }}" placeholder="1250">
                    </div>

                    {{-- Precio --}}
                    <div class="form-group">
                        <label>Precio (€)</label>
                        <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio') }}" placeholder="18500.00">
                    </div>

                    {{-- Stock --}}
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" placeholder="5">
                    </div>

                    {{-- Estado --}}
                    <div class="form-group">
                        <label>Estado</label>
                        <select name="disponible" class="form-control">
                            <option value="1" {{ old('disponible') == '1' ? 'selected' : '' }}>DISPONIBLE</option>
                            <option value="0" {{ old('disponible') == '0' ? 'selected' : '' }}>FUERA DE STOCK</option>
                        </select>
                    </div>

                    {{-- Imagen URL --}}
                    <div class="form-group" style="grid-column: span 2;">
                        <label>URL de la Imagen</label>
                        <input type="text" name="imagen" class="form-control" 
                               value="{{ old('imagen') }}" 
                               placeholder="https://ejemplo.com/foto-moto.jpg">
                        <p class="helper-text">Pega el enlace directo a la imagen (.jpg, .png, etc.)</p>
                    </div>

                    {{-- Descripción --}}
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="4" placeholder="Breve descripción de la bestia...">{{ old('descripcion') }}</textarea>
                    </div>

                </div>

                <div class="form-actions" style="margin-top: 30px; text-align: right;">
                    <a href="{{ route('catalogo.index') }}" class="btn-back" style="margin-right: 20px; color: #aaa; text-decoration: none; font-weight: bold; font-size: 0.9rem;">CANCELAR</a>
                    <button type="submit" class="btn-submit" style="width: auto; padding: 15px 40px;">
                        <span>CREAR MOTO</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
