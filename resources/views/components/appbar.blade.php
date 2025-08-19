<div class="appbar">

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (para los modales) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal de Error -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: brown" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>

                </div>
                <div class="modal-body">
                    {{ session('error') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para mostrar el modal automáticamente si hay un error -->
    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                $('#errorModal').modal('show');
            });
        </script>
    @endif

    
        <div>

            
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="login-logo" style="width: 200px; position: relative; top: 10px; left: 20px;">

        </div>
        @if(session('success'))
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        
    @endif
    <div>
       
        <span class="subTITULO-appbar" >Usuario: {{ Auth::user()->name }} </span><br>
        <span class="subTITULO-appbar" >Rol del Usuario: {{ Auth::user()->role->nombre ?? 'Sin rol' }}</span><br>

    </div>
</div>
 