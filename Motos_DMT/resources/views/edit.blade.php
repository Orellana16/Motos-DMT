<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar {{ $moto->modelo }} - Motos DMT</title>
    @vite(['resources/scss/app.scss'])
</head>
<body class="edit-page">

    <div class="edit-container">
        @php
            $imagenUrl = $moto->imagen;
            if ($imagenUrl && !Str::startsWith($imagenUrl, ['http://', 'https://'])) {
                $imagenUrl = asset('storage/' . $imagenUrl);
            } elseif (!$imagenUrl) {
                $imagenUrl = asset('img/default-moto.png');
            }
        @endphp

        <div class="edit-sidebar" style="background-image: url('{{ $imagenUrl }}');">
            <div class="edit-sidebar__overlay">
                <div class="moto-info-badge">
                    <span class="badge-year">{{ $moto->año }}</span>
                    <h2 class="badge-model">{{ $moto->modelo }}</h2>
                </div>
            </div>
        </div>

        <div class="edit-content">
            <nav class="edit-nav">
                <a href="{{ route('catalogo.index') }}" class="btn-back">
                    <span class="icon">←</span> VOLVER AL GARAJE
                </a>
            </nav>

            <div class="edit-form-wrapper">
                <header class="edit-header">
                    <span class="edit-header__subtitle">Configuración de Máquina</span>
                    <h1 class="edit-header__title">EDITAR <span>MOTO</span></h1>
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

                <form method="POST" action="{{ route('motos.update', $moto->id) }}" class="ruda-form">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Fabricante</label>
                            <select name="manufacturer_id" class="form-control">
                                @foreach($fabricadores as $fabricador)
                                    <option value="{{ $fabricador->id }}" {{ old('manufacturer_id', $moto->manufacturer_id) == $fabricador->id ? 'selected' : '' }}>
                                        {{ $fabricador->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Categoría</label>
                            <select name="category_id" class="form-control">
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('category_id', $moto->category_id) == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Modelo</label>
                            <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $moto->modelo) }}">
                        </div>

                        <div class="form-group">
                            <label>Año</label>
                            <input type="number" name="año" class="form-control" value="{{ old('año', $moto->año) }}">
                        </div>

                        <div class="form-group">
                            <label>Cilindrada (cc)</label>
                            <input type="number" name="cilindrada" class="form-control" value="{{ old('cilindrada', $moto->cilindrada) }}">
                        </div>

                        <div class="form-group">
                            <label>Precio (€)</label>
                            <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio', $moto->precio) }}">
                        </div>

                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" name="stock" class="form-control" value="{{ old('stock', $moto->stock) }}">
                        </div>

                        <div class="form-group">
                            <label>Estado</label>
                            <select name="disponible" class="form-control">
                                <option value="1" {{ old('disponible', $moto->disponible) == '1' ? 'selected' : '' }}>DISPONIBLE</option>
                                <option value="0" {{ old('disponible', $moto->disponible) == '0' ? 'selected' : '' }}>FUERA DE STOCK</option>
                            </select>
                        </div>

                        <div class="form-group col-span-2">
                            <label>URL de la Imagen</label>
                            <input type="text" name="imagen" class="form-control" 
                                   value="{{ old('imagen', $moto->imagen) }}" 
                                   placeholder="https://ejemplo.com/foto-moto.jpg">
                            <p class="helper-text">Pega el enlace directo a la imagen (.jpg, .png, etc.)</p>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <span>GUARDAR CAMBIOS</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>