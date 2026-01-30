<!-- Modal Editar Movimento -->
<div class="modal fade" id="editMovementModal" tabindex="-1" aria-labelledby="editMovementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-surface border-custom text-white" style="border-radius: 1rem;">
            <div class="modal-header border-bottom border-custom">
                <h1 class="modal-title fs-5 fw-bold" id="editMovementModalLabel">Editar Movimento</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-md-5">
                <div class="mb-4">
                    <label class="label-caps d-block">Pesquisar Movimento</label>
                    <div class="position-relative">
                        <input type="search" class="form-control" id="editMovementSearch" name="movement_search_text"
                            placeholder="Procure por descrição ou valor..." list="movementsList" autocomplete="off">
                        <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y pe-3 text-secondary"></i>
                        <datalist id="movementsList">
                            @foreach($movements as $m)
                                <option value="{{ $m->descricao }} - {{ number_format($m->valor, 2, ',', '.') }}€">
                            @endforeach
                        </datalist>
                    </div>
                </div>

                <form id="editMovementForm" action="#" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="edit_id">

                    <div class="mb-4 {{ !$selectedMovement ? 'opacity-50' : '' }}">
                        <label class="label-caps d-block">Tipo de Movimento</label>
                        <div class="btn-toggle-group">
                            <input type="radio" class="btn-check" name="edit_tipo" id="edit_receita" value="receita" autocomplete="off"
                                {{ $selectedMovement && $selectedMovement->tipo == 'receita' ? 'checked' : '' }} {{ !$selectedMovement ? 'disabled' : '' }}>
                            <label class="btn-toggle-item" for="edit_receita">
                                <i class="bi bi-graph-up-arrow"></i> Receita
                            </label>

                            <input type="radio" class="btn-check" name="edit_tipo" id="edit_despesa" value="despesa" autocomplete="off"
                                {{ ($selectedMovement && $selectedMovement->tipo == 'despesa') || !$selectedMovement ? 'checked' : '' }} {{ !$selectedMovement ? 'disabled' : '' }}>
                            <label class="btn-toggle-item" for="edit_despesa">
                                <i class="bi bi-graph-down-arrow"></i> Despesa
                            </label>
                        </div>
                    </div>

                    <div class="mb-4 {{ !$selectedMovement ? 'opacity-50' : '' }}">
                        <label class="label-caps d-block">Descrição</label>
                        <div class="position-relative">
                            <input type="text" class="form-control" id="edit_descricao" name="edit_descricao"
                                value="{{ $selectedMovement ? $selectedMovement->descricao : '' }}" placeholder="Ex: Supermercado" {{ !$selectedMovement ? 'disabled' : '' }}>
                            <i class="bi bi-pencil position-absolute top-50 end-0 translate-middle-y pe-3 text-secondary"></i>
                        </div>
                    </div>

                    <div class="row g-3 mb-4 {{ !$selectedMovement ? 'opacity-50' : '' }}">
                        <div class="col-md-4">
                            <label class="label-caps d-block">Valor</label>
                            <div class="position-relative">
                                <input type="number" step="0.01" class="form-control" id="edit_valor" name="edit_valor"
                                    value="{{ $selectedMovement ? $selectedMovement->valor : '' }}" placeholder="0,00" {{ !$selectedMovement ? 'disabled' : '' }}>
                                <i class="bi bi-currency-euro position-absolute top-50 end-0 translate-middle-y pe-3 text-secondary"></i>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="label-caps d-block">Categoria</label>
                            <select class="form-select" id="edit_categoria_id" name="edit_categoria_id" {{ !$selectedMovement ? 'disabled' : '' }}>
                                <option disabled {{ !$selectedMovement ? 'selected' : '' }} value="">Selecione...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $selectedMovement && $selectedMovement->categoria_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="label-caps d-block">Data</label>
                            <input type="date" class="form-control" id="edit_data" name="edit_data" style="color-scheme: dark;"
                                value="{{ $selectedMovement ? $selectedMovement->data->format('Y-m-d') : '' }}" {{ !$selectedMovement ? 'disabled' : '' }}>
                        </div>
                    </div>

                    <div class="d-flex flex-column-reverse flex-sm-row gap-3 pt-3 border-top border-custom">
                        <button type="button" class="btn btn-cancel-custom" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary-custom ms-sm-auto d-flex align-items-center justify-content-center gap-2" {{ !$selectedMovement ? 'disabled' : '' }}>
                            <i class="bi bi-check2-circle fs-5"></i>
                            Salvar Alteração
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('editMovementSearch');
        const movements = @json($movements->items());
        const form = document.getElementById('editMovementForm');

        searchInput.addEventListener('input', function() {
            const val = this.value;
            const movement = movements.find(m => {
                const searchStr = `${m.descricao} - ${new Intl.NumberFormat('pt-PT', { minimumFractionDigits: 2 }).format(m.valor)}€`;
                return searchStr === val;
            });

            if (movement) {
                // Preencher campos
                document.getElementById('edit_id').value = movement.id;
                document.getElementById('edit_descricao').value = movement.descricao;
                document.getElementById('edit_valor').value = movement.valor;
                document.getElementById('edit_categoria_id').value = movement.categoria_id;

                // Atualizar o action do formulário
                form.action = "/movements/" + movement.id;

                // Formatar data (YYYY-MM-DD para o input data)
                const dateParts = movement.data.split('T')[0];
                document.getElementById('edit_data').value = dateParts;

                // Tipo de movimento
                if (movement.tipo === 'receita') {
                    document.getElementById('edit_receita').checked = true;
                } else {
                    document.getElementById('edit_despesa').checked = true;
                }

                // Habilitar campos e remover opacidade
                form.querySelectorAll('input, select, button, .mb-4, .row').forEach(el => {
                    el.classList.remove('opacity-50');
                    el.disabled = false;
                });
            } else {
                // Limpar campos de controle se não houver match
                document.getElementById('edit_id').value = '';
                form.action = '#';

                // Opcional: Desabilitar campos se o usuário apagar a busca
                // form.querySelectorAll('input:not([type="search"]), select, button[type="submit"]').forEach(el => el.disabled = true);
            }
        });

        // Caso a página já venha com algum ID no URL (fallback), mas o objetivo agora é sem refresh
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('id')) {
            const editModalElement = document.getElementById('editMovementModal');
            if (editModalElement) {
                const editModal = new bootstrap.Modal(editModalElement);
                editModal.show();
            }
        }
    });
</script>
