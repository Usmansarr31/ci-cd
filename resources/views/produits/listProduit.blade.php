@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-box-seam"></i> Détails du produit</h4>
                <div>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-light">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="img-fluid rounded">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded" 
                                 style="height: 300px;">
                                <i class="bi bi-image" style="font-size: 4rem;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h2>{{ $product->name }}</h2>
                        
                        <hr>

                        <div class="mb-3">
                            <strong>Prix :</strong>
                            <span class="fs-4 text-primary">{{ number_format($product->price, 2) }} €</span>
                        </div>

                        <div class="mb-3">
                            <strong>Stock :</strong>
                            @if($product->stock > 10)
                                <span class="badge bg-success fs-6">{{ $product->stock }} unités</span>
                            @elseif($product->stock > 0)
                                <span class="badge bg-warning fs-6">{{ $product->stock }} unités</span>
                            @else
                                <span class="badge bg-danger fs-6">Rupture de stock</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <strong>Statut :</strong>
                            @if($product->is_active)
                                <span class="badge bg-success"><i class="bi bi-check-circle"></i> Actif</span>
                            @else
                                <span class="badge bg-secondary"><i class="bi bi-x-circle"></i> Inactif</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <strong>Description :</strong>
                            <p class="mt-2">{{ $product->description ?? 'Aucune description disponible.' }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Date de création :</strong>
                            <span>{{ $product->created_at->format('d/m/Y à H:i') }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Dernière modification :</strong>
                            <span>{{ $product->updated_at->format('d/m/Y à H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <form action="{{ route('products.destroy', $product) }}" 
                      method="POST" 
                      class="d-inline"
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Supprimer ce produit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection