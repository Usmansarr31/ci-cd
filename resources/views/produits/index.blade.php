@extends('layouts.app')

@section('title', 'Liste des produits')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-box-seam"></i> Liste des Produits</h1>
    <a href="{{ route('produits.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nouveau Produit
    </a>
</div>

@if($produits->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Statut</th>
                    <th>Date de création</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                <tr>
                    <td>
                        @if($produit->image)
                            <img src="{{ asset('storage/' . $produit->image) }}" 
                                 alt="{{ $produit->name }}" 
                                 class="img-thumbnail" 
                                 style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px;">
                                <i class="bi bi-image"></i>
                            </div>
                        @endif
                    </td>
                    <td>{{ $produit->name }}</td>
                    <td><strong>{{ number_format($produit->price, 2) }} €</strong></td>
                    <td>
                        @if($produit->stock > 10)
                            <span class="badge bg-success">{{ $produit->stock }}</span>
                        @elseif($produit->stock > 0)
                            <span class="badge bg-warning">{{ $produit->stock }}</span>
                        @else
                            <span class="badge bg-danger">Rupture</span>
                        @endif
                    </td>
                    <td>
                        @if($produit->is_active)
                            <span class="badge bg-success"><i class="bi bi-check-circle"></i> Actif</span>
                        @else
                            <span class="badge bg-secondary"><i class="bi bi-x-circle"></i> Inactif</span>
                        @endif
                    </td>
                    <td>{{ $produit->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('produits.show', $produit) }}" 
                               class="btn btn-sm btn-info text-white" 
                               title="Voir">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('produits.edit', $produit) }}" 
                               class="btn btn-sm btn-warning" 
                               title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('produits.destroy', $produit) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $produits->links() }}
    </div>
@else
    <div class="alert alert-info text-center">
        <i class="bi bi-info-circle"></i> Aucun produit trouvé.
        <a href="{{ route('produits.create') }}" class="alert-link">Créer le premier produit</a>
    </div>
@endif
@endsection