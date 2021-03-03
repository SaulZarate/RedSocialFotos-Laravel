
@php
    // Boton
    $textBtn = $button["textBtn"] ?? "boton";
    $colorBtn = $button["colorBtn"] ?? "primary";
    $sizeBtn = $button["sizeBtn"] ?? "md";

    // Modal
    $titleModal = $button["titleModal"] ?? "Titulo";
    $textModal = $button["textModal"] ?? "¿ Esta seguro ?";
    $textBtnConfirm = $button["textBtnConfirm"] ?? "Acepto";

@endphp

<!-- Button - Open Modal -->
<button type="button" class="btn btn-{{$colorBtn}} btn-{{$sizeBtn}}" data-toggle="modal" data-target="#modal{{time()}}">
    {{ $textBtn }}
</button>

<!-- Modal -->
<div class="modal fade" id="modal{{time()}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{time()}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalLabel{{time()}}">{{$titleModal}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            {{$textModal}}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">{{$textBtnConfirm}}</button>
        </div>
        </div>
    </div>
</div>