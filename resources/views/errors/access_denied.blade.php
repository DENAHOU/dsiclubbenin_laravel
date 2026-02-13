@extends('layouts.app-shell-' . ($userType === 'company' ? 'entite' : ($userType === 'college' ? 'college' : 'admin')))

@section('title', 'Accès Refusé')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-danger">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Accès Refusé
                        </h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="fas fa-lock fa-4x text-danger"></i>
                        </div>
                        
                        <h5 class="mb-3">Cotisation requise</h5>
                        
                        <p class="text-muted mb-4">
                            {{ $message ?? 'Vous devez être à jour dans vos cotisations pour accéder à cette ressource.' }}
                        </p>

                        <div class="alert alert-info">
                            <h6 class="alert-heading">
                                <i class="fas fa-info-circle me-2"></i>
                                Montants des cotisations annuelles :
                            </h6>
                            <ul class="list-unstyled mb-0">
                                <li><strong>Entreprises :</strong> 150 000 FCFA/an</li>
                                <li><strong>Collèges IT :</strong> 100 000 FCFA/an</li>
                                <li><strong>Administrations :</strong> 100 000 FCFA/an</li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('membership.pay') }}" class="btn btn-primary">
                                <i class="fas fa-credit-card me-2"></i>
                                Payer ma cotisation
                            </a>
                            <a href="{{ route($userType . '.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Retour au dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
